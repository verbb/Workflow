<?php
namespace verbb\workflow\models;

use Craft;
use craft\base\Model;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    // General
    public $editorUserGroup = [];
    public $reviewerUserGroups = [];
    public $publisherUserGroup = [];
    public $editorNotesRequired = [];
    public $publisherNotesRequired = [];
    public $lockDraftSubmissions = true;

    // Notifications
    public $editorNotifications = true;
    public $editorNotificationsOptions = [];
    public $reviewerNotifications = true;
    public $reviewerApprovalNotifications = false;
    public $publisherNotifications = true;
    public $selectedPublishers = '*';

    // Permissions
    public $enabledSections = '*';


    // Public Methods
    // =========================================================================

    public function getEditorUserGroup($site)
    {
        $groupUid = $this->editorUserGroup[$site->uid] ?? null;

        if ($groupUid) {
            return Craft::$app->userGroups->getGroupByUid($groupUid);
        }

        return null;
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

    public function getPublisherUserGroup($site)
    {
        $groupUid = $this->publisherUserGroup[$site->uid] ?? null;

        if ($groupUid) {
            return Craft::$app->userGroups->getGroupByUid($groupUid);
        }

        return null;
    }

    public function getEditorNotesRequired($site)
    {
        return $this->editorNotesRequired[$site->uid] ?? false;
    }

    public function getPublisherNotesRequired($site)
    {
        return $this->publisherNotesRequired[$site->uid] ?? false;
    }
}
