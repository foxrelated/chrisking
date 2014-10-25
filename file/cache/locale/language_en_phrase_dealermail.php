<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  'admin_menu_errors' => 'Errors',
  'admin_menu_sent' => 'Sent',
  'admin_menu_settings' => 'Settings',
  'admin_menu_stats' => 'Stats',
  'api_status' => 'API Status',
  'contact_comments' => 'Contact Comments',
  'contact_email' => 'Lead Email',
  'contact_name' => 'Contact Name',
  'contact_phone' => 'Contact Phone',
  'contact_zip' => 'Contact Zip',
  'date' => 'Date',
  'dealer_email' => 'Dealer Email',
  'dealer_mail_errors' => 'Dealer Mail: Errors',
  'dealer_mail_sent' => 'Dealer Mail: Sent',
  'dealer_mail_stats' => 'Dealer Mail: Stats',
  'email_body' => 'You have received a contact request from your WheelsTV Video Player.

Information Provided:
Name: {contact_name}
Email: {contact_email}
Phone: {contact_phone}
Zip Code: {contact_zip}
Comments: {contact_comments}

Regarding the following vehicle:
{year} {make} {model} ({bodyStyle})',
  'email_subject' => 'Contact Request from WheelsTV Video Player - {year} {make} {model} {bodyStyle}',
  'ip_address' => 'IP Address',
  'module_dealermail' => 'Dealer Mail Custom Module',
  'setting_require_comments' => '<title>Require Comments</title><info>If this is set to true and the Dealer Mail API receives a request without the contact_comments field filled out, an error will be generated.</info>',
  'setting_require_email' => '<title>Require Email</title><info>If this is set to true and the Dealer Mail API receives a request without the contact_email field filled out, an error will be generated.</info>',
  'setting_require_name' => '<title>Require Name</title><info>If this is set to true and the Dealer Mail API receives a request without the contact_name field filled out, an error will be generated.</info>',
  'setting_require_phone' => '<title>Require Phone</title><info>If this is set to true and the Dealer Mail API receives a request without the contact_phone field filled out, an error will be generated.</info>',
  'setting_require_zip' => '<title>Require Zip Code</title><info>If this is set to true and the Dealer Mail API receives a request without the contact_zip field filled out, an error will be generated.</info>',
  'setting_throttle' => '<title>Dealer Email Throttle</title><info>The value of this setting will limit the number of API requests from a specific IP address in a given time period.  If more requests originate than the value of this setting in any 60 second time period an email will not be sent and no error message will be displayed.</info>',
  'total_errors' => 'Total Errors',
  'total_sent' => 'Total Sent',
  'video_reference_id' => 'Video Reference ID',
); ?>