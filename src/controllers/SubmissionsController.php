<?php
namespace verbb\workflow\controllers;

use verbb\workflow\Workflow;

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\controllers\BaseEntriesController;
use craft\elements\Entry;
use craft\helpers\DateTimeHelper;
use craft\helpers\ElementHelper;

use yii\web\Response;

class SubmissionsController extends BaseEntriesController
{
    // Public Methods
    // =========================================================================

    public function beforeAction($action): bool
    {
        // Until I can find a better way to handle firing this before an action...
        $settings = Workflow::$plugin->getSettings();
        $request = Craft::$app->getRequest();
        $workflowAction = $request->getBodyParam('workflow-action');

        $editorNotes = $request->getBodyParam('editorNotes');
        $publisherNotes = $request->getBodyParam('publisherNotes');

        // Save the notes for later, due to a number of different events triggering
        Craft::$app->getUrlManager()->setRouteParams([
            'editorNotes' => $editorNotes,
            'publisherNotes' => $publisherNotes,
        ]);

        if ($workflowAction === 'save-submission') {
            // We also need to validate notes fields, if required before we save the entry
            if ($settings->editorNotesRequired && !$editorNotes) {
                Craft::$app->getUrlManager()->setRouteParams([
                    'editorNotesErrors' => [Craft::t('workflow', 'Editor notes are required')],
                    'entry' => $this->getDraftEntry(),
                ]);

                return false;
            }
        }

        if ($workflowAction === 'approve-submission' || $workflowAction === 'approve-only-submission' || $workflowAction === 'reject-submission') {
            // We also need to validate notes fields, if required before we save the entry
            if ($settings->publisherNotesRequired && !$publisherNotes) {
                Craft::$app->getUrlManager()->setRouteParams([
                    'publisherNotesErrors' => [Craft::t('workflow', 'Publisher notes are required')],
                    'entry' => $this->getDraftEntry(),
                ]);

                return false;
            }
        }

        return parent::beforeAction($action);
    }

    public function actionUnsavedDraftSubmission(): ?Response
    {
        // We're already checking validation in our beforeAction
        return Craft::$app->runAction('elements/save-draft');
    }

    public function actionSaveDraft(): ?Response
    {
        // Set the param here, because the front-end can only support a single param form data
        $params = Craft::$app->getRequest()->getBodyParams();
        $params['dropProvisional'] = true;

        Craft::$app->getRequest()->setBodyParams($params);

        // We're already checking validation in our beforeAction
        return Craft::$app->runAction('elements/save-draft');
    }

    public function actionPublishDraft(): ?Response
    {
        // We're already checking validation in our beforeAction
        return Craft::$app->runAction('elements/apply-draft');
    }

    public function actionPublishEntry(): ?Response
    {
        // We're already checking validation in our beforeAction
        return Craft::$app->runAction('elements/save');
    }


    // Private Methods
    // =========================================================================

    private function getDraftEntry(): ?ElementInterface
    {
        $request = Craft::$app->getRequest();

        $draftId = $request->getBodyParam('draftId');
        $entryId = $request->getBodyParam('entryId');
        $siteId = $request->getBodyParam('siteId') ?: Craft::$app->getSites()->getPrimarySite()->id;
        $fieldsLocation = $request->getParam('fieldsLocation', 'fields');

        $entry = null;

        if ($draftId) {
            $entry = Entry::find()
                ->draftId($draftId)
                ->siteId($siteId)
                ->status(null)
                ->one();
        }

        if ($entryId) {
            $entry = Entry::find()
                ->id($entryId)
                ->siteId($siteId)
                ->status(null)
                ->one();
        }

        if ($entry) {
            $this->_setDraftAttributesFromPost($entry);
            $entry->setFieldValuesFromRequest($fieldsLocation);
            $entry->updateTitle();
            $entry->setScenario(Element::SCENARIO_ESSENTIALS);

            return $entry;
        }

        return $entry;
    }

    private function _setDraftAttributesFromPost(Entry $draft): void
    {
        $request = Craft::$app->getRequest();

        $draft->typeId = $request->getBodyParam('typeId');

        // Prevent the last entry type's field layout from being used
        $draft->fieldLayoutId = null;

        // Default to a temp slug to avoid slug validation errors
        $tempSlug = (ElementHelper::isTempSlug($draft->slug) ? $draft->slug : ElementHelper::tempSlug());
        $draft->slug = $request->getBodyParam('slug') ?: $tempSlug;

        if (($postDate = $request->getBodyParam('postDate')) !== null) {
            $draft->postDate = DateTimeHelper::toDateTime($postDate) ?: null;
        }

        if (($expiryDate = $request->getBodyParam('expiryDate')) !== null) {
            $draft->expiryDate = DateTimeHelper::toDateTime($expiryDate) ?: null;
        }

        $enabledForSite = $this->enabledForSiteValue();

        if (is_array($enabledForSite)) {
            // Set the global status to true if it's enabled for *any* sites, or if already enabled.
            $draft->enabled = in_array(true, $enabledForSite, false) || $draft->enabled;
        } else {
            $draft->enabled = (bool)$request->getBodyParam('enabled', $draft->enabled);
        }

        $draft->setEnabledForSite($enabledForSite ?? $draft->getEnabledForSite());
        $draft->title = $request->getBodyParam('title');

        if (!$draft->typeId) {
            // Default to the section's first entry type
            $draft->typeId = $draft->getSection()->getEntryTypes()[0]->id;
            // Prevent the last entry type's field layout from being used
            $draft->fieldLayoutId = null;
        }

        // Author
        $authorId = $request->getBodyParam('author', ($draft->authorId ?: Craft::$app->getUser()->getIdentity()->id));

        if (is_array($authorId)) {
            $authorId = $authorId[0] ?? null;
        }

        $draft->authorId = $authorId;

        // Parent
        // $parentId = $request->getBodyParam('parentId');

        // if (is_array($parentId)) {
        //     $parentId = $parentId[0] ?? null;
        // }

        // $draft->newParentId = $parentId ?: null;
    }
}
