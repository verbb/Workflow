# Changelog

## 3.0.6 - 2025-02-02

### Added
- Add “Publisher Notifications User Group” to optionally specify a user group just for publisher notifications.

### Changed
- Change apply-draft behaviour to use onBeforeApplyDraft to handle applying drafts on existing entries, before the draft is deleted.
- When applying a draft entry, and a pending submission is found, and the current user is a publisher, the submission is now automatically approved.

### Fixed
- Fix an error when editors make a submission on a new draft for an existing entry.

### Removed
- Remove “Editor” and “Publisher” sort options for submission index.

## 3.0.5 - 2024-11-28

### Fixed
- Fix when deleting a Craft User that owned a review, would also delete that review.
- Fix an error when approving a submission. (thanks @iainsaxon).

## 3.0.4 - 2024-10-09

### Fixed
- Add the ability to filter submissions for specific sites on the Recent Submissions dashboard widget.

## 3.0.3 - 2024-09-07

### Fixed
- Fix an issue where draft Matrix blocks (entries) were being used for submissions.

## 3.0.2 - 2024-08-09

### Fixed
- Fix email messages translations.

## 3.0.1 - 2024-07-21

### Added
- Add editor name to submission dashboard widget items.
- Add error handling when trying to set a non-pending submission to pending.
- Add the “Overview” subnav item to the Workflow menu.
- Add Craft Teams support for permissions.

### Changed
- Update non-English translations.
- Update English translations.
- “Overview” has been changed to “Submissions”.

### Fixed
- Fix an error when comparing reviews with no data.
- Fix submission edit breadcrumb.
- Fix submission edit save button alignment.
- Fix permissions check for viewing submissions.
- Fix viewing a submission when the element was deleted.
- Fix a PHP 8.3 error.
- Fix summary number alignments.

## 3.0.0 - 2024-05-18

### Changed
- Now requires PHP `8.2.0+`.
- Now requires Craft `5.0.0+`.

## 2.0.14 - 2025-02-02

### Added
- Add “Publisher Notifications User Group” to optionally specify a user group just for publisher notifications.

### Changed
- Change apply-draft behaviour to use onBeforeApplyDraft to handle applying drafts on existing entries, before the draft is deleted.
- When applying a draft entry, and a pending submission is found, and the current user is a publisher, the submission is now automatically approved.

### Fixed
- Fix an error when editors make a submission on a new draft for an existing entry.

### Removed
- Remove “Editor” and “Publisher” sort options for submission index.

## 2.0.13 - 2024-11-28

### Fixed
- Fix when deleting a Craft User that owned a review, would also delete that review.
- Fix an error when approving a submission. (thanks @iainsaxon).

## 2.0.12 - 2024-10-09

### Fixed
- Add the ability to filter submissions for specific sites on the Recent Submissions dashboard widget.

## 2.0.11 - 2024-07-21

### Added
- Add editor name to submission dashboard widget items.

### Changed
- Update non-English translations.
- Update English translations.

### Fixed
- Fix an error when comparing reviews with no data.

## 2.0.10 - 2024-05-18

### Changed
- Update non-English translations.
- Update English translations.

### Fixed
- Fix an error when trying to resolve an entry from front-end submissions.

## 2.0.9 - 2024-03-04

### Fixed
- Fix an incorrect URL for draft submissions in email notifications.
- Fix performance issues with review memoization due to performance issues for large installs.
- Fix settings dropdown showing for reviews when editing a submission.

## 2.0.8 - 2024-01-30

### Fixed
- Fix dashboard widget icon.
- Fix an error when saving submissions in the control panel for multi-sites.
- Fix an error when showing submission notes in the element index.
- Fix an error when determining the last review for a submission.
- Fix "Element query executed before Craft is fully initialized" warning.
- Fix submissions pane showing for non-draft, published entries when it should only show for drafts.

## 2.0.7 - 2023-12-08

### Added
- Add read-only state for submission detail pages for editors to view submission detail.
- Add output for reviews when comparing and their owner or submission can’t be found.
- Add several translations. (thanks @watarutmnh).

### Changed
- The Workflow control panel menu item now will only show if the user has “Overview” permission.

### Fixed
- Fix comparing reviews not working on specific multi-site setups.
- Fix an error when trying to determine whether a review’s element is a draft.

## 2.0.6 - 2023-10-25

### Added
- Add support for editor + reviewer dual role.

### Fixed
- Fix an error when comparing reviews.
- Fix required notes not being enforced.
- Fix special characters in submission notes not working correctly.

## 2.0.5 - 2023-04-28

