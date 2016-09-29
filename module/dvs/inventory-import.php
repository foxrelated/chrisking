<?php

define('PHPFOX_NO_CSRF', true);
define('PHPFOX_NO_PLUGINS', true);
define('PHPFOX_CLI', true);
$_SERVER['REMOTE_ADDR'] = '';
$_SERVER['HTTP_HOST'] = '';
$_SERVER['SERVER_NAME'] = '';
define('PHPFOX_NO_SESSION', true);
define('PHPFOX_NO_USER_SESSION', true);

/**
 * Key to include phpFox
 *
 */
define('PHPFOX', true);
define('DEBUG', 1);

if (defined('DEBUG') && DEBUG)
{
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Directory Seperator
 *
 */
define('PHPFOX_DS', DIRECTORY_SEPARATOR);

/**
 * phpFox Root Directory
 *
 */
define('PHPFOX_DIR', dirname(dirname(dirname(__FILE__))) . PHPFOX_DS);
// Require phpFox Init

include PHPFOX_DIR . PHPFOX_DS . 'include' . PHPFOX_DS . 'init.inc.php';

if (Phpfox::isModule('dvs')) {
    Phpfox::getService('dvs.inventory')->runCronjob();
}