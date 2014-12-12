{foreach from=$aRows key=sKey item=aRow}
    var element = document.getElementById('dvs_vin_btn_{$sKey}');
    var urlElement = element.childNodes[0];
    var loadingElement = element.childNodes[1];
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
    loadingElement.style.display = 'none';
{/foreach}