### Added
- Add type checks for sanitize/unsanitize notes.
- Add handling for migrating to Reviews on invalid review data (coming from old installs and submission data).

### Fixed
- Fix Emoji support for notes in Craft 4.4+.

## 2.0.4 - 2023-02-11

### Changed
- Update front-end controller to use `workflow/elements/save-entry`.
- Only admins are now allowed to access Workflow settings.

### Fixed
- Fix an error with sending published author notification emails.
- Fix special characters in submission notes not working correctly.
- Fix front-end submissions not working for Ajax.
- Fix site-based submission email notification.
- Fix an error when trying to approve/publish submissions made from the front-end.

### Removed
- Removed `Settings` Workflow user permission.

## 2.0.3 - 2022-12-25

### Added
- Add fallback for `getDraft()` to `getOwner()`.

### Fixed
- Fix an error when comparing a review on a completed and approved submission.
- Fix an error when comparing reviews for a deleted element.
- Fix an error when comparing content changes for some drafts.
- Fix dashboard widget not linking to submission element detail pages.

## 2.0.2 - 2022-11-24

### Added
- Add `Submission::getOwnerCpUrl()` to easily refer to the owner entry or draft’s `cpEditUrl` in emails.
- Add some error-handling checks to `Review::getSubmission()`,  `Review::getElement()`,  `Review::getUser()`.
- Add `Submission::getDraft()`.

### Changed
- References to the owner entry for a submission now refer to the draft (if it still exists).

### Fixed
- Fix an issue where status couldn’t be updated when editing a submission in the control panel.

## 2.0.1 - 2022-11-23

### Fixed
- Fix submissions not being correctly multi-site aware in some instances.
- Fix an error when sending reviewer notifications.
- Fix PHP errors that could occur when executing GraphQL queries..

## 2.0.0 - 2022-11-07

### Added
- Add detail template for Submissions for stats and more detail on each review.
- Add entry “diff” functionality to easily see what’s been added/changed/removed (if any) on each submission review.
- Add “Published Author Notifications” notification.
- Add emoji support for submission notes.
- Add “status” column to submissions index.
- Add GraphQL support for querying submissions.
- Add missing English Translations.
- Add resave console command for elements.
- Add checks for registering events for performance.
- Add `archiveTableIfExists()` to install migration.

