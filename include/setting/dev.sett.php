<?php

//define('PHPFOX_LOG_ERROR', true);

define('PHPFOX_LIVE_TEMPLATES', true);

/*define('PHPFOX_DEBUG', 1);
 
// Debug level
define('PHPFOX_DEBUG_LEVEL', 3);*/

if (!in_array($_SERVER['REMOTE_ADDR'], array('42.113.1.131', '222.252.86.193'))) {
	return;
}

// Enable debug
define('PHPFOX_DEBUG', 1);
 
// Debug level
define('PHPFOX_DEBUG_LEVEL', 3);

// Force templates re-cache on each page refresh
define('PHPFOX_NO_TEMPLATE_CACHE', true);
 
// Force browsers to re-cache static files on each page refresh
define('PHPFOX_NO_CSS_CACHE', true);
 
// Override default email
define('PHPFOX_DEFAULT_OUT_EMAIL', 'salem280575@gmail.com');
 
// Skip sending out of emails
//define('PHPFOX_SKIP_MAIL', true);
 
// Use live templates and not those from the database
// define('PHPFOX_LIVE_TEMPLATES', true);
 
// Add user_name in the title of each page. Great for when working with many browsers open
define('PHPFOX_ADD_USER_TITLE', true);
 
// Cache emails to flat files
define('PHPFOX_CACHE_MAIL', true);
 
// Log error messages to XML flat file within the cache folder
define('PHPFOX_LOG_ERROR', true);
 
// Skip the storing of cache files in the DB
define('PHPFOX_CACHE_SKIP_DB_STORE', true);

if (!function_exists('vd')) {
	function vd($var = false, $trace = 1, $showHtml = false, $showFrom = true) {
        if ($showFrom) {
            $calledFrom = debug_backtrace();
            for ($i = 0; $i < $trace; $i++) {
                if (!isset($calledFrom[$i]['file'])) {
                    break;
                }
                echo substr($calledFrom[$i]['file'], 1);
                echo ' (line <strong>' . $calledFrom[$i]['line'] . '</strong>)';
                echo "<br />";
            }
        }
        echo "<pre class=\"cake-debug\">\n";

        $var = var_dump($var);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo $var . "\n</pre>\n";
    }
    function vdd($var = false, $trace = 1, $showHtml = false, $showFrom = true) {
        if ($showFrom) {
            $calledFrom = debug_backtrace();
            for ($i = 0; $i < $trace; $i++) {
                if (!isset($calledFrom[$i]['file'])) {
                    break;
                }
                echo substr($calledFrom[$i]['file'], 1);
                echo ' (line <strong>' . $calledFrom[$i]['line'] . '</strong>)';
                echo "<br />";
            }
        }
        echo "<pre class=\"cake-debug\">\n";

        $var = var_dump($var);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo $var . "\n</pre>\n";
        die;
    }
}
