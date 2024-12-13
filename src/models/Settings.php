<?php
namespace verbb\workflow\models;

use Craft;
use craft\base\Model;
use craft\elements\User;
use craft\helpers\ArrayHelper;

class Settings extends Model
{
    // Properties
    // =========================================================================

    // General
    public string $pluginName = 'Workflow';
    public array $editorUserGroup = [];
    public array $reviewerUserGroups = [];
    public array $publisherUserGroup = [];
    public array $editorNotesRequired = [];
    public array $publisherNotesRequired = [];
    public bool $lockDraftSubmissions = true;

    // Notifications
    public bool $editorNotifications = true;
    public array $editorNotificationsOptions = [];
    public bool $reviewerNotifications = true;
    public bool $reviewerApprovalNotifications = false;
    public bool $publisherNotifications = true;
    public bool $publishedAuthorNotifications = false;
    public ?string $publisherNotificationsUserGroup = null;

    // Permissions
    public mixed $enabledSections = '*';

    // Deprecated
    public mixed $selectedPublishers = '*';


    // Public Methods
    // =========================================================================

    public function getEditorUserGroup($site)
    {
        $groupUid = $this->editorUserGroup[$site->uid] ?? null;

        if ($groupUid) {
            return Craft::$app->getUserGroups()->getGroupByUid($groupUid);
        }

        return null;
    }

    public function getEditorUserGroupUid($site)
    {
        return $this->getEditorUserGroup($site)->uid ?? null;
    }

    public function getReviewerUserGroups($site)
    {
        $userGroups = [];
        $siteGroups = $this->reviewerUserGroups[$site->uid] ?? [];

        // For when no items are passed, this will be a string
        if (!is_array($siteGroups)) {
            $siteGroups = [];
        }

        foreach ($siteGroups as $siteGroup) {
            // Get UID from first element in array
            $uid = $siteGroup[0] ?? null;

            if ($uid === null) {
                continue;
            }

            $userGroup = Craft::$app->getUserGroups()->getGroupByUid($uid);

            if ($userGroup !== null) {
                $userGroups[] = $userGroup;
            }
        }

        return $userGroups;
    }

    public function getReviewerUserGroupsUids($site)
    {
        $uids = [];

        foreach (ArrayHelper::getColumn($this->getReviewerUserGroups($site), 'uid') as $value) {
            $uids[] = [$value];
        }

        return $uids;
    }

    public function getPublisherUserGroup($site)
    {
        $groupUid = $this->publisherUserGroup[$site->uid] ?? null;

        if ($groupUid) {
            return Craft::$app->getUserGroups()->getGroupByUid($groupUid);
        }

        return null;
    }

    public function getPublisherUserGroupUid($site)
    {
        return $this->getPublisherUserGroup($site)->uid ?? null;
    }

    public function getEditorNotesRequired($site)
    {
        return $this->editorNotesRequired[$site->uid] ?? false;
    }

    public function getPublisherNotesRequired($site)
    {
        return $this->publisherNotesRequired[$site->uid] ?? false;
    }

    public function getPublishersForNotificationEmail($site): array
    {
        // Get the user group for email notifications
        $publisherGroup = $this->publisherNotificationsUserGroup ?? $this->getPublisherUserGroup($site);

        if (!$publisherGroup) {
            return [];
        }

        return User::find()->groupId($publisherGroup->id)->all();
    }
}
