{assign var="turl" value=$aDvs.title_url}
{assign var="tdvs" value=$aDvs.dvs_id}
{if $bSubdomainMode}
    {assign var="surl" value="//".$turl.".".$urll."/"}
{else}
    {assign var="surl" value="//dvs.".$urll."/".$turl."/"}
{/if}
1. Create a new page called Virtual Test Drive and add this javascript code as HTML source code (not as an iframe widget):

<div id="dvs_wrapper"></div>
<script type="text/javascript" src="{$stCorePath}module/dvs/static/jscript/embed.js"></script>
<script type="text/javascript">
    WTVDVS.render_iframe({l}
        "id" : "dvs_wrapper",
        "width" : 952,
        "height" : 1000,
        "iframeUrl" : "{$surl}iframe/",
    {r});
</script>

2. Add link to Virtual Test Drive page under the New and Used navigation menu.

3. Use the DVS third-party tool to integrate the DVS on the VLP and VDP templates for New and Used inventory using the following parameters:

DVS ID: {$aDvs.dvs_id}

Position: mediabot