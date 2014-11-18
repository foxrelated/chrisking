{foreach from=$aRows key=sKey item=aRow}
    var element = document.getElementById('dvs_vin_btn_{$sKey}');
    var urlElement = element.childNodes[0];
    var loadingElement = element.childNodes[1];
    {if $aRow.url}
    urlElement.innerHTML = '{$sButtonText}';
    urlElement.setAttribute('href', '{$aRow.url}');
    urlElement.style.display = 'block';
    urlElement.setAttribute('href', '{$aRow.url}');
    {if !$aDvs.vpd_popup}
    urlElement.setAttribute('onClick', 'return true;');
    {/if}
    {/if}
    loadingElement.style.display = 'none';
{/foreach}