### Changed
- Now requires PHP `^8.0.2`.
- Now requires Craft `^4.0.0`.
- Revamped Submissions and Reviews. Now captures information each time an action is performed on an entry for better review tracking. Refer to [upgrade docs](https://verbb.io/craft-plugins/workflow/docs/get-started/upgrading-from-v1) for a more thorough explanation.
- **Breaking Change** Update email templates to handle reviews. Refer to [upgrade docs](https://verbb.io/craft-plugins/workflow/docs/get-started/upgrading-from-v1).
- **Breaking Change** Move email functions to own service. Refer to [upgrade docs](https://verbb.io/craft-plugins/workflow/docs/get-started/upgrading-from-v1).
- Revamped submission process for more reliably and simplified handling with Craft 4+ updates.
- Switch `Entry::class, Entry::EVENT_AFTER_SAVE` to `Elements::EVENT_AFTER_SAVE_ELEMENT` to handle some edge-cases.
- Changed default title of a submission to `Submission for “{entry.title}” on {date}`.
- Rename base plugin methods.
- Now requires Workflow `1.7.0` in order to update from Craft 3.

### Fixed
- Fix submissions made on published entry drafts and the “[Deleted Element]” because once applied the drafts are deleted
- Fix numerous UI issues.
- Fix widget for an editor on a published entry showing, before a draft has been created.
- Fix being able to save a submitted draft when it should be locked.

### Removed
- Removed `SubmissionsController` as no longer needed.

## 1.7.6 - 2022-10-25

### Fixed
- Fix special characters in submission notes not working correctly.

## 1.7.5 - 2022-09-23

### Changed
- Submission notes are now sanitized when containing HTML.

## 1.7.4 - 2022-07-01

### Fixed
- Fix behaviour of “Approve only” for publishers, to not publish a draft, instead only save it.
- Fix reviewer groups not saving correctly.

## 1.7.3 - 2022-05-23

### Fixed
- Fix an error with reviewer user groups stored in the deprecated format (pre 1.7.0).
- Fix required fields validation error leading to "Entry draft not found" when saving draft for review.
- Fix an error when creating a new submission on an existing entry, when required field validation fails.
- Fix reviewer notes not populating email notifications.
- Fix reviewer submissions triggering multiple times when containing Preparse fields.
- Fix entering in reviewer notes updating the entry draft notes.
- Fix an error overriding the action for controllers, when other plugins rely on `Controller::beforeAction()`.
- Fix an error when trying to fetch the next reviewer group.
- Fix front-end entry form creating multiple submissions.

## 1.7.2 - 2022-03-24

### Fixed
- Fix an error when trying to submit for review on a non-multi-site install.

## 1.7.1 - 2022-03-18

### Added
- Add deprecation notices for old settings, if you are using a configuration file. These will need to be updated before Craft 4.

### Fixed
- Fix backward compatibility handling of settings not working correctly.
- Fix an error when trying to submit for review on a non-multi-site install.
- Fix settings for Reviewers not being populated correctly in settings.

### Deprecated
- `editorNotifications` has been updated to be multi-site compatible. Refer to [docs](https://verbb.io/craft-plugins/workflow/docs/get-started/configuration) if you are using a configuration file.
- `editorNotificationsOptions` has been updated to be multi-site compatible. Refer to [docs](https://verbb.io/craft-plugins/workflow/docs/get-started/configuration) if you are using a configuration file.
- `reviewerNotifications` has been updated to be multi-site compatible. Refer to [docs](https://verbb.io/craft-plugins/workflow/docs/get-started/configuration) if you are using a configuration file.
- `reviewerApprovalNotifications` has been updated to be multi-site compatible. Refer to [docs](https://verbb.io/craft-plugins/workflow/docs/get-started/configuration) if you are using a configuration file.
- `publisherNotifications` has been updated to be multi-site compatible. Refer to [docs](https://verbb.io/craft-plugins/workflow/docs/get-started/configuration) if you are using a configuration file.

## 1.7.0 - 2022-03-17

### Added
- Add multi-site support for plugin settings for editor/reviewer/publisher groups.
- Add `EVENT_PREPARE_EDITOR_EMAIL`, `EVENT_PREPARE_REVIEWER_EMAIL`, and `EVENT_PREPARE_PUBLISHER_EMAIL` events.
- Add `submission` param to `EVENT_BEFORE_SEND_` email events.

### Changed
- Allow `mail` param in `EVENT_BEFORE_SEND_` events to be modified by events.
- Change `EVENT_BEFORE_SEND_` email events to be cancelable.

## 1.6.6 - 2021-11-26

### Fixed
- Fix submissions being created multiple times, if an entry contained a Preparse field.

## 1.6.5 - 2021-11-06

### Fixed
- Fix editor/publisher notes not being kept after a failed validation attempt.
- Fix required fields not validating when submitting for review.

## 1.6.4 - 2021-10-01

### Fixed
- Fix all date text not showing date and time (just date).
- Fix missing translation for 'Notes about your submission' text.

## 1.6.3 - 2021-09-24

### Changed
- Update dashboard widget formatting.
- Update status colours to Craft standard.
- Set `publisherId` and `dateApproved` when setting the status to approved in the element status index.

### Fixed
- Fix all date text not using locale-aware formatting.
- Fix notes placeholder text not being fully translatable.
- Fix rejected submissions' status not working with user border accessibility options.
- Fix when a user is both editor and publisher, not showing the approval widget for other editors submissions.

## 1.6.2 - 2021-08-29

### Fixed
- Fix editors (who have access to the Workflow index) being allowed to approve their own submissions.

## 1.6.1 - 2021-07-30

### Fixed
- Fixed Craft 3.7+ compatibility.

## 1.6.0 - 2021-07-16

### Changed
- Now requires Craft 3.7+.

### Fixed
- Fixed Craft 3.7+ compatibility.

## 1.5.9 - 2021-01-24

### Added
- Add `reviewerApprovalNotifications` plugin setting to control sending email notifications to each the editor upon each reviewer’s approval.

### Fixed
- Fix reviewer emails not setting the correct “Review” model.

## 1.5.8 - 2021-01-16

### Fixed
- Fix toggle arrow alignment for entry widgets.
- Fix publisher receiving notifications incorrectly, when multiple reviewers are enabled.

## 1.5.7 - 2020-11-28

### Added
- Add `lockDraftSubmissions` plugin setting to control whether entries should be locked when submitted or not.

## 1.5.6 - 2020-08-31

### Fixed
- Fix user receiving an error when trying to edit a submitted entry.

## 1.5.5 - 2020-08-21

### Fixed
- Fix editors being able to continue editing their draft once submitted (through auto-save).

## 1.5.4 - 2020-06-18

### Fixed
- Fix email notifications for editor approvals.

## 1.5.3 - 2020-06-10

### Fixed
- Add more logging to email notifications.
- Fix emails not sending unless Reviewer Notifications is checked.

## 1.5.2 - 2020-06-09

### Fixed
- Fix XSS vulnerability with permissions settings.
- Fix error when `reviewerUserGroups` plugin settings is not an array.

## 1.5.1 - 2020-05-18

### Fixed
- Fix missing migration for review, introduced in 1.5.0.

## 1.5.0 - 2020-05-15

### Added
- Added multi-step review process. This introduces an optional middle step between editor submissions and publisher approvals. This can be used for multiple review steps, by various parties. Big thanks to @bencroker from @putyourlightson.

## 1.4.8 - 2020-05-13

### Fixed
- Fix multi-site entries and their approval overriding the status of other-site entries.
- Approving new entries respects section default status settings.
- Fix date attributes for submissions not being localised.

## 1.4.7 - 2020-05-12

### Fixed
- Fix incorrect response sent for some actions, causing `send()` errors.
- Improve handling of `enabledForSite` when approving and publishing submissions.

## 1.4.6 - 2020-04-28

### Fixed
- Prevent access to settings when `allowAdminChanges` is false

## 1.4.5 - 2020-04-16

### Fixed
- Fix logging error `Call to undefined method setFileLogging()`.

## 1.4.4 - 2020-04-15

### Changed
- File logging now checks if the overall Craft app uses file logging.
- Log files now only include `GET` and `POST` additional variables.

## 1.4.3 - 2020-04-03

### Fixed
- Fix draft changes not being saved when notes validation fails.

## 1.4.2 - 2020-02-15

### Fixed
- Fix error when trying to submit on a single-type section.
- Fix error in index screen for Craft 2 upgrades, where a site may not have been set.

## 1.4.1 - 2020-01-31

### Fixed
- Fix multiple approvals firing for draft submissions.

## 1.4.0 - 2020-01-29

### Added
- Craft 3.4 compatibility.

## 1.3.4 - 2020-01-20

### Fixed
- Fix editor/publisher notes enforcement.
- Fix being unable to approve front-end submissions.
- Fix being unable to approve submissions in some circumstances.

## 1.3.3 - 2020-01-20

### Fixed
- Fix error when trying to approve submissions with element actions.

## 1.3.2 - 2020-01-19

### Fixed
- Fix front-end submissions throwing errors.

## 1.3.1 - 2020-01-05

### Added
- Add submission notes and site to submission element index.

## 1.3.0 - 2020-01-05

### Added
- Add approve-only option for publishers.
- Ensure publishers can't approve their own entries.

### Changed
- Remove Drafts - now that its handled in Craft core. Use the element index to look for draft entries.
- Remove submissions controller and actions, refactoring to service. These shouldn't have been used (not documented), but this removes all `workflow/submissions/*` actions.
- Refactor and cleanup workflow flow. Particularly for new, unsaved drafts, fixing a few issues.
- Now requires Craft 3.3.0+.

### Fixed
- Fix some incorrect translations (thanks @Alxmerino and @watarutmnh).
- Fix before-send notification events not working.
- Disable auto-saving when entry has been submitted for review.
- Fix/improve front-end submissions.

### Security
- Protect against potential XSS.

## 1.2.3 - 2019-08-16

### Fixed
- Fix incorrect redirect URL after workflow actions. (thanks @mattrothenberg).
- Fix draft’s not showing correctly when no title has been set.
- Fix lack of publishing when approving submission from Overview.

## 1.2.2.1 - 2019-08-15

### Fixed
- Fix issue for new Workflow installs having incorrect foreign key constraints.

## 1.2.2 - 2019-08-06

### Changed
- Now requires Craft 3.2.8+.

### Fixed
- Fix issues with submitting and approving on latest Craft 3.2.x changes.
- Fix error when approving a brand new entry submission.
- Fix errors with drafts index.
- Fix editor emails not sending when no `Additional Options` were checked.

## 1.2.1 - 2019-07-13

### Fixed
- Fix offload warning when submitting actions.
- Fix integrity error for drafts when trying to submit an entry.

## 1.2.0 - 2019-07-11

### Added
- Add support for Craft 3.2.0+.
- Fix incorrect element table attributes.

## 1.1.12 - 2019-06-28

### Fixed
- Fix incorrect element table attributes.

## 1.1.11 - 2019-06-27

### Fixed
- Don’t redirect from submissions unless we have to.
- Add search attributes for submissions.
- Fix submission propagation before saving.

## 1.1.10 - 2019-06-18

### Fixed
- Fix dashboard widget link for submission drafts.
- Fix redirect error when trying to approve a submission. (thanks @brandonkelly)

## 1.1.9 - 2019-03-23

### Added
- Add override notice for settings fields, when using config file.

### Fixed
- Fix validation not triggering when saving drafts.

## 1.1.8 - 2019-03-13

### Added
- Add email events `beforeSendEditorEmail` and `beforeSendPublisherEmail`.
- Add editor notification options for reply-to and cc-ing publisher's email.

### Changed
- Refactor settings into multiple pages.

## 1.1.7 - 2019-03-10

### Fixed
- Fix errors thrown when calling controller actions from site requests and not from POST submissions.

## 1.1.6 - 2019-03-06

### Added
- Allow non-admins to save plugin settings.
- Add more permissions to pages in plugin.

### Fixed
- Add checks around the owner entry and whether it exists.
- Add missing migration for `ownerSiteId` for Craft 2 > 3 upgrades.

## 1.1.5 - 2019-03-01

### Fixed
- Fix potential error on widget when submitted element is missing.
- Fix redirects for submissions, particularly on the front-end.

## 1.1.4 - 2019-02-28

### Fixed
- Fix approved entries not being published correctly in some instances.

## 1.1.3 - 2019-02-27

### Fixed
- Fix editor/publisher links.
- Fix errors that can occur when installing via cli.

## 1.1.2 - 2019-02-27

### Added
- Added editor/publisher submission notes required setting

### Changed
- Ensure editor/publisher URLs are only shown if the current user has permission.

### Fixed
- Ensure publishers in settings use User Group UID.

## 1.1.1 - 2019-02-26

### Fixed
- Fix error in Norwegian translation (thanks @phoob).
- Fix query error when viewing drafts.

## 1.1.0 - 2019-02-25

### Added
- Added editor notes, to send along with a submission.
- Submissions now listed on entry events, to improve submission workflow.
- Submit brand-new entries for review (provided they pass validation).
- Translation to norwegian. (thanks @phoob).
- Add serialised data to submissions to prepare for entry comparison diffs.

### Changed
- Updated widget styles to be more compact for entry sidebars.
- Update min requirement to Craft 3.1.x.
- Updated plugin settings to use UIDs for Craft 3.1.x.
- 'Submit for review' now saves entry content, then submits for review. No more clicking 'Save' then 'Submit'.
- 'Submit for review' now validates entry content before submission.
- Changed controller action from `workflow/submissions/send` to `workflow/submissions/save-submission`.
- Changed controller action from `workflow/submissions/revoke` to `workflow/submissions/revoke-submission`.
- Changed controller action from `workflow/submissions/approve` to `workflow/submissions/approve-submission`.
- Changed controller action from `workflow/submissions/reject` to `workflow/submissions/reject-submission`.

### Fixed 
- Fix draft submissions not being retained after approval.
- Submissions now trigger entry validation, ensuring only 'valid' entries are submitted for review.
- Fix dateApproved/dateRejected not showing their value.
- Fix error when sorting by Editor or Publisher in CP.
- Fix error when no sections are selected.
- Fix not publishing a submission when approving.

## 1.0.3 - 2018-11-10

### Fixed
- Show the entry title on submissions index, rather than the Submission ID.

## 1.0.2 - 2018-07-24

### Fixed
- Fix Verbb logo reference (for real this time)

## 1.0.1 - 2018-07-24

### Fixed
- Fix elementType typo
- Fix Verbb logo reference

## 1.0.0 - 2018-07-23

- Craft 3 release

## 0.9.6 - 2017-11-04

### Fixed
- Minor fix for sidebar icon.

## 0.9.5 - 2017-10-17

### Added
- Verbb marketing (new plugin icon, readme, etc).

## 0.9.4 - 2016-10-15

### Added
- Added ability to enabled/disable email notifications for editors or publishers.
- Added ability to select all, or individual publishers to be notified via email on submissions.

### Fixed
- Only individual editors receive approval/rejection email notifications - not each user in the editor group.

## 0.9.3 - 2016-09-24

### Added
- Added ability to set notes on an approval/rejection from a publisher.
- Added submission rejection option integrating notes (as above).
- Added new email message for when editors are notified on their submission.
- Added ability for editors to revoke their submission.
- Added widget for submissions.

### Changed
- Editors now receive emails when their submission is approved/rejected.
- Improved entry widget to combine multiple submissions into a single pane.

### Fixed
- Fixed missing attributes for element type.
- Fixed typo in element action.
- Fixed status indicators on element index.

## 0.9.2 - 2016-07-08

### Added
- Added Draft overview screen - shows all available drafts site-wide.

## 0.9.1 - 2016-07-08

### Fixed
- Fixed approval link in email not including draft.
- Fixed where a Draft entry was approved, its state was not set to public.

## 0.9.0 - 2016-06-26

### Added
- Initial release.
