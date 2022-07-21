<?php
namespace verbb\workflow\services;

use verbb\workflow\Workflow;
use verbb\workflow\elements\Submission;
use verbb\workflow\events\EmailEvent;
use verbb\workflow\events\PrepareEmailEvent;
use verbb\workflow\events\ReviewerUserGroupsEvent;
use verbb\workflow\models\Review;
use verbb\workflow\records\Review as ReviewRecord;

use Craft;
use craft\base\Component;
use craft\db\Table;
use craft\elements\Entry;
use craft\elements\User;
use craft\helpers\Db;
use craft\models\UserGroup;

class Submissions extends Component
{
    // Constants
    // =========================================================================

    const EVENT_PREPARE_EDITOR_EMAIL = 'prepareEditorEmail';
    const EVENT_PREPARE_REVIEWER_EMAIL = 'prepareReviewerEmail';
    const EVENT_PREPARE_PUBLISHER_EMAIL = 'preparePublisherEmail';
    const EVENT_BEFORE_SEND_EDITOR_EMAIL = 'beforeSendEditorEmail';
    const EVENT_BEFORE_SEND_REVIEWER_EMAIL = 'beforeSendReviewerEmail';
    const EVENT_BEFORE_SEND_PUBLISHER_EMAIL = 'beforeSendPublisherEmail';
    const EVENT_AFTER_GET_REVIEWER_USER_GROUPS = 'afterGetReviewerUserGroups';


    // Public Methods
    // =========================================================================

    public function getSubmissionById(int $id)
    {
        return Craft::$app->getElements()->getElementById($id, Submission::class);
    }

    /**
     * Returns the reviewer user groups for the given submission.
     *
     * @param Submission|null $submission
     * @return UserGroup[]
     */
    public function getReviewerUserGroups($site, Submission $submission = null): array
    {
        $userGroups = Workflow::$plugin->getSettings()->getReviewerUserGroups($site);

        // Fire an 'afterGetReviewerUserGroups' event
        if ($this->hasEventHandlers(self::EVENT_AFTER_GET_REVIEWER_USER_GROUPS)) {
            $this->trigger(self::EVENT_AFTER_GET_REVIEWER_USER_GROUPS,
                new ReviewerUserGroupsEvent([
                    'submission' => $submission,
                    'userGroups' => $userGroups,
                ])
            );
        }

        return $userGroups;
    }

    /**
     * Returns the next reviewer user group for the given submission.
     *
     * @param Submission $submission
     * @return UserGroup|null
     */
    public function getNextReviewerUserGroup(Submission $submission, $entry)
    {
        $reviewerUserGroups = $this->getReviewerUserGroups($entry->site, $submission);

        $lastReviewer = $submission->getLastReviewer(true);

        if ($lastReviewer === null) {
            return $reviewerUserGroups[0] ?? null;
        }

        $nextUserGroup = null;

        foreach ($reviewerUserGroups as $key => $userGroup) {
            if ($lastReviewer->isInGroup($userGroup)) {
                $nextUserGroup = $reviewerUserGroups[$key + 1] ?? $nextUserGroup;
            }
        }

        return $nextUserGroup;
    }

    public function saveSubmission($entry)
    {
        $settings = Workflow::$plugin->getSettings();

        $currentUser = Craft::$app->getUser()->getIdentity();
        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();
        $submission->setOwner($entry);
        $submission->ownerId = $entry->id;
        $submission->ownerSiteId = $entry->siteId;
        $submission->editorId = $currentUser->id;
        $submission->status = Submission::STATUS_PENDING;
        $submission->dateApproved = null;
        $submission->editorNotes = $request->getParam('editorNotes', $submission->editorNotes);
        $submission->publisherNotes = $request->getParam('publisherNotes', $submission->publisherNotes);

        if ($entry->draftId) {
            $submission->ownerDraftId = $entry->draftId;
        }

        $submission->data = $this->_getRevisionData($entry);

        $isNew = !$submission->id;

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not submit for approval.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        if ($isNew) {
            // Trigger notification to reviewer
            if ($settings->reviewerNotifications) {
                $this->sendReviewerNotificationEmail($submission, $entry);
            } else if ($settings->publisherNotifications) {
                $this->sendPublisherNotificationEmail($submission, $entry);
            }
        }

        $session->setNotice(Craft::t('workflow', 'Entry submitted for approval.'));
    }

