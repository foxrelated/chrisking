<?php

if (version_compare(phpversion(), '5', '<') === true) {
    exit('phpFox 2 or higher requires PHP 5 or newer.');
}

ob_start();

define('PHPFOX', true);
define('PHPFOX_DS', DIRECTORY_SEPARATOR);
define('PHPFOX_DIR', dirname(__FILE__) . PHPFOX_DS);
define('PHPFOX_START_TIME', array_sum(explode(' ', microtime())));
require(PHPFOX_DIR . 'include' . PHPFOX_DS . 'init.inc.php');

Phpfox::getComponent('newapi.method', array(), 'controller');

ob_end_flush();

?>