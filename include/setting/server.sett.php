<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			natio
 * @package 		PhpFox
 * @version 		$Id: server.sett.php.new 4602 2012-08-18 18:48:02Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * Database Driver
 * Support: mysql, mysqli, mssql, postgres or sqlite
 * 
 * @example mysql
 */
$_CONF['db']['driver'] = 'mysql';
$_CONF['db']['host'] = 'localhost'; 
$_CONF['db']['user'] = 'wtv_admin';
$_CONF['db']['pass'] = 'h0trod';
$_CONF['db']['name'] = 'wtvdvs';
$_CONF['db']['prefix'] = 'phpfox_';
$_CONF['db']['port'] = '';

$_CONF['db']['slave'] = false;
$_CONF['db']['slave_servers'] = array();

$_CONF['balancer']['enabled'] = false;
$_CONF['balancer']['servers'] = array();

//subdomain mode ON? Use www
//subdomain mode OFF? Don't use wwww
$_CONF['core.host'] = 'www.wtvdvs.com';

$_CONF['core.folder'] = '/';

//subdomain mode ON? Use 3
//sudbomdin mode OFF? Use 1
$_CONF['core.url_rewrite'] = '3';

$_CONF['core.salt'] = 'ad787ffedd1149322f7da1a75b71e7ee';

// Storage Engine (file, memcache)
$_CONF['core.cache_storage'] = 'file';

// Add salt
$_CONF['core.cache_add_salt'] = false;

// Cache suffix (file only)
$_CONF['core.cache_suffix'] = '.php';

// Memcache Hosts
$_CONF['core.memcache_hosts'] = array();

// Memcahe persistent
$_CONF['core.memcache_persistent'] = false;

// Should we skip the cache check and display live content
$_CONF['core.cache_skip'] = false;

// Check we run to find out if the script has been installed
$_CONF['core.is_installed'] = true;

// Check we run when the database tables have been installed
$_CONF['core.db_table_installed'] = false;

// AdminCP time out in minutes
$_CONF['core.admincp_timeout'] = '60';

// Define if AdminCP should have a time out
$_CONF['core.admincp_do_timeout'] = false;

$_CONF['core.is_auto_hosted'] = false;

?>