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
  'All submissions' => 'All submissions',
  'Approve and publish' => 'Approve and publish',
  'Approved' => 'Approved',
  'Are you sure you want to delete this review?' => 'Are you sure you want to delete this review?',
  'Are you sure you want to delete this submission?' => 'Are you sure you want to delete this submission?',
  'Awaiting approval' => 'Awaiting approval',
  'Awaiting review' => 'Awaiting review',
  'Close' => 'Close',
  'Could not approve and publish.' => 'Could not approve and publish.',
  'Could not revoke submission.' => 'Could not revoke submission.',
  'Could not save review.' => 'Could not save review.',
  'Could not submit for approval.' => 'Could not submit for approval.',
  'Could not update status due to a validation error.' => 'Could not update status due to a validation error.',
  'Could not update statuses due to validation errors.' => 'Could not update statuses due to validation errors.',
  'Date Submitted' => 'Date Submitted',
  'Editor' => 'Editor',
  'Entry' => 'Entry',
  'Entry approved and published.' => 'Entry approved and published.',
  'Entry submitted for approval.' => 'Entry submitted for approval.',
  'Last Reviewed' => 'Last Reviewed',
  'Last Reviewed By' => 'Last Reviewed By',
  'No review exists with the ID “{id}”.' => 'No review exists with the ID “{id}”.',
  'No reviews for this submission.' => 'No reviews for this submission.',
  'No submissions.' => 'No submissions.',
  'No submission with the ID “{id}”' => 'No submission with the ID “{id}”',
  'Notes' => 'Notes',
  'Notes are required' => 'Notes are required',
  'Number of Reviewers' => 'Number of Reviewers',
  'Overview' => 'Overview',
  'Pending' => 'Pending',
  'Publisher' => 'Publisher',
  'Publishers To Receive Notifications' => 'Publishers To Receive Notifications',
  'Rejected' => 'Rejected',
  'Review deleted.' => 'Review deleted.',
  'Reviewer' => 'Reviewer',
  'Revoked' => 'Revoked',
  'Revoke submission' => 'Revoke submission',
  'Save' => 'Save',
  'Save draft and submit for review' => 'Save draft and submit for review',
  'Select all, or specific publishers to receive email notifications. By default, all will be notified.' => 'Select all, or specific publishers to receive email notifications. By default, all will be notified.',
  'Select a Publisher User Group first.' => 'Select a Publisher User Group first.',
  'Set status' => 'Set status',
  'Settings' => 'Settings',
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
  'Unable to find submission.' => 'Unable to find submission.',
  'Unable to save submission.' => 'Unable to save submission.',
  'View changes' => 'View changes',
  'View submissions' => 'View submissions',
  'Workflow' => 'Workflow',
  'Workflow Submissions' => 'Workflow Submissions',
  'You cannot approve your own submission.' => 'You cannot approve your own submission.',
  '[Deleted element]' => '[Deleted element]',
  '{role} Notes: “{note}”' => '{role} Notes: “{note}”',
  '{status} submission' => '{status} submission',
  '{status} this submission on {date}.' => '{status} this submission on {date}.',
];