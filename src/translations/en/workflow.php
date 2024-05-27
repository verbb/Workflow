<?php

return [
  //
  // Email Messages
  //
  'workflow_publisher_notification_heading' => 'When an editor submits entry for approval:',
  'workflow_publisher_notification_subject' => '"{{ submission.ownerTitle }}" has been submitted for approval on {{ submission.getOwnerSite() }}.',
  'workflow_publisher_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
    "{{ review.user }} has submitted the entry \"{{ submission.ownerTitle }}\" for approval on {{ submission.ownerSite }}.\n\n" .
    "{% if review.notes %}{{ review.roleName }} Notes: \"{{ review.notes }}\"\n\n{% endif %}" .
    "To review it please log into your control panel.\n\n" .
    "{{ submission.ownerCpUrl }}",

  'workflow_editor_review_notification_heading' => 'When a reviewer approves or rejects an editor submission:',
  'workflow_editor_review_notification_subject' => 'Your submission for "{{ submission.ownerTitle }}" has been {{ review.status }} on {{ submission.ownerSite }}.',
  'workflow_editor_review_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
    "Your submission for {{ submission.ownerTitle }} has been {{ review.status }} {{ review.dateCreated | date }} on {{ submission.ownerSite }}.\n\n" .
    "{% if review.notes %}{{ review.roleName }} Notes: \"{{ review.notes }}\"\n\n{% endif %}" .
    "View your submission by logging into your control panel.\n\n" .
    "{{ submission.ownerCpUrl }}",

  'workflow_editor_notification_heading' => 'When a publisher approves or rejects an editor submission:',
  'workflow_editor_notification_subject' => 'Your submission for "{{ submission.ownerTitle }}" has been {{ review.status }} on {{ submission.ownerSite }}.',
  'workflow_editor_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
    "Your submission for {{ submission.ownerTitle }} has been {{ review.status }} {{ review.dateCreated | date }} on {{ submission.ownerSite }}.\n\n" .
    "{% if review.notes %}{{ review.roleName }} Notes: \"{{ review.notes }}\"\n\n{% endif %}" .
    "View your submission by logging into your control panel.\n\n" .
    "{{ submission.ownerCpUrl }}",

  'workflow_published_author_notification_heading' => 'When a publisher approves and publishes an entry to notify the entry author:',
  'workflow_published_author_notification_subject' => 'Your entry "{{ submission.ownerTitle }}" has been published on {{ submission.ownerSite }}.',
  'workflow_published_author_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
    "Your entry {{ submission.ownerTitle }} has been published {{ review.dateCreated | date }} on {{ submission.ownerSite }}.\n\n" .
    "View your entry by logging into your control panel.\n\n" .
    "{{ submission.ownerCpUrl }}",


  'Action #{num}' => 'Action #{num}',
  'Add a user group' => 'Add a user group',
  'All' => 'All',
  'All submissions' => 'All submissions',
  'Approve' => 'Approve',
  'Approve and publish' => 'Approve and publish',
  'Approved' => 'Approved',
  'Approve only' => 'Approve only',
  'Are you sure you want to delete this review?' => 'Are you sure you want to delete this review?',
  'Are you sure you want to delete this submission?' => 'Are you sure you want to delete this submission?',
  'Awaiting approval' => 'Awaiting approval',
  'Awaiting review' => 'Awaiting review',
  'CC Publisher Email' => 'CC Publisher Email',
  'CC Reviewer Email' => 'CC Reviewer Email',
  'Changing this may result in submissions being lost in the review process.' => 'Changing this may result in submissions being lost in the review process.',
  'Close' => 'Close',
  'Could not approve and publish.' => 'Could not approve and publish.',
  'Could not revoke submission.' => 'Could not revoke submission.',
  'Could not save review.' => 'Could not save review.',
  'Could not submit for approval.' => 'Could not submit for approval.',
  'Could not update status due to a validation error.' => 'Could not update status due to a validation error.',
  'Could not update statuses due to validation errors.' => 'Could not update statuses due to validation errors.',
  'created' => 'created',
  'Date Submitted' => 'Date Submitted',
  'Editor' => 'Editor',
  'Editor Notifications' => 'Editor Notifications',
  'Editor Notifications - Additional Options' => 'Editor Notifications - Additional Options',
  'Editor Submission Notes Required' => 'Editor Submission Notes Required',
  'Editor User Group' => 'Editor User Group',
  'Enabled Sections' => 'Enabled Sections',
  'Entry' => 'Entry',
  'Entry approved and published.' => 'Entry approved and published.',
  'Entry submitted for approval.' => 'Entry submitted for approval.',
  'Failed to send editor notification to {value} - “{message}” {file}:{line}' => 'Failed to send editor notification to {value} - “{message}” {file}:{line}',
  'Failed to send published author notification to {value} - “{message}” {file}:{line}' => 'Failed to send published author notification to {value} - “{message}” {file}:{line}',
  'Failed to send publisher notification to {value} - “{message}” {file}:{line}' => 'Failed to send publisher notification to {value} - “{message}” {file}:{line}',
  'Failed to send reviewer notification to {value} - “{message}” {file}:{line}' => 'Failed to send reviewer notification to {value} - “{message}” {file}:{line}',
  'General Settings' => 'General Settings',
  'Last Reviewed' => 'Last Reviewed',
  'Last Reviewed By' => 'Last Reviewed By',
  'Limit' => 'Limit',
  'Lock Draft Submissions' => 'Lock Draft Submissions',
  'None' => 'None',
  'No review exists with the ID “{id}”.' => 'No review exists with the ID “{id}”.',
  'No reviews for this submission.' => 'No reviews for this submission.',
  'No submissions.' => 'No submissions.',
  'No submission with the ID “{id}”' => 'No submission with the ID “{id}”',
  'Notes' => 'Notes',
  'Notes about your response.' => 'Notes about your response.',
  'Notes about your submission' => 'Notes about your submission',
  'Notes about your submission (required)' => 'Notes about your submission (required)',
  'Notes are required' => 'Notes are required',
  'Notifications' => 'Notifications',
  'Number of Reviewers' => 'Number of Reviewers',
  'Overview' => 'Overview',
  'Pending' => 'Pending',
  'Permissions' => 'Permissions',
  'Published Author Notifications' => 'Published Author Notifications',
  'Publisher' => 'Publisher',
  'Publisher Notifications' => 'Publisher Notifications',
  'Publishers To Receive Notifications' => 'Publishers To Receive Notifications',
  'Publisher Submission Notes Required' => 'Publisher Submission Notes Required',
  'Publisher User Group' => 'Publisher User Group',
  'Reject' => 'Reject',
  'Rejected' => 'Rejected',
  'Reply-To Publisher Email' => 'Reply-To Publisher Email',
  'Reply-To Reviewer Email' => 'Reply-To Reviewer Email',
  'Review deleted.' => 'Review deleted.',
  'Reviewer' => 'Reviewer',
  'Reviewer Approval Notifications' => 'Reviewer Approval Notifications',
  'Reviewer Notifications' => 'Reviewer Notifications',
  'Reviewer User Groups' => 'Reviewer User Groups',
  'Revoked' => 'Revoked',
  'Revoke submission' => 'Revoke submission',
  'Save' => 'Save',
  'Save draft and submit for review' => 'Save draft and submit for review',
  'Select all, or specific publishers to receive email notifications. By default, all will be notified.' => 'Select all, or specific publishers to receive email notifications. By default, all will be notified.',
  'Select a Publisher User Group first.' => 'Select a Publisher User Group first.',
  'Select the user groups that your reviewers belong to. Reviewers are users that can review and edit submissions and pass them along for approval, but not publish live. The review process flows from the first to the last user group in the table.' => 'Select the user groups that your reviewers belong to. Reviewers are users that can review and edit submissions and pass them along for approval, but not publish live. The review process flows from the first to the last user group in the table.',
  'Select the user group that your editors belong to. Editors are users that can edit content, but not publish live.' => 'Select the user group that your editors belong to. Editors are users that can edit content, but not publish live.',
  'Select the user group that your publishers belong to. Publishers are users who are notified when an editor submits content for review, and can approve content to be published live.' => 'Select the user group that your publishers belong to. Publishers are users who are notified when an editor submits content for review, and can approve content to be published live.',
  'Select which sections the workflow should be enabled for.' => 'Select which sections the workflow should be enabled for.',
  'Set status' => 'Set status',
  'Settings' => 'Settings',
  'Show submissions for certain status.' => 'Show submissions for certain status.',
  'Site' => 'Site',
  'Status' => 'Status',
  'Statuses updated.' => 'Statuses updated.',
  'Status updated, with some failures due to validation errors.' => 'Status updated, with some failures due to validation errors.',
  'Status updated.' => 'Status updated.',
  'Submission' => 'Submission',
  'Submission approved.' => 'Submission approved.',
  'Submission deleted.' => 'Submission deleted.',
  'Submission for “{title}” on {date}' => 'Submission for “{title}” on {date}',
  'Submission ID' => 'Submission ID',
  'Submission on {date}.' => 'Submission on {date}.',
  'Submission rejected.' => 'Submission rejected.',
  'Submission revoked.' => 'Submission revoked.',
  'Submission saved successfully.' => 'Submission saved successfully.',
  'Submit for review' => 'Submit for review',
  'submitted this entry for review on {date}. Please review this entry before approving' => 'submitted this entry for review on {date}. Please review this entry before approving',
  'Submitting this entry for review will lock further edits and notify the next editors in the approval process that this entry is ready for approval.' => 'Submitting this entry for review will lock further edits and notify the next editors in the approval process that this entry is ready for approval.',
  'This content has been added.' => 'This content has been added.',
  'This content has been changed.' => 'This content has been changed.',
  'This content has been removed.' => 'This content has been removed.',
  'This entry was submitted for review on {date} and is awaiting approval. Changes cannot be made until approved.' => 'This entry was submitted for review on {date} and is awaiting approval. Changes cannot be made until approved.',
  'Total Changes' => 'Total Changes',
  'Total Reviews' => 'Total Reviews',
  'Unable to delete review.' => 'Unable to delete review.',
  'Unable to delete submission.' => 'Unable to delete submission.',
  'Unable to determine field layout for entry.' => 'Unable to determine field layout for entry.',
  'Unable to edit entry once it has been submitted for review.' => 'Unable to edit entry once it has been submitted for review.',
  'Unable to find owner entry "{id}".' => 'Unable to find owner entry "{id}".',
  'Unable to find submission.' => 'Unable to find submission.',
  'Unable to save submission.' => 'Unable to save submission.',
  'User Group' => 'User Group',
  'View changes' => 'View changes',
  'View submissions' => 'View submissions',
  'Whether an entry should be locked for editing after it‘s been submitted for review.' => 'Whether an entry should be locked for editing after it‘s been submitted for review.',
  'Whether editor notifications should include the reviewer‘s or publisher‘s email whose triggered the action.' => 'Whether editor notifications should include the reviewer‘s or publisher‘s email whose triggered the action.',
  'Whether editors are required to enter a note in their submissions.' => 'Whether editors are required to enter a note in their submissions.',
  'Whether email notifications should be delivered to editors when each reviewer approves an entry after review.' => 'Whether email notifications should be delivered to editors when each reviewer approves an entry after review.',
  'Whether email notifications should be delivered to individual editors when approved or rejected.' => 'Whether email notifications should be delivered to individual editors when approved or rejected.',
  'Whether email notifications should be delivered to publishers when editors submit an entry for review.' => 'Whether email notifications should be delivered to publishers when editors submit an entry for review.',
  'Whether email notifications should be delivered to reviewers when editors submit an entry for review.' => 'Whether email notifications should be delivered to reviewers when editors submit an entry for review.',
  'Whether email notifications should be delivered to the entry author when approved and published by a Publisher.' => 'Whether email notifications should be delivered to the entry author when approved and published by a Publisher.',
  'Whether publishers are required to enter a note in their submissions.' => 'Whether publishers are required to enter a note in their submissions.',
  'Workflow' => 'Workflow',
  'Workflow Submissions' => 'Workflow Submissions',
  'You cannot approve your own submission.' => 'You cannot approve your own submission.',
  '[Deleted element]' => '[Deleted element]',
  '{role} Notes: “{note}”' => '{role} Notes: “{note}”',
  '{status} submission' => '{status} submission',
  '{status} this submission on {date}.' => '{status} this submission on {date}.',
];