<?php
$oRequest = Phpfox::getLib('phpfox.request');
if ($oRequest->get('upgrade')) {
    $sType = 'upgrade';
} else if ($oRequest->get('delete')) {
    $sType = 'uninstall';
} else if ($oRequest->get('install')) {
    $sType = 'install';
}

if (!class_exists('PhpfoxplusMailchimpInstaller')) {
    class PhpfoxplusMailchimpInstaller {

        var $bNoInstall = false;
        var $sVersion;

        function __construct($sVersion) {
            $this->sVersion = $sVersion;
        }

        function install () {
            if ($this->bNoInstall) {
                return false;
            }

            $oDb = Phpfox::getLib('phpfox.database');
            $aSql = array(
                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_field_map') . "`",
                "CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('mailchimp_field_map') . "` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `list_id` varchar(64) NOT NULL,
                  `mailchimp_tag` varchar(64) NOT NULL,
                  `phpfox_field` varchar(64) NOT NULL,
                  PRIMARY KEY (`id`)
                )",

                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_list') . "`",
                "CREATE TABLE IF NOT EXISTS `" . PHpfox::getT('mailchimp_list') . "` (
                  `id` varchar(64) NOT NULL,
                  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
                  `confirm` tinyint(1) NOT NULL,
                  `subscribe_url_short` text,
                  `subscribe_url_long` text,
                  `name` varchar(256) NOT NULL,
                  `description` mediumtext NOT NULL,
                  `last_user_id` int(11) NOT NULL,
                  `last_mail_user_id` int(11) NOT NULL,
                  `total_request` int(11) NOT NULL,
                  `last_time` int(11) unsigned NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                )",

                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_list_map') . "`",
                "CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('mailchimp_list_map') . "` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `list_id` varchar(32) NOT NULL,
                  `group_id` int(11) unsigned NOT NULL,
                  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                )",

                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_log') . "`",
                "CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('mailchimp_log') . "` (
                  `mailchimplog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `description` text NOT NULL,
                  `created_at` int(11) unsigned NOT NULL,
                  PRIMARY KEY (`mailchimplog_id`)
                )"
            );

            foreach($aSql as $sSql) {
                $oDb->query($sSql);
            }
        }

        function upgrade () {
            $this->bNoInstall = true;
            $sVersion = $this->sVersion;

            $oDb = Phpfox::getLib('phpfox.database');
            $aSqls = array();

            foreach($aSqls as $sSql) {
                $oDb->query($sSql);
            }
        }

        function uninstall () {
            $oDb = Phpfox::getLib('phpfox.database');
            $aSql = array(
                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_field_map') . "`",
                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_list') . "`",
                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_list_map') . "`",
                "DROP TABLE IF EXISTS `" . Phpfox::getT('mailchimp_log') . "`"
            );
            foreach($aSql as $sSql) {
                $oDb->query($sSql);
            }
        }
    }
}

$oInstaller = new PhpfoxplusMailchimpInstaller($sVersion);
$oInstaller->{$sType}();