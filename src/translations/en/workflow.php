<?php

return [
    //
    // Email Messages
    //

    'workflow_publisher_notification_heading' => 'When an editor submits entry for approval:',
    'workflow_publisher_notification_subject' => '"{{ submission.getOwner().title }}" has been submitted for approval on {{ submission.getOwnerSite() }}.',
    'workflow_publisher_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
        "{{ submission.editor }} has submitted the entry \"{{ submission.getOwner().title }}\" for approval on {{ submission.getOwnerSite() }}.\n\n" .
        "{% if submission.editorNotes %}Notes: \"{{ submission.editorNotes }}\"\n\n{% endif %}" .
        "To review it please log into your control panel.\n\n" .
        "{{ submission.cpEditUrl }}",

    'workflow_editor_review_notification_heading' => 'When a reviewer approves or rejects an editor submission:',
    'workflow_editor_review_notification_subject' => 'Your submission for "{{ submission.getOwner().title }}" has been {{ review.approved ? \'approved\' : \'rejected\' }} on {{ submission.getOwnerSite() }}.',
    'workflow_editor_review_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
        "Your submission for {{ submission.getOwner().title }} has been {{ review.approved ? 'approved' : 'rejected' }} {{ review.dateCreated | date }} on {{ submission.getOwnerSite() }}.\n\n" .
        "{% if review.notes %}Notes: \"{{ review.notes }}\"\n\n{% endif %}" .
        "View your submission by logging into your control panel.\n\n" .
        "{{ submission.cpEditUrl }}",

    'workflow_editor_notification_heading' => 'When a publisher approves or rejects an editor submission:',
    'workflow_editor_notification_subject' => 'Your submission for "{{ submission.getOwner().title }}" has been {{ submission.status }} on {{ submission.getOwnerSite() }}.',
    'workflow_editor_notification_body' => "Hey {{ user.friendlyName }},\n\n" .
        "Your submission for {{ submission.getOwner().title }} has been {{ submission.status }} {{ (submission.status == 'approved') ? submission.dateApproved | date : submission.dateRejected | date }} on {{ submission.getOwnerSite() }}.\n\n" .
        "{% if submission.publisherNotes %}Notes: \"{{ submission.publisherNotes }}\"\n\n{% endif %}" .
        "View your submission by logging into your control panel.\n\n" .
        "{{ submission.cpEditUrl }}",
    'Workflow Submissions' => 'Workflow Submissions',
    'Whether publishers are required to enter a note in their submissions.' => 'Whether publishers are required to enter a note in their submissions.',
    'Select the user groups that your reviewers belong to. Reviewers are users that can review and edit submissions and pass them along for approval, but not publish live. The review process flows from the first to the last user group in the table.' => 'Select the user groups that your reviewers belong to. Reviewers are users that can review and edit submissions and pass them along for approval, but not publish live. The review process flows from the first to the last user group in the table.',
    'Rejected' => 'Rejected',
    'Select the user group that your editors belong to. Editors are users that can edit content, but not publish live.' => 'Select the user group that your editors belong to. Editors are users that can edit content, but not publish live.',
    'CC Publisher Email' => 'CC Publisher Email',
    'Could not approve and publish.' => 'Could not approve and publish.',
    'Publisher Submission Notes Required' => 'Publisher Submission Notes Required',
    'Reject' => 'Reject',
    'Could not submit for approval.' => 'Could not submit for approval.',
    'Whether email notifications should be delivered to individual editors when approved or rejected.' => 'Whether email notifications should be delivered to individual editors when approved or rejected.',
    'Settings' => 'Settings',
    'Failed to send publisher notification to {value} - “{message}” {file}:{line}' => 'Failed to send publisher notification to {value} - “{message}” {file}:{line}',
    'Select all, or specific publishers to receive email notifications. By default, all will be notified.' => 'Select all, or specific publishers to receive email notifications. By default, all will be notified.',
    'Status' => 'Status',
    'Select the user group that your publishers belong to. Publishers are users who are notified when an editor submits content for review, and can approve content to be published live.' => 'Select the user group that your publishers belong to. Publishers are users who are notified when an editor submits content for review, and can approve content to be published live.',
    'Awaiting review' => 'Awaiting review',
    'Whether email notifications should be delivered to editors when each reviewer approves an entry after review.' => 'Whether email notifications should be delivered to editors when each reviewer approves an entry after review.',
    'Workflow' => 'Workflow',
    'Date Approved' => 'Date Approved',
    'Failed to send reviewer notification to {value} - “{message}” {file}:{line}' => 'Failed to send reviewer notification to {value} - “{message}” {file}:{line}',
    'General Settings' => 'General Settings',
    'Reply-To Reviewer Email' => 'Reply-To Reviewer Email',
    'submitted this entry for review on {date}. Please review this entry before publishing.' => 'submitted this entry for review on {date}. Please review this entry before publishing.',
    'Submit for review' => 'Submit for review',
    'Save draft and submit for review' => 'Save draft and submit for review',
    'Site' => 'Site',
    'Publisher Notes' => 'Publisher Notes',
    'Reviewer Notes' => 'Reviewer Notes',
    'Failed to send editor notification to {value} - “{message}” {file}:{line}' => 'Failed to send editor notification to {value} - “{message}” {file}:{line}',
    'Are you sure you want to delete the selected submissions?' => 'Are you sure you want to delete the selected submissions?',
    'Last Reviewed' => 'Last Reviewed',
    'Rejected submission' => 'Rejected submission',
    'Entry' => 'Entry',
    'Submissions deleted.' => 'Submissions deleted.',
    'Whether editors are required to enter a note in their submissions.' => 'Whether editors are required to enter a note in their submissions.',
    'Editor Notifications - Additional Options' => 'Editor Notifications - Additional Options',
    'Reviewer User Groups' => 'Reviewer User Groups',
    'Approve only' => 'Approve only',
    'Could not approve submission.' => 'Could not approve submission.',
    'Editor Notifications' => 'Editor Notifications',
    'Date Rejected' => 'Date Rejected',
    'Publisher' => 'Publisher',
    'Submission approved.' => 'Submission approved.',
    'Editor Submission Notes Required' => 'Editor Submission Notes Required',
    'Reply-To Publisher Email' => 'Reply-To Publisher Email',
    'Reviewer Approval Notifications' => 'Reviewer Approval Notifications',
    'Entry submitted for approval.' => 'Entry submitted for approval.',
    'No submission with the ID “{id}”' => 'No submission with the ID “{id}”',
    'Submitting this entry for review will lock further edits and notify the next editors in the approval process that this entry is ready for approval.' => 'Submitting this entry for review will lock further edits and notify the next editors in the approval process that this entry is ready for approval.',
    'This entry was submitted for review on {date} and is awaiting approval. Changes cannot be made until approved.' => 'This entry was submitted for review on {date} and is awaiting approval. Changes cannot be made until approved.',
    'None' => 'None',
    'All' => 'All',
    'Whether an entry should be locked for editing after it‘s been submitted for review.' => 'Whether an entry should be locked for editing after it‘s been submitted for review.',
    'Publisher notes are required' => 'Publisher notes are required',
    'Workflow Submission' => 'Workflow Submission',
    'revoked this entry on {date}.' => 'revoked this entry on {date}.',
    'submitted this entry for review on {date}. Please review this entry before approving.' => 'submitted this entry for review on {date}. Please review this entry before approving.',
    'Status updated.' => 'Status updated.',
    'Could not reject submission.' => 'Could not reject submission.',
    'Select which sections the workflow should be enabled for.' => 'Select which sections the workflow should be enabled for.',
    'Reviewer Notifications' => 'Reviewer Notifications',
    'Could not update status due to a validation error.' => 'Could not update status due to a validation error.',
    'Add a user group' => 'Add a user group',
    'Permissions' => 'Permissions',
    'Revoked submission' => 'Revoked submission',
    'Publisher User Group' => 'Publisher User Group',
    'Editor User Group' => 'Editor User Group',
    'Approved' => 'Approved',
    'Status updated, with some failures due to validation errors.' => 'Status updated, with some failures due to validation errors.',
    'Approved submission' => 'Approved submission',
    'Statuses updated.' => 'Statuses updated.',
    's email whose triggered the action.' => 's email whose triggered the action.',
    'Unable to edit entry once it has been submitted for review.' => 'Unable to edit entry once it has been submitted for review.',
    'Could not update statuses due to validation errors.' => 'Could not update statuses due to validation errors.',
    'Whether email notifications should be delivered to publishers when editors submit an entry for review.' => 'Whether email notifications should be delivered to publishers when editors submit an entry for review.',
    'Revoked' => 'Revoked',
    'Date Submitted' => 'Date Submitted',
    'CC Reviewer Email' => 'CC Reviewer Email',
    'No submissions.' => 'No submissions.',
    'Awaiting approval' => 'Awaiting approval',
    'Notifications' => 'Notifications',
    'rejected this entry on {date}.' => 'rejected this entry on {date}.',
    'Select a Publisher User Group first.' => 'Select a Publisher User Group first.',
    'approved this entry on {date}.' => 'approved this entry on {date}.',
    'Editor Notes' => 'Editor Notes',
    'Entry approved and published.' => 'Entry approved and published.',
    'Submission rejected.' => 'Submission rejected.',
    'Publisher Notifications' => 'Publisher Notifications',
    'Publishers To Receive Notifications' => 'Publishers To Receive Notifications',
    'Could not revoke submission.' => 'Could not revoke submission.',
    'revoked this submission on {date}.' => 'revoked this submission on {date}.',
    'All submissions' => 'All submissions',
    'User Group' => 'User Group',
    'Last Reviewed By' => 'Last Reviewed By',
    'Editor notes are required' => 'Editor notes are required',
    'Approve' => 'Approve',
    'Lock Draft Submissions' => 'Lock Draft Submissions',
    'Enabled Sections' => 'Enabled Sections',
    'Show submissions for certain status.' => 'Show submissions for certain status.',
    'Notes about your response.' => 'Notes about your response.',
    'Overview' => 'Overview',
    '[Deleted element]' => '[Deleted element]',
    'Revoke submission' => 'Revoke submission',
    'Changing this may result in submissions being lost in the review process.' => 'Changing this may result in submissions being lost in the review process.',
    'Whether email notifications should be delivered to reviewers when editors submit an entry for review.' => 'Whether email notifications should be delivered to reviewers when editors submit an entry for review.',
    'Submission revoked.' => 'Submission revoked.',
    'Limit' => 'Limit',
    'Approve and publish' => 'Approve and publish',
    'Editor' => 'Editor',
    'Set status' => 'Set status',
    'Pending' => 'Pending',
];
