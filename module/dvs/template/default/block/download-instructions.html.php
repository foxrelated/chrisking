1. Create a new page called Virtual Test Drive and add this javascript code as HTML source code (not as an iframe widget):
<div id="dvs_wrapper"></div>
<script type="text/javascript" src="{$sCorePath}module/dvs/static/jscript/embed.js"></script>
<script type="text/javascript">
    WTVDVS.render_iframe({l}
        "id" : "dvs_wrapper",
        "width" : 952,
        "height" : 1000,
        "iframeUrl" : "{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}iframe/"
    {r});
</script>
2. Add link to Virtual Test Drive page under the New and Used navigation menu.

3. Add this javascript code as HTML source code before the closing </body> tag of the New and Used SRP and VDP templates:

<script type="text/javascript" src="{$sCorePath}module/dvs/static/jscript/vin.js"></script>
<script type="text/javascript">
    WTVVIN.init({l}
        "dvs" : {$aDvs.dvs_id},
        "apiUrl" : "{url link=''}",
        "styleUrl" : "{url link='dvs.vin.style' id=$aDvs.dvs_id}",
        "scriptUrl" : "{url link='dvs.vin.script' id=$aDvs.dvs_id}"
    {r});
</script>

4. Add this HTML code for every vehicle listing on the New and Used SRP template (above or below the View Details button) and replace # with the VIN:

<div class="dvs_vin_btn" vin="#"></div>

5. Add this HTML code for every vehicle listing on the New and Used VDP template (below the Window Sticker button or below the video images) and replace # with the VIN:

<div class="dvs_vin_btn" vin="#"></div> 