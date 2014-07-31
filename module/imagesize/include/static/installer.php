<?php
$oRequest = Phpfox::getLib('phpfox.request');
if ($oRequest->get('upgrade')) {
    $sType = 'upgrade';
} else if ($oRequest->get('delete')) {
    $sType = 'uninstall';
} else if ($oRequest->get('install')) {
    $sType = 'install';
}

if (!class_exists('PhpfoxplusImagesizeInstaller')) {
    class PhpfoxplusImagesizeInstaller {

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
                "ALTER TABLE `" . Phpfox::getT('ko_brightcove') . "` ADD `image_path` VARCHAR( 75 ) NULL DEFAULT NULL ,
                ADD `image_server_id` TINYINT( 3 ) NOT NULL DEFAULT '0',
                ADD `is_resize` TINYINT( 1 ) NOT NULL DEFAULT '0'"
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
                "ALTER TABLE `" . Phpfox::getT('ko_brightcove') . "` DROP `image_path`, DROP `image_server_id`, DROP `is_resize`"
            );
            foreach($aSql as $sSql) {
                $oDb->query($sSql);
            }
        }
    }
}

$oInstaller = new PhpfoxplusImagesizeInstaller($sVersion);
$oInstaller->{$sType}();