    public function revokeSubmission($entry)
    {
        $settings = Workflow::$plugin->getSettings();

        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();
        $submission->status = Submission::STATUS_REVOKED;
        $submission->dateRevoked = new \DateTime;

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not revoke submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        $session->setNotice(Craft::t('workflow', 'Submission revoked.'));
    }

    public function approveReview($entry)
    {
        $settings = Workflow::$plugin->getSettings();

        $currentUser = Craft::$app->getUser()->getIdentity();
        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not approve submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        $reviewRecord = new ReviewRecord([
            'submissionId' => $submission->id,
            'userId' => $currentUser->id,
            'approved' => true,
            'notes' => $request->getParam('reviewerNotes'),
        ]);

        if (!$reviewRecord->save()) {
            $session->setError(Craft::t('workflow', 'Could not approve submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        $review = Review::populateModel($reviewRecord);

        // Trigger notification to the next reviewer, if there is one
        if ($settings->reviewerNotifications) {
            // Modify the notes to be the reviewer notes, but still use the same email template
            $submission->editorNotes = $reviewRecord->notes;

            $this->sendReviewerNotificationEmail($submission, $entry);
        }

        // Trigger notification to editor - if configured to do so
        if ($settings->editorNotifications && $settings->reviewerApprovalNotifications) {
            $this->sendEditorNotificationEmail($submission, $review);
        }

        $session->setNotice(Craft::t('workflow', 'Submission approved.'));
    }

    public function rejectReview($entry)
    {
        $settings = Workflow::$plugin->getSettings();

        $currentUser = Craft::$app->getUser()->getIdentity();
        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();
        $submission->status = Submission::STATUS_REJECTED;
        $submission->dateRejected = new \DateTime;

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not approve submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        $reviewRecord = new ReviewRecord([
            'submissionId' => $submission->id,
            'userId' => $currentUser->id,
            'approved' => false,
            'notes' => $request->getParam('reviewerNotes'),
        ]);

        if (!$reviewRecord->save()) {
            $session->setError(Craft::t('workflow', 'Could not reject submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        $review = Review::populateModel($reviewRecord);

        // Trigger notification to editor
        if ($settings->editorNotifications) {
            $this->sendEditorNotificationEmail($submission, $review);
        }

        $session->setNotice(Craft::t('workflow', 'Submission rejected.'));
    }

    public function approveSubmission($entry, $published = true)
    {
        $settings = Workflow::$plugin->getSettings();

        $currentUser = Craft::$app->getUser()->getIdentity();
        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();
        $submission->status = Submission::STATUS_APPROVED;
        $submission->publisherId = $currentUser->id;
        $submission->dateApproved = new \DateTime;
        $submission->editorNotes = $request->getParam('editorNotes', $submission->editorNotes);
        $submission->publisherNotes = $request->getParam('publisherNotes', $submission->publisherNotes);

        // Update the owner to be the newly published entry, and remove the ownerDraftId - it no longer exists!
        if ($entry && $published) {
            $submission->ownerId = $entry->id;
            $submission->ownerDraftId = null;
        }

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not approve and publish.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        // Trigger notification to editor
        if ($settings->editorNotifications) {
            $this->sendEditorNotificationEmail($submission);
        }

        $session->setNotice(Craft::t('workflow', 'Entry approved and published.'));
    }

    public function rejectSubmission($entry)
    {
        $settings = Workflow::$plugin->getSettings();

        $currentUser = Craft::$app->getUser()->getIdentity();
        $request = Craft::$app->getRequest();
        $session = Craft::$app->getSession();

        $submission = $this->_setSubmissionFromPost();
        $submission->status = Submission::STATUS_REJECTED;
        $submission->publisherId = $currentUser->id;
        $submission->dateRejected = new \DateTime;
        $submission->editorNotes = $request->getParam('editorNotes', $submission->editorNotes);
        $submission->publisherNotes = $request->getParam('publisherNotes', $submission->publisherNotes);

        if (!Craft::$app->getElements()->saveElement($submission)) {
            $session->setError(Craft::t('workflow', 'Could not reject submission.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'submission' => $submission,
            ]);

            return null;
        }

        // Trigger notification to editor
        if ($settings->editorNotifications) {
            $this->sendEditorNotificationEmail($submission);
        }

        $session->setNotice(Craft::t('workflow', 'Submission rejected.'));
    }

    public function sendReviewerNotificationEmail($submission, $entry)
    {
        Workflow::log('Preparing reviewer notification.');

        $reviewerUserGroup = $this->getNextReviewerUserGroup($submission, $entry);

        // If there is no next reviewer user group then send publisher notification email
        if ($reviewerUserGroup === null) {
            Workflow::log('No reviewer user groups. Send publisher email.');

            $this->sendPublisherNotificationEmail($submission, $entry);

            return;
        }

        $reviewers = User::find()
            ->groupId($reviewerUserGroup->id)
            ->all();

        // Fire a 'prepareReviewerEmail' event
        $event = new PrepareEmailEvent([
            'reviewers' => $reviewers,
            'submission' => $submission,
        ]);
        $this->trigger(self::EVENT_PREPARE_REVIEWER_EMAIL, $event);

        if (!$event->isValid) {
            Workflow::log('Reviewer notification was cancelled by event.');
            return;
        }

        // Update the users from the event, potentially modified
        $reviewers = $event->reviewers;

        if (!$reviewers) {
            Workflow::log('No reviewers found to send notifications to.');
        }

        foreach ($reviewers as $key => $user) {
            try {
                $mail = Craft::$app->getMailer()
                    ->composeFromKey('workflow_publisher_notification', ['submission' => $submission])
                    ->setTo($user);

                // Fire a 'beforeSendReviewerEmail' event
                $event = new EmailEvent([
                    'mail' => $mail,
                    'user' => $user,
                    'submission' => $submission,
                ]);
                $this->trigger(self::EVENT_BEFORE_SEND_REVIEWER_EMAIL, $event);

                if (!$event->isValid) {
                    Workflow::log('Reviewer notification was cancelled by event.');
                    continue;
                }

                $event->mail->send();

                Workflow::log('Sent reviewer notification to ' . $event->user->email);
            } catch (\Throwable $e) {
                Workflow::error(Craft::t('workflow', 'Failed to send reviewer notification to {value} - “{message}” {file}:{line}', [
                    'value' => $user->email,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]));
            }
        }
    }

    public function sendPublisherNotificationEmail($submission, $entry)
    {
        Workflow::log('Preparing publisher notification.');

        $settings = Workflow::$plugin->getSettings();

        $publisherGroup = $settings->getPublisherUserGroup($entry->site);

        if (!$publisherGroup) {
            Workflow::log('No publisher group found to send notifications to.');
        }

        $query = User::find()->groupId($publisherGroup->id);

        // Check settings to see if we should email all publishers or not
        if (isset($settings->selectedPublishers)) {
            if ($settings->selectedPublishers != '*') {
                $query->id($settings->selectedPublishers);
            }
        }

        $publishers = $query->all();

        // Fire a 'preparePublisherEmail' event
        $event = new PrepareEmailEvent([
            'publishers' => $publishers,
            'submission' => $submission,
        ]);
        $this->trigger(self::EVENT_PREPARE_PUBLISHER_EMAIL, $event);

        if (!$event->isValid) {
            Workflow::log('Publisher notification was cancelled by event.');
            return;
        }

        // Update the users from the event, potentially modified
        $publishers = $event->publishers;

        if (!$publishers) {
            Workflow::log('No publishers found to send notifications to.');
        }

        foreach ($publishers as $key => $user) {
            try {
                $mail = Craft::$app->getMailer()
                    ->composeFromKey('workflow_publisher_notification', ['submission' => $submission])
                    ->setTo($user);

                // Fire a 'beforeSendPublisherEmail' event
                $event = new EmailEvent([
                    'mail' => $mail,
                    'user' => $user,
                    'submission' => $submission,
                ]);
                $this->trigger(self::EVENT_BEFORE_SEND_PUBLISHER_EMAIL, $event);

                if (!$event->isValid) {
                    Workflow::log('Publisher notification was cancelled by event.');
                    continue;
                }

                $event->mail->send();

                Workflow::log('Sent publisher notification to ' . $event->user->email);
            } catch (\Throwable $e) {
                Workflow::error(Craft::t('workflow', 'Failed to send publisher notification to {value} - “{message}” {file}:{line}', [
                    'value' => $user->email,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]));
            }
        }
    }

    /**
     * Sends a notification email to the editor.
     *
     * @param Submission $submission
     * @param Review|null $review
     */
    public function sendEditorNotificationEmail($submission, Review $review = null)
    {
        Workflow::log('Preparing editor notification.');

        $settings = Workflow::$plugin->getSettings();

        $editor = User::find()
            ->id($submission->editorId)
            ->one();

        // Fire a 'prepareEditorEmail' event
        $event = new PrepareEmailEvent([
            'editor' => $editor,
            'submission' => $submission,
        ]);
        $this->trigger(self::EVENT_PREPARE_EDITOR_EMAIL, $event);

        if (!$event->isValid) {
            Workflow::log('Editor notification was cancelled by event.');
            return;
        }

        // Update the user from the event, potentially modified
        $editor = $event->editor;

        // Only send to the single user editor - not the whole group
        if (!$editor) {
            Workflow::error('Unable to find editor #' . $submission->editorId);

            return;
        }

        try {
            if ($review === null) {
                $mail = Craft::$app->getMailer()->composeFromKey('workflow_editor_notification', ['submission' => $submission]);
            } else {
                $mail = Craft::$app->getMailer()->composeFromKey('workflow_editor_review_notification', [
                    'submission' => $submission,
                    'review' => $review,
                ]);
            }

            $mail->setTo($editor);

            if (!is_array($settings->editorNotificationsOptions)) {
                $settings->editorNotificationsOptions = [];
            }

            if ($review === null) {
                if ($submission->publisher) {
                    if (in_array('replyTo', $settings->editorNotificationsOptions)) {
                        $mail->setReplyTo($submission->publisher->email);
                    }

                    if (in_array('cc', $settings->editorNotificationsOptions)) {
                        $mail->setCc($submission->publisher->email);
                    }
                }
            } else {
                $reviewer = $submission->getLastReviewer();

                if ($reviewer !== null) {
                    if (in_array('replyToReviewer', $settings->editorNotificationsOptions)) {
                        $mail->setReplyTo($reviewer->email);
                    }

                    if (in_array('ccReviewer', $settings->editorNotificationsOptions)) {
                        $mail->setCc($reviewer->email);
                    }
                }
            }

            // Fire a 'beforeSendEditorEmail' event
            $event = new EmailEvent([
                'mail' => $mail,
                'user' => $editor,
                'submission' => $submission,
            ]);
            $this->trigger(self::EVENT_BEFORE_SEND_EDITOR_EMAIL, $event);

            if (!$event->isValid) {
                Workflow::log('Editor notification was cancelled by event.');
                return;
            }

            $event->mail->send();

            if ($review === null) {
                Workflow::log('Sent editor notification to ' . $event->user->email);
            } else {
                Workflow::log('Sent editor review notification to ' . $event->user->email);
            }
        } catch (\Throwable $e) {
            Workflow::error(Craft::t('workflow', 'Failed to send editor notification to {value} - “{message}” {file}:{line}', [
                'value' => $editor->email,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]));
        }
    }


    // Private Methods
    // =========================================================================

    private function _setSubmissionFromPost(): Submission
    {
        $request = Craft::$app->getRequest();
        $submissionId = $request->getParam('submissionId');

        if ($submissionId) {
            $submission = $this->getSubmissionById($submissionId);

            if (!$submission) {
                throw new \Exception(Craft::t('workflow', 'No submission with the ID “{id}”', ['id' => $submissionId]));
            }
        } else {
            $submission = new Submission();
        }

        return $submission;
    }

    private function _getRevisionData(Entry $revision): array
    {
        $revisionData = [
            'typeId' => $revision->typeId,
            'authorId' => $revision->authorId,
            'title' => $revision->title,
            'slug' => $revision->slug,
            'postDate' => $revision->postDate ? $revision->postDate->getTimestamp() : null,
            'expiryDate' => $revision->expiryDate ? $revision->expiryDate->getTimestamp() : null,
            'enabled' => $revision->enabled,
            'newParentId' => $revision->newParentId,
            'fields' => [],
        ];

        $content = $revision->getSerializedFieldValues();

        foreach (Craft::$app->getFields()->getAllFields() as $field) {
            if (isset($content[$field->handle]) && $content[$field->handle] !== null) {
                $revisionData['fields'][$field->id] = $content[$field->handle];
            }
        }

        return $revisionData;
    }
}
