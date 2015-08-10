var vinLoopCount = 0;
var vinInterval = setInterval(function(){l}
    vinLoopCount++;
var elements = [];
    {foreach from=$aRows key=sKey item=aRow}
        for (i = 0; i < {$iTotalVin}; i++) {l}
            if(document.getElementById("dvs_vin_btn_{$sKey}_"+i) != null){l}
                elements.push(document.getElementById("dvs_vin_btn_{$sKey}_"+i));
            {r}
        {r}
    {/foreach}
if(elements != null && elements.length > 0) {l}
    for(var k = 0; k < elements.length; k++) {l}
        if(elements[k] != null) {l}
        clearInterval(vinInterval);

        for(var i=0; i < elements[k].childNodes.length; i++) {l}
        if(elements[k].childNodes[i].tagName == "DIV") {l}
        var loadingElement = elements[k].childNodes[i];
        {r}

        if(elements[k].childNodes[i].tagName == "A") {l}
        var urlElement = elements[k].childNodes[i];
        {r}
        {r}
{foreach from=$aRows key=sKey item=aRow}
if('{$sKey}' == elements[k].getAttribute("vin")) {l}
            {if $aRow.url}
            {if isset($vdp_background)}
            urlElement.innerHTML = '<img src="{$vdp_background}" alt="{$sButtonText}" title="{$sButtonText}" />';
            urlElement.style.display = 'inline-block';
            {else}
            urlElement.style.display = 'block';
            urlElement.innerHTML = '{$sButtonText}';
            {/if}

            {if $aDvs.vpd_popup}
            if(urlElement.addEventListener) {l}
            urlElement.addEventListener('click', function(evt) {l}
            evt.preventDefault();
            WTVVIN.show_popup('{$aRow.url}'); return false;
            {r}, false);
            {r} else {l}
            urlElement.attachEvent('onclick', function() {l}
            WTVVIN.show_popup('{$aRow.url}');
            window.event.returnValue = false;
            return false;
            {r});
            {r}
            {else}
            urlElement.setAttribute('href', '{$aRow.url}');
            {/if}
            {/if}
{r}
{/foreach}

        loadingElement.style.display = 'none';
        {r}
    {r}
{r}

    if(vinLoopCount >= 10) {l}
        clearInterval(vinInterval);
    {r}
{r}, 2000);