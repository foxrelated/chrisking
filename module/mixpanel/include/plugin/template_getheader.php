<?php ?>
<!-- start Mixpanel -->
<script type="text/javascript">(function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
        for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
    mixpanel.init("6ddfad2250ea3cd64e7c28a689cb3444");
</script>
<!-- end Mixpanel -->

<?php
if (Phpfox::getLib('request')->get('req1') != 'admincp') {
    if (Phpfox::isUser()) {
        $aMixPanelUser = Phpfox::getService('mixpanel')->get(Phpfox::getUserId());
        Phpfox::getLib('template')->setHeader('<script type="text/javascript">
        mixpanel.identify("' . Phpfox::getUserId() . '");
        mixpanel.people.set({
            "$id": "' . $aMixPanelUser['user_id'] . '",
            "$first_name": "' . $aMixPanelUser['first_name'] . '",
            "$last_name": "' . $aMixPanelUser['first_name'] . '",
            "$created": "' . date("F j, Y, g:i a", $aMixPanelUser['joined']) . '",
            "$email": "' . $aMixPanelUser['email'] . '",
            "$last_login": "' . date("F j, Y, g:i a", $aMixPanelUser['last_login']) . '",
            "$user_group": "' . $aMixPanelUser['user_group_title'] . '"
        });
    </script>');
    } else {
        Phpfox::getLib('template')->setHeader('<script type="text/javascript">
        mixpanel.identify("anonymous");
        mixpanel.people.set({
            "$id": "null",
            "$first_name": "null",
            "$last_name": "null",
            "$created": "null",
            "$email": "null",
            "$last_login": "null",
            "$user_group": "null"
        });
    </script>');
    }
}
?>