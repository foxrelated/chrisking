{assign var="turl" value=$aDvs.title_url}
{assign var="tdvs" value=$aDvs.dvs_id}
{if $bSubdomainMode}
    {assign var="surl" value="//".$turl.".".$urll."/"}
    
{else}
    {assign var="surl" value="//dvs.".$urll."/".$turl."/"}
{/if}
{assign var="styleURL" value="//dvs.".$urll."/vin/style/id_".$tdvs."/"}
{assign var="scriptURL" value="//dvs.".$urll."/vin/script/id_".$tdvs."/"}
{assign var="apiURL" value="//www.".$urll}
1. Create a new page called Virtual Test Drive and add this javascript code as HTML source code (not as an iframe widget):

<div id="dvs_wrapper"></div>
<script type="text/javascript" src="{$stCorePath}module/dvs/static/jscript/embed.js"></script>
<script type="text/javascript">
    WTVDVS.render_iframe({l}
        "id" : "dvs_wrapper",
        "width" : 952,
        "height" : 1000,
        "iframeUrl" : "{$surl}iframe/"
    {r});
</script>

2. Add link to Virtual Test Drive page under the New and Used navigation menu.

*** If dealer site is on Performance / Flex Site platform perform Step 3a ***

3a. To add the Virtual Test Drive button to the New & Used VDP and SRP templates, use the Logo Framework section:

Logo: find the attached logo/button image.
Link: {$url."inventory-player/id_".$tdvs."/vin_#Vin"}
Target behavior: open new window (pop-up)

*** If dealer site is on Legacy Site platform, perform steps 3b-3d instead ***

3b. Add this javascript code as HTML source code before the closing </body> tag of the New and Used SRP and VDP templates:

<script type="text/javascript" src="{$stCorePath}module/dvs/static/jscript/vin.js"></script>
<script type="text/javascript">
    WTVVIN.init({l}
        "dvs" : {$aDvs.dvs_id},
        "apiUrl" : "{$apiURL}",
        "styleUrl" : "{$styleURL}",
        "scriptUrl" : "{$scriptURL}"
    {r});
</script>

3c. Add this HTML code for every vehicle listing on the New and Used SRP template (below the thumbnail image of the vehicle):

<div class="dvs_vin_btn" vin="%VIN%"></div>

3d. Add this HTML code for every vehicle listing on the New and Used VDP template (below the thumbnail image of the vehicle):

<div class="dvs_vin_btn" vin="%VIN%"></div> 
