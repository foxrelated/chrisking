<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'dvs.global_google_id\'))
{
	echo "<script type=\\"text/javascript\\">
  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'" . Phpfox::getParam(\'dvs.global_google_id\') . "\']);
  _gaq.push([\'_trackPageview\']);
  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();
" . (Phpfox::getParam(\'dvs.javascript_debug_mode\') ? "console.log(\'Google: Analytics going out for global page view.\');" : "") . "
</script>";
} '; ?>