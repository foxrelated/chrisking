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

3. Add this javascript code as HTML source code before the closing </body> tag of the New and Used SRP and VDP templates:

<script type="text/javascript" src="{$stCorePath}module/dvs/static/jscript/vin.js"></script>
<script type="text/javascript">
    WTVVIN.init({l}
        "dvs" : {$aDvs.dvs_id},
        "apiUrl" : "{$apiURL}",
        "styleUrl" : "{$styleURL}",
        "scriptUrl" : "{$scriptURL}"
    {r});
</script>

4. Add this HTML code for every vehicle listing on the New and Used SRP template (above or below the View Details button) and replace # with the VIN:

<div class="dvs_vin_btn" vin="#"></div>

5. Add this HTML code for every vehicle listing on the New and Used VDP template (below the Window Sticker button or below the video images) and replace # with the VIN:

<div class="dvs_vin_btn" vin="#"></div> 