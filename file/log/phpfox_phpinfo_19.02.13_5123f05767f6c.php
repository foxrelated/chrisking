<?php defined('PHPFOX') or exit('NO DICE!');  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<style type="text/css">
body {background-color: #ffffff; color: #000000;}
body, td, th, h1, h2 {font-family: sans-serif;}
pre {margin: 0px; font-family: monospace;}
a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
a:hover {text-decoration: underline;}
table {border-collapse: collapse;}
.center {text-align: center;}
.center table { margin-left: auto; margin-right: auto; text-align: left;}
.center th { text-align: center !important; }
td, th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}
h1 {font-size: 150%;}
h2 {font-size: 125%;}
.p {text-align: left;}
.e {background-color: #ccccff; font-weight: bold; color: #000000;}
.h {background-color: #9999cc; font-weight: bold; color: #000000;}
.v {background-color: #cccccc; color: #000000;}
.vr {background-color: #cccccc; text-align: right; color: #000000;}
img {float: right; border: 0px;}
hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
</style>
<title>phpinfo()</title><meta name="ROBOTS" content="NOINDEX,FOLLOW,NOARCHIVE" /></head>
<body><div class="center">
<table border="0" cellpadding="3" width="600">
<tr class="h"><td>
<h1 class="p">PHP Version 5.3.21</h1>
</td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr><td class="e">System </td><td class="v">Linux wheelstvplatform 2.6.32-279.el6.x86_64 #1 SMP Fri Jun 22 12:19:21 UTC 2012 x86_64 </td></tr>
<tr><td class="e">Build Date </td><td class="v">Jan 17 2013 12:47:22 </td></tr>
<tr><td class="e">Configure Command </td><td class="v"> &#039;./configure&#039;  &#039;--build=x86_64-unknown-linux-gnu&#039; &#039;--host=x86_64-unknown-linux-gnu&#039; &#039;--target=x86_64-redhat-linux-gnu&#039; &#039;--program-prefix=&#039; &#039;--prefix=/usr&#039; &#039;--exec-prefix=/usr&#039; &#039;--bindir=/usr/bin&#039; &#039;--sbindir=/usr/sbin&#039; &#039;--sysconfdir=/etc&#039; &#039;--datadir=/usr/share&#039; &#039;--includedir=/usr/include&#039; &#039;--libdir=/usr/lib64&#039; &#039;--libexecdir=/usr/libexec&#039; &#039;--localstatedir=/var&#039; &#039;--sharedstatedir=/var/lib&#039; &#039;--mandir=/usr/share/man&#039; &#039;--infodir=/usr/share/info&#039; &#039;--cache-file=../config.cache&#039; &#039;--with-libdir=lib64&#039; &#039;--with-config-file-path=/etc&#039; &#039;--with-config-file-scan-dir=/etc/php.d&#039; &#039;--disable-debug&#039; &#039;--with-pic&#039; &#039;--disable-rpath&#039; &#039;--without-pear&#039; &#039;--with-bz2&#039; &#039;--with-exec-dir=/usr/bin&#039; &#039;--with-freetype-dir=/usr&#039; &#039;--with-png-dir=/usr&#039; &#039;--with-xpm-dir=/usr&#039; &#039;--enable-gd-native-ttf&#039; &#039;--with-t1lib=/usr&#039; &#039;--without-gdbm&#039; &#039;--with-gettext&#039; &#039;--with-gmp&#039; &#039;--with-iconv&#039; &#039;--with-jpeg-dir=/usr&#039; &#039;--with-openssl&#039; &#039;--with-pcre-regex&#039; &#039;--with-zlib&#039; &#039;--with-layout=GNU&#039; &#039;--enable-exif&#039; &#039;--enable-ftp&#039; &#039;--enable-magic-quotes&#039; &#039;--enable-sockets&#039; &#039;--enable-sysvsem&#039; &#039;--enable-sysvshm&#039; &#039;--enable-sysvmsg&#039; &#039;--with-kerberos&#039; &#039;--enable-ucd-snmp-hack&#039; &#039;--enable-shmop&#039; &#039;--enable-calendar&#039; &#039;--without-mime-magic&#039; &#039;--without-sqlite&#039; &#039;--with-libxml-dir=/usr&#039; &#039;--with-xml&#039; &#039;--with-system-tzdata&#039; &#039;--with-apxs2=/usr/sbin/apxs&#039; &#039;--without-mysql&#039; &#039;--without-gd&#039; &#039;--disable-dom&#039; &#039;--disable-dba&#039; &#039;--without-unixODBC&#039; &#039;--disable-pdo&#039; &#039;--disable-xmlreader&#039; &#039;--disable-xmlwriter&#039; &#039;--disable-phar&#039; &#039;--disable-fileinfo&#039; &#039;--disable-json&#039; &#039;--without-pspell&#039; &#039;--disable-wddx&#039; &#039;--without-curl&#039; &#039;--disable-posix&#039; &#039;--disable-sysvmsg&#039; &#039;--disable-sysvshm&#039; &#039;--disable-sysvsem&#039; </td></tr>
<tr><td class="e">Server API </td><td class="v">Apache 2.0 Handler </td></tr>
<tr><td class="e">Virtual Directory Support </td><td class="v">disabled </td></tr>
<tr><td class="e">Configuration File (php.ini) Path </td><td class="v">/etc </td></tr>
<tr><td class="e">Loaded Configuration File </td><td class="v">/etc/php.ini </td></tr>
<tr><td class="e">Scan this dir for additional .ini files </td><td class="v">/etc/php.d </td></tr>
<tr><td class="e">Additional .ini files parsed </td><td class="v">/etc/php.d/apc.ini,
/etc/php.d/curl.ini,
/etc/php.d/dom.ini,
/etc/php.d/fileinfo.ini,
/etc/php.d/gd.ini,
/etc/php.d/json.ini,
/etc/php.d/mbstring.ini,
/etc/php.d/mcrypt.ini,
/etc/php.d/mysql.ini,
/etc/php.d/mysqli.ini,
/etc/php.d/pdo.ini,
/etc/php.d/pdo_mysql.ini,
/etc/php.d/pdo_sqlite.ini,
/etc/php.d/phar.ini,
/etc/php.d/suhosin.ini,
/etc/php.d/wddx.ini,
/etc/php.d/xmlreader.ini,
/etc/php.d/xmlwriter.ini,
/etc/php.d/xsl.ini,
/etc/php.d/zip.ini
 </td></tr>
<tr><td class="e">PHP API </td><td class="v">20090626 </td></tr>
<tr><td class="e">PHP Extension </td><td class="v">20090626 </td></tr>
<tr><td class="e">Zend Extension </td><td class="v">220090626 </td></tr>
<tr><td class="e">Zend Extension Build </td><td class="v">API220090626,NTS </td></tr>
<tr><td class="e">PHP Extension Build </td><td class="v">API20090626,NTS </td></tr>
<tr><td class="e">Debug Build </td><td class="v">no </td></tr>
<tr><td class="e">Thread Safety </td><td class="v">disabled </td></tr>
<tr><td class="e">Zend Memory Manager </td><td class="v">enabled </td></tr>
<tr><td class="e">Zend Multibyte Support </td><td class="v">disabled </td></tr>
<tr><td class="e">IPv6 Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Registered PHP Streams </td><td class="v">https, ftps, compress.zlib, compress.bzip2, php, file, glob, data, http, ftp, phar, zip   </td></tr>
<tr><td class="e">Registered Stream Socket Transports </td><td class="v">tcp, udp, unix, udg, ssl, sslv3, sslv2, tls </td></tr>
<tr><td class="e">Registered Stream Filters </td><td class="v">zlib.*, bzip2.*, convert.iconv.*, string.rot13, string.toupper, string.tolower, string.strip_tags, convert.*, consumed, dechunk, mcrypt.*, mdecrypt.* </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="v"><td>
This program makes use of the Zend Scripting Language Engine:<br />Zend&nbsp;Engine&nbsp;v2.3.0,&nbsp;Copyright&nbsp;(c)&nbsp;1998-2013&nbsp;Zend&nbsp;Technologies<br />&nbsp;&nbsp;&nbsp;&nbsp;with&nbsp;Suhosin&nbsp;v0.9.29,&nbsp;Copyright&nbsp;(c)&nbsp;2007,&nbsp;by&nbsp;SektionEins&nbsp;GmbH<br /></td></tr>
</table><br />
<hr />
<h1>Configuration</h1>
<h2><a name="module_apache2handler">apache2handler</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Apache Version </td><td class="v">Apache </td></tr>
<tr><td class="e">Apache API Version </td><td class="v">20051115 </td></tr>
<tr><td class="e">Server Administrator </td><td class="v">root@localhost </td></tr>
<tr><td class="e">Hostname:Port </td><td class="v">2001:4800:780e:510:8b24:69db:ff04:addb:0 </td></tr>
<tr><td class="e">User/Group </td><td class="v">apache(48)/48 </td></tr>
<tr><td class="e">Max Requests </td><td class="v">Per Child: 1000 - Keep Alive: on - Max Per Connection: 100 </td></tr>
<tr><td class="e">Timeouts </td><td class="v">Connection: 30 - Keep-Alive: 5 </td></tr>
<tr><td class="e">Virtual Server </td><td class="v">No </td></tr>
<tr><td class="e">Server Root </td><td class="v">/etc/httpd </td></tr>
<tr><td class="e">Loaded Modules </td><td class="v">core prefork http_core mod_so mod_auth_basic mod_auth_digest mod_authn_file mod_authn_alias mod_authn_anon mod_authn_dbm mod_authn_default mod_authz_host mod_authz_user mod_authz_owner mod_authz_groupfile mod_authz_dbm mod_authz_default util_ldap mod_authnz_ldap mod_include mod_log_config mod_logio mod_env mod_ext_filter mod_mime_magic mod_expires mod_deflate mod_headers mod_usertrack mod_setenvif mod_mime mod_dav mod_status mod_autoindex mod_info mod_dav_fs mod_vhost_alias mod_negotiation mod_dir mod_actions mod_speling mod_userdir mod_alias mod_rewrite mod_proxy mod_proxy_balancer mod_proxy_ftp mod_proxy_http mod_proxy_connect mod_cache mod_suexec mod_disk_cache mod_cgi mod_version mod_substitute mod_proxy_ajp mod_php5 mod_ssl </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">engine</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">last_modified</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">xbithack</td><td class="v">0</td><td class="v">0</td></tr>
</table><br />
<h2>Apache Environment</h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Variable</th><th>Value</th></tr>
<tr><td class="e">HTTP_HOST </td><td class="v">wtvdvs.com </td></tr>
<tr><td class="e">HTTP_CONNECTION </td><td class="v">keep-alive </td></tr>
<tr><td class="e">CONTENT_LENGTH </td><td class="v">43 </td></tr>
<tr><td class="e">HTTP_CACHE_CONTROL </td><td class="v">max-age=0 </td></tr>
<tr><td class="e">HTTP_ACCEPT </td><td class="v">text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8 </td></tr>
<tr><td class="e">HTTP_ORIGIN </td><td class="v">http://wtvdvs.com </td></tr>
<tr><td class="e">HTTP_USER_AGENT </td><td class="v">Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17 </td></tr>
<tr><td class="e">CONTENT_TYPE </td><td class="v">application/x-www-form-urlencoded </td></tr>
<tr><td class="e">HTTP_REFERER </td><td class="v">http://wtvdvs.com/install/index.php?do=/install/requirement/sessionid_5123efcd64e77/ </td></tr>
<tr><td class="e">HTTP_ACCEPT_ENCODING </td><td class="v">gzip,deflate,sdch </td></tr>
<tr><td class="e">HTTP_ACCEPT_LANGUAGE </td><td class="v">en-US,en;q=0.8 </td></tr>
<tr><td class="e">HTTP_ACCEPT_CHARSET </td><td class="v">ISO-8859-1,utf-8;q=0.7,*;q=0.3 </td></tr>
<tr><td class="e">HTTP_COOKIE </td><td class="v">PHPSESSID=oldar8kr6jpe1lflp9o3cbj5c3 </td></tr>
<tr><td class="e">PATH </td><td class="v">/sbin:/usr/sbin:/bin:/usr/bin </td></tr>
<tr><td class="e">SERVER_SIGNATURE </td><td class="v"><i>no value</i> </td></tr>
<tr><td class="e">SERVER_SOFTWARE </td><td class="v">Apache </td></tr>
<tr><td class="e">SERVER_NAME </td><td class="v">wtvdvs.com </td></tr>
<tr><td class="e">SERVER_ADDR </td><td class="v">50.56.179.230 </td></tr>
<tr><td class="e">SERVER_PORT </td><td class="v">80 </td></tr>
<tr><td class="e">REMOTE_ADDR </td><td class="v">72.67.59.50 </td></tr>
<tr><td class="e">DOCUMENT_ROOT </td><td class="v">/var/www/html </td></tr>
<tr><td class="e">SERVER_ADMIN </td><td class="v">root@localhost </td></tr>
<tr><td class="e">SCRIPT_FILENAME </td><td class="v">/var/www/html/install/index.php </td></tr>
<tr><td class="e">REMOTE_PORT </td><td class="v">57140 </td></tr>
<tr><td class="e">GATEWAY_INTERFACE </td><td class="v">CGI/1.1 </td></tr>
<tr><td class="e">SERVER_PROTOCOL </td><td class="v">HTTP/1.1 </td></tr>
<tr><td class="e">REQUEST_METHOD </td><td class="v">POST </td></tr>
<tr><td class="e">QUERY_STRING </td><td class="v">do=/install/requirement/sessionid_5123efcd64e77/ </td></tr>
<tr><td class="e">REQUEST_URI </td><td class="v">/install/index.php?do=/install/requirement/sessionid_5123efcd64e77/ </td></tr>
<tr><td class="e">SCRIPT_NAME </td><td class="v">/install/index.php </td></tr>
</table><br />
<h2>HTTP Headers Information</h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th colspan="2">HTTP Request Headers</th></tr>
<tr><td class="e">HTTP Request </td><td class="v">POST /install/index.php?do=/install/requirement/sessionid_5123efcd64e77/ HTTP/1.1 </td></tr>
<tr><td class="e">Host </td><td class="v">wtvdvs.com </td></tr>
<tr><td class="e">Connection </td><td class="v">keep-alive </td></tr>
<tr><td class="e">Content-Length </td><td class="v">43 </td></tr>
<tr><td class="e">Cache-Control </td><td class="v">max-age=0 </td></tr>
<tr><td class="e">Accept </td><td class="v">text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8 </td></tr>
<tr><td class="e">Origin </td><td class="v">http://wtvdvs.com </td></tr>
<tr><td class="e">User-Agent </td><td class="v">Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17 </td></tr>
<tr><td class="e">Content-Type </td><td class="v">application/x-www-form-urlencoded </td></tr>
<tr><td class="e">Referer </td><td class="v">http://wtvdvs.com/install/index.php?do=/install/requirement/sessionid_5123efcd64e77/ </td></tr>
<tr><td class="e">Accept-Encoding </td><td class="v">gzip,deflate,sdch </td></tr>
<tr><td class="e">Accept-Language </td><td class="v">en-US,en;q=0.8 </td></tr>
<tr><td class="e">Accept-Charset </td><td class="v">ISO-8859-1,utf-8;q=0.7,*;q=0.3 </td></tr>
<tr><td class="e">Cookie </td><td class="v">PHPSESSID=oldar8kr6jpe1lflp9o3cbj5c3 </td></tr>
<tr class="h"><th colspan="2">HTTP Response Headers</th></tr>
<tr><td class="e">Expires </td><td class="v">Thu, 19 Nov 1981 08:52:00 GMT </td></tr>
<tr><td class="e">Cache-Control </td><td class="v">no-store, no-cache, must-revalidate, post-check=0, pre-check=0 </td></tr>
<tr><td class="e">Pragma </td><td class="v">no-cache </td></tr>
</table><br />
<h2><a name="module_apc">apc</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>APC Support</th><th>enabled</th></tr>
<tr><td class="e">Version </td><td class="v">3.1.9 </td></tr>
<tr><td class="e">APC Debugging </td><td class="v">Disabled </td></tr>
<tr><td class="e">MMAP Support </td><td class="v">Enabled </td></tr>
<tr><td class="e">MMAP File Mask </td><td class="v"><i>no value</i> </td></tr>
<tr><td class="e">Locking type </td><td class="v">pthread mutex Locks </td></tr>
<tr><td class="e">Serialization Support </td><td class="v">php </td></tr>
<tr><td class="e">Revision </td><td class="v">$Revision: 308812 $ </td></tr>
<tr><td class="e">Build Date </td><td class="v">Oct 24 2011 08:59:56 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">apc.cache_by_default</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.canonicalize</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.coredump_unmap</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.enable_cli</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.enabled</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.file_md5</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.file_update_protection</td><td class="v">2</td><td class="v">2</td></tr>
<tr><td class="e">apc.filters</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">apc.gc_ttl</td><td class="v">3600</td><td class="v">3600</td></tr>
<tr><td class="e">apc.include_once_override</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.lazy_classes</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.lazy_functions</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.max_file_size</td><td class="v">1M</td><td class="v">1M</td></tr>
<tr><td class="e">apc.mmap_file_mask</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">apc.num_files_hint</td><td class="v">1000</td><td class="v">1000</td></tr>
<tr><td class="e">apc.preload_path</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">apc.report_autofilter</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.rfc1867</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.rfc1867_freq</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">apc.rfc1867_name</td><td class="v">APC_UPLOAD_PROGRESS</td><td class="v">APC_UPLOAD_PROGRESS</td></tr>
<tr><td class="e">apc.rfc1867_prefix</td><td class="v">upload_</td><td class="v">upload_</td></tr>
<tr><td class="e">apc.rfc1867_ttl</td><td class="v">3600</td><td class="v">3600</td></tr>
<tr><td class="e">apc.serializer</td><td class="v">default</td><td class="v">default</td></tr>
<tr><td class="e">apc.shm_segments</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">apc.shm_size</td><td class="v">32M</td><td class="v">32M</td></tr>
<tr><td class="e">apc.slam_defense</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.stat</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.stat_ctime</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">apc.ttl</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">apc.use_request_time</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">apc.user_entries_hint</td><td class="v">4096</td><td class="v">4096</td></tr>
<tr><td class="e">apc.user_ttl</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">apc.write_lock</td><td class="v">On</td><td class="v">On</td></tr>
</table><br />
<h2><a name="module_bz2">bz2</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">BZip2 Support </td><td class="v">Enabled </td></tr>
<tr><td class="e">Stream Wrapper support </td><td class="v">compress.bzip2:// </td></tr>
<tr><td class="e">Stream Filter support </td><td class="v">bzip2.decompress, bzip2.compress </td></tr>
<tr><td class="e">BZip2 Version </td><td class="v">1.0.5, 10-Dec-2007 </td></tr>
</table><br />
<h2><a name="module_calendar">calendar</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Calendar support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_Core">Core</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">PHP Version </td><td class="v">5.3.21 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">allow_call_time_pass_reference</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">allow_url_fopen</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">allow_url_include</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">always_populate_raw_post_data</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">arg_separator.input</td><td class="v">&amp;</td><td class="v">&amp;</td></tr>
<tr><td class="e">arg_separator.output</td><td class="v">&amp;</td><td class="v">&amp;</td></tr>
<tr><td class="e">asp_tags</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">auto_append_file</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">auto_globals_jit</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">auto_prepend_file</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">browscap</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">default_charset</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">default_mimetype</td><td class="v">text/html</td><td class="v">text/html</td></tr>
<tr><td class="e">define_syslog_variables</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">disable_classes</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">disable_functions</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">display_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">display_startup_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">doc_root</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">docref_ext</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">docref_root</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">enable_dl</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">error_append_string</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">error_log</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">error_prepend_string</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">error_reporting</td><td class="v">0</td><td class="v">30711</td></tr>
<tr><td class="e">exit_on_timeout</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">expose_php</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">extension_dir</td><td class="v">/usr/lib64/php/modules</td><td class="v">/usr/lib64/php/modules</td></tr>
<tr><td class="e">file_uploads</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">highlight.bg</td><td class="v"><font style="color: #FFFFFF">#FFFFFF</font></td><td class="v"><font style="color: #FFFFFF">#FFFFFF</font></td></tr>
<tr><td class="e">highlight.comment</td><td class="v"><font style="color: #FF8000">#FF8000</font></td><td class="v"><font style="color: #FF8000">#FF8000</font></td></tr>
<tr><td class="e">highlight.default</td><td class="v"><font style="color: #0000BB">#0000BB</font></td><td class="v"><font style="color: #0000BB">#0000BB</font></td></tr>
<tr><td class="e">highlight.html</td><td class="v"><font style="color: #000000">#000000</font></td><td class="v"><font style="color: #000000">#000000</font></td></tr>
<tr><td class="e">highlight.keyword</td><td class="v"><font style="color: #007700">#007700</font></td><td class="v"><font style="color: #007700">#007700</font></td></tr>
<tr><td class="e">highlight.string</td><td class="v"><font style="color: #DD0000">#DD0000</font></td><td class="v"><font style="color: #DD0000">#DD0000</font></td></tr>
<tr><td class="e">html_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">ignore_repeated_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">ignore_repeated_source</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">ignore_user_abort</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">implicit_flush</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">include_path</td><td class="v">.:/usr/share/pear:/usr/share/php</td><td class="v">.:/usr/share/pear:/usr/share/php</td></tr>
<tr><td class="e">log_errors</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">log_errors_max_len</td><td class="v">1024</td><td class="v">1024</td></tr>
<tr><td class="e">magic_quotes_gpc</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">magic_quotes_runtime</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">magic_quotes_sybase</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">mail.add_x_header</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">mail.force_extra_parameters</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mail.log</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">max_execution_time</td><td class="v">0</td><td class="v">30</td></tr>
<tr><td class="e">max_file_uploads</td><td class="v">20</td><td class="v">20</td></tr>
<tr><td class="e">max_input_nesting_level</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">max_input_time</td><td class="v">60</td><td class="v">60</td></tr>
<tr><td class="e">max_input_vars</td><td class="v">1000</td><td class="v">1000</td></tr>
<tr><td class="e">memory_limit</td><td class="v">64M</td><td class="v">32M</td></tr>
<tr><td class="e">open_basedir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">output_buffering</td><td class="v">4096</td><td class="v">4096</td></tr>
<tr><td class="e">output_handler</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">post_max_size</td><td class="v">8M</td><td class="v">8M</td></tr>
<tr><td class="e">precision</td><td class="v">14</td><td class="v">14</td></tr>
<tr><td class="e">realpath_cache_size</td><td class="v">16K</td><td class="v">16K</td></tr>
<tr><td class="e">realpath_cache_ttl</td><td class="v">120</td><td class="v">120</td></tr>
<tr><td class="e">register_argc_argv</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">register_globals</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">register_long_arrays</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">report_memleaks</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">report_zend_debug</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">request_order</td><td class="v">GP</td><td class="v">GP</td></tr>
<tr><td class="e">safe_mode</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">safe_mode_exec_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">safe_mode_gid</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">safe_mode_include_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">sendmail_from</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">sendmail_path</td><td class="v">/usr/sbin/sendmail&nbsp;-t&nbsp;-i</td><td class="v">/usr/sbin/sendmail&nbsp;-t&nbsp;-i</td></tr>
<tr><td class="e">serialize_precision</td><td class="v">100</td><td class="v">100</td></tr>
<tr><td class="e">short_open_tag</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">SMTP</td><td class="v">localhost</td><td class="v">localhost</td></tr>
<tr><td class="e">smtp_port</td><td class="v">25</td><td class="v">25</td></tr>
<tr><td class="e">sql.safe_mode</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">track_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">unserialize_callback_func</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">upload_max_filesize</td><td class="v">2M</td><td class="v">2M</td></tr>
<tr><td class="e">upload_tmp_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">user_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">user_ini.cache_ttl</td><td class="v">300</td><td class="v">300</td></tr>
<tr><td class="e">user_ini.filename</td><td class="v">.user.ini</td><td class="v">.user.ini</td></tr>
<tr><td class="e">variables_order</td><td class="v">GPCS</td><td class="v">GPCS</td></tr>
<tr><td class="e">xmlrpc_error_number</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">xmlrpc_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">y2k_compliance</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">zend.enable_gc</td><td class="v">On</td><td class="v">On</td></tr>
</table><br />
<h2><a name="module_ctype">ctype</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">ctype functions </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_curl">curl</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">cURL support </td><td class="v">enabled </td></tr>
<tr><td class="e">cURL Information </td><td class="v">7.19.7 </td></tr>
<tr><td class="e">Age </td><td class="v">3 </td></tr>
<tr><td class="e">Features </td></tr>
<tr><td class="e">AsynchDNS </td><td class="v">No </td></tr>
<tr><td class="e">Debug </td><td class="v">No </td></tr>
<tr><td class="e">GSS-Negotiate </td><td class="v">Yes </td></tr>
<tr><td class="e">IDN </td><td class="v">Yes </td></tr>
<tr><td class="e">IPv6 </td><td class="v">Yes </td></tr>
<tr><td class="e">Largefile </td><td class="v">Yes </td></tr>
<tr><td class="e">NTLM </td><td class="v">Yes </td></tr>
<tr><td class="e">SPNEGO </td><td class="v">No </td></tr>
<tr><td class="e">SSL </td><td class="v">Yes </td></tr>
<tr><td class="e">SSPI </td><td class="v">No </td></tr>
<tr><td class="e">krb4 </td><td class="v">No </td></tr>
<tr><td class="e">libz </td><td class="v">Yes </td></tr>
<tr><td class="e">CharConv </td><td class="v">No </td></tr>
<tr><td class="e">Protocols </td><td class="v">tftp, ftp, telnet, dict, ldap, ldaps, http, file, https, ftps, scp, sftp </td></tr>
<tr><td class="e">Host </td><td class="v">x86_64-redhat-linux-gnu </td></tr>
<tr><td class="e">SSL Version </td><td class="v">NSS/3.13.1.0 </td></tr>
<tr><td class="e">ZLib Version </td><td class="v">1.2.3 </td></tr>
<tr><td class="e">libSSH Version </td><td class="v">libssh2/1.2.2 </td></tr>
</table><br />
<h2><a name="module_date">date</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">date/time support </td><td class="v">enabled </td></tr>
<tr><td class="e">&quot;Olson&quot; Timezone Database Version </td><td class="v">0.system </td></tr>
<tr><td class="e">Timezone Database </td><td class="v">internal </td></tr>
<tr><td class="e">Default timezone </td><td class="v">GMT </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">date.default_latitude</td><td class="v">31.7667</td><td class="v">31.7667</td></tr>
<tr><td class="e">date.default_longitude</td><td class="v">35.2333</td><td class="v">35.2333</td></tr>
<tr><td class="e">date.sunrise_zenith</td><td class="v">90.583333</td><td class="v">90.583333</td></tr>
<tr><td class="e">date.sunset_zenith</td><td class="v">90.583333</td><td class="v">90.583333</td></tr>
<tr><td class="e">date.timezone</td><td class="v">America/Chicago</td><td class="v">America/Chicago</td></tr>
</table><br />
<h2><a name="module_dom">dom</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">DOM/XML </td><td class="v">enabled </td></tr>
<tr><td class="e">DOM/XML API Version </td><td class="v">20031129 </td></tr>
<tr><td class="e">libxml Version </td><td class="v">2.7.6 </td></tr>
<tr><td class="e">HTML Support </td><td class="v">enabled </td></tr>
<tr><td class="e">XPath Support </td><td class="v">enabled </td></tr>
<tr><td class="e">XPointer Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Schema Support </td><td class="v">enabled </td></tr>
<tr><td class="e">RelaxNG Support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_ereg">ereg</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Regex Library </td><td class="v">Bundled library enabled </td></tr>
</table><br />
<h2><a name="module_exif">exif</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">EXIF Support </td><td class="v">enabled </td></tr>
<tr><td class="e">EXIF Version </td><td class="v">1.4 $Id$ </td></tr>
<tr><td class="e">Supported EXIF Version </td><td class="v">0220 </td></tr>
<tr><td class="e">Supported filetypes </td><td class="v">JPEG,TIFF </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">exif.decode_jis_intel</td><td class="v">JIS</td><td class="v">JIS</td></tr>
<tr><td class="e">exif.decode_jis_motorola</td><td class="v">JIS</td><td class="v">JIS</td></tr>
<tr><td class="e">exif.decode_unicode_intel</td><td class="v">UCS-2LE</td><td class="v">UCS-2LE</td></tr>
<tr><td class="e">exif.decode_unicode_motorola</td><td class="v">UCS-2BE</td><td class="v">UCS-2BE</td></tr>
<tr><td class="e">exif.encode_jis</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">exif.encode_unicode</td><td class="v">ISO-8859-15</td><td class="v">ISO-8859-15</td></tr>
</table><br />
<h2><a name="module_fileinfo">fileinfo</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">fileinfo support </td><td class="v">enabled </td></tr>
<tr><td class="e">version </td><td class="v">1.0.5-dev </td></tr>
</table><br />
<h2><a name="module_filter">filter</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Input Validation and Filtering </td><td class="v">enabled </td></tr>
<tr><td class="e">Revision </td><td class="v">$Id: 209a1c3c98c04a5474846e7bbe8ca72054ccfd4f $ </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">filter.default</td><td class="v">unsafe_raw</td><td class="v">unsafe_raw</td></tr>
<tr><td class="e">filter.default_flags</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_ftp">ftp</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">FTP support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_gd">gd</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">GD Support </td><td class="v">enabled </td></tr>
<tr><td class="e">GD Version </td><td class="v">bundled (2.0.34 compatible) </td></tr>
<tr><td class="e">FreeType Support </td><td class="v">enabled </td></tr>
<tr><td class="e">FreeType Linkage </td><td class="v">with freetype </td></tr>
<tr><td class="e">FreeType Version </td><td class="v">2.3.11 </td></tr>
<tr><td class="e">T1Lib Support </td><td class="v">enabled </td></tr>
<tr><td class="e">GIF Read Support </td><td class="v">enabled </td></tr>
<tr><td class="e">GIF Create Support </td><td class="v">enabled </td></tr>
<tr><td class="e">JPEG Support </td><td class="v">enabled </td></tr>
<tr><td class="e">libJPEG Version </td><td class="v">6b </td></tr>
<tr><td class="e">PNG Support </td><td class="v">enabled </td></tr>
<tr><td class="e">libPNG Version </td><td class="v">1.2.49 </td></tr>
<tr><td class="e">WBMP Support </td><td class="v">enabled </td></tr>
<tr><td class="e">XPM Support </td><td class="v">enabled </td></tr>
<tr><td class="e">libXpm Version </td><td class="v">30411 </td></tr>
<tr><td class="e">XBM Support </td><td class="v">enabled </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">gd.jpeg_ignore_warning</td><td class="v">0</td><td class="v">0</td></tr>
</table><br />
<h2><a name="module_gettext">gettext</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">GetText Support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_gmp">gmp</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">gmp support </td><td class="v">enabled </td></tr>
<tr><td class="e">GMP version </td><td class="v">4.3.1 </td></tr>
</table><br />
<h2><a name="module_hash">hash</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">hash support </td><td class="v">enabled </td></tr>
<tr><td class="e">Hashing Engines </td><td class="v">md2 md4 md5 sha1 sha224 sha256 sha384 sha512 ripemd128 ripemd160 ripemd256 ripemd320 whirlpool tiger128,3 tiger160,3 tiger192,3 tiger128,4 tiger160,4 tiger192,4 snefru snefru256 gost adler32 crc32 crc32b salsa10 salsa20 haval128,3 haval160,3 haval192,3 haval224,3 haval256,3 haval128,4 haval160,4 haval192,4 haval224,4 haval256,4 haval128,5 haval160,5 haval192,5 haval224,5 haval256,5  </td></tr>
</table><br />
<h2><a name="module_iconv">iconv</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">iconv support </td><td class="v">enabled </td></tr>
<tr><td class="e">iconv implementation </td><td class="v">glibc </td></tr>
<tr><td class="e">iconv library version </td><td class="v">2.12 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">iconv.input_encoding</td><td class="v">ISO-8859-1</td><td class="v">ISO-8859-1</td></tr>
<tr><td class="e">iconv.internal_encoding</td><td class="v">ISO-8859-1</td><td class="v">ISO-8859-1</td></tr>
<tr><td class="e">iconv.output_encoding</td><td class="v">ISO-8859-1</td><td class="v">ISO-8859-1</td></tr>
</table><br />
<h2><a name="module_json">json</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">json support </td><td class="v">enabled </td></tr>
<tr><td class="e">json version </td><td class="v">1.2.1 </td></tr>
</table><br />
<h2><a name="module_libxml">libxml</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">libXML support </td><td class="v">active </td></tr>
<tr><td class="e">libXML Compiled Version </td><td class="v">2.7.6 </td></tr>
<tr><td class="e">libXML Loaded Version </td><td class="v">20706 </td></tr>
<tr><td class="e">libXML streams </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_mbstring">mbstring</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Multibyte Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Multibyte string engine </td><td class="v">libmbfl </td></tr>
<tr><td class="e">HTTP input encoding translation </td><td class="v">disabled </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>mbstring extension makes use of "streamable kanji code filter and converter", which is distributed under the GNU Lesser General Public License version 2.1.</th></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Multibyte (japanese) regex support </td><td class="v">enabled </td></tr>
<tr><td class="e">Multibyte regex (oniguruma) backtrack check </td><td class="v">On </td></tr>
<tr><td class="e">Multibyte regex (oniguruma) version </td><td class="v">4.7.1 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">mbstring.detect_order</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mbstring.encoding_translation</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">mbstring.func_overload</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">mbstring.http_input</td><td class="v">pass</td><td class="v">pass</td></tr>
<tr><td class="e">mbstring.http_output</td><td class="v">pass</td><td class="v">pass</td></tr>
<tr><td class="e">mbstring.http_output_conv_mimetypes</td><td class="v">^(text/|application/xhtml\+xml)</td><td class="v">^(text/|application/xhtml\+xml)</td></tr>
<tr><td class="e">mbstring.internal_encoding</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mbstring.language</td><td class="v">neutral</td><td class="v">neutral</td></tr>
<tr><td class="e">mbstring.strict_detection</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">mbstring.substitute_character</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_mcrypt">mcrypt</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>mcrypt support</th><th>enabled</th></tr>
<tr class="h"><th>mcrypt_filter support</th><th>enabled</th></tr>
<tr><td class="e">Version </td><td class="v">2.5.8 </td></tr>
<tr><td class="e">Api No </td><td class="v">20021217 </td></tr>
<tr><td class="e">Supported ciphers </td><td class="v">cast-128 gost rijndael-128 twofish arcfour cast-256 loki97 rijndael-192 saferplus wake blowfish-compat des rijndael-256 serpent xtea blowfish enigma rc2 tripledes  </td></tr>
<tr><td class="e">Supported modes </td><td class="v">cbc cfb ctr ecb ncfb nofb ofb stream  </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">mcrypt.algorithms_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mcrypt.modes_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_mysql">mysql</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>MySQL Support</th><th>enabled</th></tr>
<tr><td class="e">Active Persistent Links </td><td class="v">0 </td></tr>
<tr><td class="e">Active Links </td><td class="v">0 </td></tr>
<tr><td class="e">Client API version </td><td class="v">5.1.61 </td></tr>
<tr><td class="e">MYSQL_MODULE_TYPE </td><td class="v">external </td></tr>
<tr><td class="e">MYSQL_SOCKET </td><td class="v">/var/lib/mysql/mysql.sock </td></tr>
<tr><td class="e">MYSQL_INCLUDE </td><td class="v">-I/usr/include/mysql </td></tr>
<tr><td class="e">MYSQL_LIBS </td><td class="v">-L/usr/lib64/mysql -lmysqlclient  </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">mysql.allow_local_infile</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">mysql.allow_persistent</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">mysql.connect_timeout</td><td class="v">60</td><td class="v">60</td></tr>
<tr><td class="e">mysql.default_host</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysql.default_password</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysql.default_port</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysql.default_socket</td><td class="v">/var/lib/mysql/mysql.sock</td><td class="v">/var/lib/mysql/mysql.sock</td></tr>
<tr><td class="e">mysql.default_user</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysql.max_links</td><td class="v">Unlimited</td><td class="v">Unlimited</td></tr>
<tr><td class="e">mysql.max_persistent</td><td class="v">Unlimited</td><td class="v">Unlimited</td></tr>
<tr><td class="e">mysql.trace_mode</td><td class="v">Off</td><td class="v">Off</td></tr>
</table><br />
<h2><a name="module_mysqli">mysqli</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>MysqlI Support</th><th>enabled</th></tr>
<tr><td class="e">Client API library version </td><td class="v">5.1.61 </td></tr>
<tr><td class="e">Active Persistent Links </td><td class="v">0 </td></tr>
<tr><td class="e">Inactive Persistent Links </td><td class="v">0 </td></tr>
<tr><td class="e">Active Links </td><td class="v">0 </td></tr>
<tr><td class="e">Client API header version </td><td class="v">5.1.66 </td></tr>
<tr><td class="e">MYSQLI_SOCKET </td><td class="v">/var/lib/mysql/mysql.sock </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">mysqli.allow_local_infile</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">mysqli.allow_persistent</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">mysqli.default_host</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysqli.default_port</td><td class="v">3306</td><td class="v">3306</td></tr>
<tr><td class="e">mysqli.default_pw</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysqli.default_socket</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysqli.default_user</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">mysqli.max_links</td><td class="v">Unlimited</td><td class="v">Unlimited</td></tr>
<tr><td class="e">mysqli.max_persistent</td><td class="v">Unlimited</td><td class="v">Unlimited</td></tr>
<tr><td class="e">mysqli.reconnect</td><td class="v">Off</td><td class="v">Off</td></tr>
</table><br />
<h2><a name="module_openssl">openssl</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">OpenSSL support </td><td class="v">enabled </td></tr>
<tr><td class="e">OpenSSL Library Version </td><td class="v">OpenSSL 1.0.0-fips 29 Mar 2010 </td></tr>
<tr><td class="e">OpenSSL Header Version </td><td class="v">OpenSSL 1.0.0-fips 29 Mar 2010 </td></tr>
</table><br />
<h2><a name="module_pcre">pcre</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">PCRE (Perl Compatible Regular Expressions) Support </td><td class="v">enabled </td></tr>
<tr><td class="e">PCRE Library Version </td><td class="v">8.31 2012-07-06 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">pcre.backtrack_limit</td><td class="v">1000000</td><td class="v">1000000</td></tr>
<tr><td class="e">pcre.recursion_limit</td><td class="v">100000</td><td class="v">100000</td></tr>
</table><br />
<h2><a name="module_PDO">PDO</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>PDO support</th><th>enabled</th></tr>
<tr><td class="e">PDO drivers </td><td class="v">mysql, sqlite </td></tr>
</table><br />
<h2><a name="module_pdo_mysql">pdo_mysql</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>PDO Driver for MySQL</th><th>enabled</th></tr>
<tr><td class="e">Client API version </td><td class="v">5.1.61 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">pdo_mysql.default_socket</td><td class="v">/var/lib/mysql/mysql.sock</td><td class="v">/var/lib/mysql/mysql.sock</td></tr>
</table><br />
<h2><a name="module_pdo_sqlite">pdo_sqlite</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>PDO Driver for SQLite 3.x</th><th>enabled</th></tr>
<tr><td class="e">SQLite Library </td><td class="v">3.6.20 </td></tr>
</table><br />
<h2><a name="module_Phar">Phar</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Phar: PHP Archive support</th><th>enabled</th></tr>
<tr><td class="e">Phar EXT version </td><td class="v">2.0.1 </td></tr>
<tr><td class="e">Phar API version </td><td class="v">1.1.1 </td></tr>
<tr><td class="e">SVN revision </td><td class="v">$Id: 7b7d559811a842dc9e7d33777a8f993aa2b9933d $ </td></tr>
<tr><td class="e">Phar-based phar archives </td><td class="v">enabled </td></tr>
<tr><td class="e">Tar-based phar archives </td><td class="v">enabled </td></tr>
<tr><td class="e">ZIP-based phar archives </td><td class="v">enabled </td></tr>
<tr><td class="e">gzip compression </td><td class="v">enabled </td></tr>
<tr><td class="e">bzip2 compression </td><td class="v">enabled </td></tr>
<tr><td class="e">Native OpenSSL support </td><td class="v">enabled </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="v"><td>
Phar based on pear/PHP_Archive, original concept by Davey Shafik.<br />Phar fully realized by Gregory Beaver and Marcus Boerger.<br />Portions of tar implementation Copyright (c) 2003-2009 Tim Kientzle.</td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">phar.cache_list</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">phar.readonly</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">phar.require_hash</td><td class="v">On</td><td class="v">On</td></tr>
</table><br />
<h2><a name="module_Reflection">Reflection</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Reflection</th><th>enabled</th></tr>
<tr><td class="e">Version </td><td class="v">$Id: 4af6c4c676864b1c0bfa693845af0688645c37cf $ </td></tr>
</table><br />
<h2><a name="module_session">session</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Session Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Registered save handlers </td><td class="v">files user  </td></tr>
<tr><td class="e">Registered serializer handlers </td><td class="v">php php_binary wddx  </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">session.auto_start</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">session.bug_compat_42</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">session.bug_compat_warn</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">session.cache_expire</td><td class="v">180</td><td class="v">180</td></tr>
<tr><td class="e">session.cache_limiter</td><td class="v">nocache</td><td class="v">nocache</td></tr>
<tr><td class="e">session.cookie_domain</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">session.cookie_httponly</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">session.cookie_lifetime</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">session.cookie_path</td><td class="v">/</td><td class="v">/</td></tr>
<tr><td class="e">session.cookie_secure</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">session.entropy_file</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">session.entropy_length</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">session.gc_divisor</td><td class="v">1000</td><td class="v">1000</td></tr>
<tr><td class="e">session.gc_maxlifetime</td><td class="v">1440</td><td class="v">1440</td></tr>
<tr><td class="e">session.gc_probability</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">session.hash_bits_per_character</td><td class="v">5</td><td class="v">5</td></tr>
<tr><td class="e">session.hash_function</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">session.name</td><td class="v">PHPSESSID</td><td class="v">PHPSESSID</td></tr>
<tr><td class="e">session.referer_check</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">session.save_handler</td><td class="v">files</td><td class="v">files</td></tr>
<tr><td class="e">session.save_path</td><td class="v">/var/lib/php/session</td><td class="v">/var/lib/php/session</td></tr>
<tr><td class="e">session.serialize_handler</td><td class="v">php</td><td class="v">php</td></tr>
<tr><td class="e">session.use_cookies</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">session.use_only_cookies</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">session.use_trans_sid</td><td class="v">0</td><td class="v">0</td></tr>
</table><br />
<h2><a name="module_shmop">shmop</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">shmop support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_SimpleXML">SimpleXML</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Simplexml support</th><th>enabled</th></tr>
<tr><td class="e">Revision </td><td class="v">$Id: 02ab7893b36d51e9c59da77d7e287eb3b35e1e32 $ </td></tr>
<tr><td class="e">Schema support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_sockets">sockets</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Sockets Support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_SPL">SPL</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>SPL support</th><th>enabled</th></tr>
<tr><td class="e">Interfaces </td><td class="v">Countable, OuterIterator, RecursiveIterator, SeekableIterator, SplObserver, SplSubject </td></tr>
<tr><td class="e">Classes </td><td class="v">AppendIterator, ArrayIterator, ArrayObject, BadFunctionCallException, BadMethodCallException, CachingIterator, DirectoryIterator, DomainException, EmptyIterator, FilesystemIterator, FilterIterator, GlobIterator, InfiniteIterator, InvalidArgumentException, IteratorIterator, LengthException, LimitIterator, LogicException, MultipleIterator, NoRewindIterator, OutOfBoundsException, OutOfRangeException, OverflowException, ParentIterator, RangeException, RecursiveArrayIterator, RecursiveCachingIterator, RecursiveDirectoryIterator, RecursiveFilterIterator, RecursiveIteratorIterator, RecursiveRegexIterator, RecursiveTreeIterator, RegexIterator, RuntimeException, SplDoublyLinkedList, SplFileInfo, SplFileObject, SplFixedArray, SplHeap, SplMinHeap, SplMaxHeap, SplObjectStorage, SplPriorityQueue, SplQueue, SplStack, SplTempFileObject, UnderflowException, UnexpectedValueException </td></tr>
</table><br />
<h2><a name="module_sqlite3">sqlite3</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>SQLite3 support</th><th>enabled</th></tr>
<tr><td class="e">SQLite3 module version </td><td class="v">0.7-dev </td></tr>
<tr><td class="e">SQLite Library </td><td class="v">3.7.7.1 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">sqlite3.extension_dir</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_standard">standard</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Dynamic Library Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Path to sendmail </td><td class="v">/usr/sbin/sendmail -t -i </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">assert.active</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">assert.bail</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">assert.callback</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">assert.quiet_eval</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">assert.warning</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">auto_detect_line_endings</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">default_socket_timeout</td><td class="v">60</td><td class="v">60</td></tr>
<tr><td class="e">from</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">safe_mode_allowed_env_vars</td><td class="v">PHP_</td><td class="v">PHP_</td></tr>
<tr><td class="e">safe_mode_protected_env_vars</td><td class="v">LD_LIBRARY_PATH</td><td class="v">LD_LIBRARY_PATH</td></tr>
<tr><td class="e">url_rewriter.tags</td><td class="v">a=href,area=href,frame=src,input=src,form=fakeentry</td><td class="v">a=href,area=href,frame=src,input=src,form=fakeentry</td></tr>
<tr><td class="e">user_agent</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_suhosin">suhosin</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="v"><td>
<a href="http://www.suhosin.org/"><img border="0" src="data:image/jpeg;base64,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" alt="Suhosin logo" /></a>
This server is protected with the Suhosin Extension 0.9.29<br /><br />Copyright (c) 2006-2007 <a href="http://www.hardened-php.net/">Hardened-PHP Project</a><br />
Copyright (c) 2007-2008 <a href="http://www.sektioneins.de/">SektionEins GmbH</a>
</td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">suhosin.apc_bug_workaround</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.cookie.checkraddr</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.cookie.cryptdocroot</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.cookie.cryptkey</td><td class="v">[ protected ]</td><td class="v">[ protected ]</td></tr>
<tr><td class="e">suhosin.cookie.cryptlist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.cookie.cryptraddr</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.cookie.cryptua</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.cookie.disallow_nul</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.cookie.disallow_ws</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.cookie.encrypt</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.cookie.max_array_depth</td><td class="v">50</td><td class="v">50</td></tr>
<tr><td class="e">suhosin.cookie.max_array_index_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.cookie.max_name_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.cookie.max_totalname_length</td><td class="v">256</td><td class="v">256</td></tr>
<tr><td class="e">suhosin.cookie.max_value_length</td><td class="v">10000</td><td class="v">10000</td></tr>
<tr><td class="e">suhosin.cookie.max_vars</td><td class="v">100</td><td class="v">100</td></tr>
<tr><td class="e">suhosin.cookie.plainlist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.coredump</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.disable.display_errors</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.executor.allow_symlink</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.executor.disable_emodifier</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.executor.disable_eval</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.executor.eval.blacklist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.eval.whitelist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.func.blacklist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.func.whitelist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.include.allow_writable_files</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.executor.include.blacklist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.include.max_traversal</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.executor.include.whitelist</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.executor.max_depth</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.filter.action</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.get.disallow_nul</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.get.disallow_ws</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.get.max_array_depth</td><td class="v">50</td><td class="v">50</td></tr>
<tr><td class="e">suhosin.get.max_array_index_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.get.max_name_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.get.max_totalname_length</td><td class="v">256</td><td class="v">256</td></tr>
<tr><td class="e">suhosin.get.max_value_length</td><td class="v">512</td><td class="v">512</td></tr>
<tr><td class="e">suhosin.get.max_vars</td><td class="v">100</td><td class="v">100</td></tr>
<tr><td class="e">suhosin.log.file</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.log.file.name</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.phpscript</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.log.phpscript.is_safe</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.log.phpscript.name</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.sapi</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.log.script</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.log.script.name</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.syslog</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.syslog.facility</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.syslog.priority</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.log.use-x-forwarded-for</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.mail.protect</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.memory_limit</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.mt_srand.ignore</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.multiheader</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.perdir</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.post.disallow_nul</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.post.disallow_ws</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.post.max_array_depth</td><td class="v">50</td><td class="v">50</td></tr>
<tr><td class="e">suhosin.post.max_array_index_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.post.max_name_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.post.max_totalname_length</td><td class="v">256</td><td class="v">256</td></tr>
<tr><td class="e">suhosin.post.max_value_length</td><td class="v">1000000</td><td class="v">1000000</td></tr>
<tr><td class="e">suhosin.post.max_vars</td><td class="v">1000</td><td class="v">1000</td></tr>
<tr><td class="e">suhosin.protectkey</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.request.disallow_nul</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.request.disallow_ws</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.request.max_array_depth</td><td class="v">50</td><td class="v">50</td></tr>
<tr><td class="e">suhosin.request.max_array_index_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.request.max_totalname_length</td><td class="v">256</td><td class="v">256</td></tr>
<tr><td class="e">suhosin.request.max_value_length</td><td class="v">1000000</td><td class="v">1000000</td></tr>
<tr><td class="e">suhosin.request.max_varname_length</td><td class="v">64</td><td class="v">64</td></tr>
<tr><td class="e">suhosin.request.max_vars</td><td class="v">1000</td><td class="v">1000</td></tr>
<tr><td class="e">suhosin.server.encode</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.server.strip</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.session.checkraddr</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.session.cryptdocroot</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.session.cryptkey</td><td class="v">[ protected ]</td><td class="v">[ protected ]</td></tr>
<tr><td class="e">suhosin.session.cryptraddr</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.session.cryptua</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.session.encrypt</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.session.max_id_length</td><td class="v">128</td><td class="v">128</td></tr>
<tr><td class="e">suhosin.simulation</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.sql.bailout_on_error</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">suhosin.sql.comment</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.sql.multiselect</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.sql.opencomment</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.sql.union</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.sql.user_postfix</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.sql.user_prefix</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">suhosin.srand.ignore</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.stealth</td><td class="v">On</td><td class="v">On</td></tr>
<tr><td class="e">suhosin.upload.disallow_binary</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.upload.disallow_elf</td><td class="v">1</td><td class="v">1</td></tr>
<tr><td class="e">suhosin.upload.max_uploads</td><td class="v">25</td><td class="v">25</td></tr>
<tr><td class="e">suhosin.upload.remove_binary</td><td class="v">0</td><td class="v">0</td></tr>
<tr><td class="e">suhosin.upload.verification_script</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2><a name="module_tokenizer">tokenizer</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Tokenizer Support </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_wddx">wddx</a></h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>WDDX Support</th><th>enabled</th></tr>
<tr><td class="e">WDDX Session Serializer </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_xml">xml</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">XML Support </td><td class="v">active </td></tr>
<tr><td class="e">XML Namespace Support </td><td class="v">active </td></tr>
<tr><td class="e">libxml2 Version </td><td class="v">2.7.6 </td></tr>
</table><br />
<h2><a name="module_xmlreader">xmlreader</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">XMLReader </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_xmlwriter">xmlwriter</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">XMLWriter </td><td class="v">enabled </td></tr>
</table><br />
<h2><a name="module_xsl">xsl</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">XSL </td><td class="v">enabled </td></tr>
<tr><td class="e">libxslt Version </td><td class="v">1.1.26 </td></tr>
<tr><td class="e">libxslt compiled against libxml Version </td><td class="v">2.7.6 </td></tr>
<tr><td class="e">EXSLT </td><td class="v">enabled </td></tr>
<tr><td class="e">libexslt Version </td><td class="v">1.1.26 </td></tr>
</table><br />
<h2><a name="module_zip">zip</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">Zip </td><td class="v">enabled </td></tr>
<tr><td class="e">Extension Version </td><td class="v">$Id: bdd35a2ede0347a3df239de1e7dc5d7e588f00c3 $ </td></tr>
<tr><td class="e">Zip version </td><td class="v">1.11.0 </td></tr>
<tr><td class="e">Libzip version </td><td class="v">0.10.1 </td></tr>
</table><br />
<h2><a name="module_zlib">zlib</a></h2>
<table border="0" cellpadding="3" width="600">
<tr><td class="e">ZLib Support </td><td class="v">enabled </td></tr>
<tr><td class="e">Stream Wrapper support </td><td class="v">compress.zlib:// </td></tr>
<tr><td class="e">Stream Filter support </td><td class="v">zlib.inflate, zlib.deflate </td></tr>
<tr><td class="e">Compiled Version </td><td class="v">1.2.3 </td></tr>
<tr><td class="e">Linked Version </td><td class="v">1.2.3 </td></tr>
</table><br />
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Directive</th><th>Local Value</th><th>Master Value</th></tr>
<tr><td class="e">zlib.output_compression</td><td class="v">Off</td><td class="v">Off</td></tr>
<tr><td class="e">zlib.output_compression_level</td><td class="v">-1</td><td class="v">-1</td></tr>
<tr><td class="e">zlib.output_handler</td><td class="v"><i>no value</i></td><td class="v"><i>no value</i></td></tr>
</table><br />
<h2>Additional Modules</h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Module Name</th></tr>
</table><br />
<h2>Environment</h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Variable</th><th>Value</th></tr>
<tr><td class="e">MONIT_DATE </td><td class="v">Mon, 18 Feb 2013 19:52:03 -0600 </td></tr>
<tr><td class="e">MONIT_HOST </td><td class="v">wheelstvplatform </td></tr>
<tr><td class="e">PATH </td><td class="v">/sbin:/usr/sbin:/bin:/usr/bin </td></tr>
<tr><td class="e">PWD </td><td class="v">/ </td></tr>
<tr><td class="e">LANG </td><td class="v">C </td></tr>
<tr><td class="e">MONIT_PROCESS_PID </td><td class="v">0 </td></tr>
<tr><td class="e">MONIT_EVENT </td><td class="v">Started </td></tr>
<tr><td class="e">MONIT_PROCESS_MEMORY </td><td class="v">0 </td></tr>
<tr><td class="e">SHLVL </td><td class="v">2 </td></tr>
<tr><td class="e">MONIT_PROCESS_CPU_PERCENT </td><td class="v">0 </td></tr>
<tr><td class="e">MONIT_SERVICE </td><td class="v">apache </td></tr>
<tr><td class="e">MONIT_PROCESS_CHILDREN </td><td class="v">0 </td></tr>
<tr><td class="e">MONIT_DESCRIPTION </td><td class="v">failed protocol test [HTTP] at INET[localhost:80] via TCP </td></tr>
<tr><td class="e">_ </td><td class="v">/usr/sbin/httpd </td></tr>
</table><br />
<h2>PHP Variables</h2>
<table border="0" cellpadding="3" width="600">
<tr class="h"><th>Variable</th><th>Value</th></tr>
<tr><td class="e">_REQUEST["do"]</td><td class="v">/install/requirement/sessionid_5123efcd64e77/</td></tr>
<tr><td class="e">_REQUEST["core"]</td><td class="v"><pre>Array
(
    [security_token] =&gt; 
)
</pre></td></tr>
<tr><td class="e">_REQUEST["val"]</td><td class="v"><pre>Array
(
    [passed] =&gt; 1
)
</pre></td></tr>
<tr><td class="e">_GET["do"]</td><td class="v">/install/requirement/sessionid_5123efcd64e77/</td></tr>
<tr><td class="e">_POST["core"]</td><td class="v"><pre>Array
(
    [security_token] =&gt; 
)
</pre></td></tr>
<tr><td class="e">_POST["val"]</td><td class="v"><pre>Array
(
    [passed] =&gt; 1
)
</pre></td></tr>
<tr><td class="e">_COOKIE["PHPSESSID"]</td><td class="v">oldar8kr6jpe1lflp9o3cbj5c3</td></tr>
<tr><td class="e">_SERVER["HTTP_HOST"]</td><td class="v">wtvdvs.com</td></tr>
<tr><td class="e">_SERVER["HTTP_CONNECTION"]</td><td class="v">keep-alive</td></tr>
<tr><td class="e">_SERVER["CONTENT_LENGTH"]</td><td class="v">43</td></tr>
<tr><td class="e">_SERVER["HTTP_CACHE_CONTROL"]</td><td class="v">max-age=0</td></tr>
<tr><td class="e">_SERVER["HTTP_ACCEPT"]</td><td class="v">text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</td></tr>
<tr><td class="e">_SERVER["HTTP_ORIGIN"]</td><td class="v">http://wtvdvs.com</td></tr>
<tr><td class="e">_SERVER["HTTP_USER_AGENT"]</td><td class="v">Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17</td></tr>
<tr><td class="e">_SERVER["CONTENT_TYPE"]</td><td class="v">application/x-www-form-urlencoded</td></tr>
<tr><td class="e">_SERVER["HTTP_REFERER"]</td><td class="v">http://wtvdvs.com/install/index.php?do=/install/requirement/sessionid_5123efcd64e77/</td></tr>
<tr><td class="e">_SERVER["HTTP_ACCEPT_ENCODING"]</td><td class="v">gzip,deflate,sdch</td></tr>
<tr><td class="e">_SERVER["HTTP_ACCEPT_LANGUAGE"]</td><td class="v">en-US,en;q=0.8</td></tr>
<tr><td class="e">_SERVER["HTTP_ACCEPT_CHARSET"]</td><td class="v">ISO-8859-1,utf-8;q=0.7,*;q=0.3</td></tr>
<tr><td class="e">_SERVER["HTTP_COOKIE"]</td><td class="v">PHPSESSID=oldar8kr6jpe1lflp9o3cbj5c3</td></tr>
<tr><td class="e">_SERVER["PATH"]</td><td class="v">/sbin:/usr/sbin:/bin:/usr/bin</td></tr>
<tr><td class="e">_SERVER["SERVER_SIGNATURE"]</td><td class="v"><i>no value</i></td></tr>
<tr><td class="e">_SERVER["SERVER_SOFTWARE"]</td><td class="v">Apache</td></tr>
<tr><td class="e">_SERVER["SERVER_NAME"]</td><td class="v">wtvdvs.com</td></tr>
<tr><td class="e">_SERVER["SERVER_ADDR"]</td><td class="v">50.56.179.230</td></tr>
<tr><td class="e">_SERVER["SERVER_PORT"]</td><td class="v">80</td></tr>
<tr><td class="e">_SERVER["REMOTE_ADDR"]</td><td class="v">72.67.59.50</td></tr>
<tr><td class="e">_SERVER["DOCUMENT_ROOT"]</td><td class="v">/var/www/html</td></tr>
<tr><td class="e">_SERVER["SERVER_ADMIN"]</td><td class="v">root@localhost</td></tr>
<tr><td class="e">_SERVER["SCRIPT_FILENAME"]</td><td class="v">/var/www/html/install/index.php</td></tr>
<tr><td class="e">_SERVER["REMOTE_PORT"]</td><td class="v">57140</td></tr>
<tr><td class="e">_SERVER["GATEWAY_INTERFACE"]</td><td class="v">CGI/1.1</td></tr>
<tr><td class="e">_SERVER["SERVER_PROTOCOL"]</td><td class="v">HTTP/1.1</td></tr>
<tr><td class="e">_SERVER["REQUEST_METHOD"]</td><td class="v">POST</td></tr>
<tr><td class="e">_SERVER["QUERY_STRING"]</td><td class="v">do=/install/requirement/sessionid_5123efcd64e77/</td></tr>
<tr><td class="e">_SERVER["REQUEST_URI"]</td><td class="v">/install/index.php?do=/install/requirement/sessionid_5123efcd64e77/</td></tr>
<tr><td class="e">_SERVER["SCRIPT_NAME"]</td><td class="v">/install/index.php</td></tr>
<tr><td class="e">_SERVER["PHP_SELF"]</td><td class="v">/install/index.php</td></tr>
<tr><td class="e">_SERVER["REQUEST_TIME"]</td><td class="v">1361309783</td></tr>
</table><br />
<h2>PHP License</h2>
<table border="0" cellpadding="3" width="600">
<tr class="v"><td>
<p>
This program is free software; you can redistribute it and/or modify it under the terms of the PHP License as published by the PHP Group and included in the distribution in the file:  LICENSE
</p>
<p>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
</p>
<p>If you did not receive a copy of the PHP license, or have any questions about PHP licensing, please contact license@php.net.
</p>
</td></tr>
</table><br />
</div></body></html>