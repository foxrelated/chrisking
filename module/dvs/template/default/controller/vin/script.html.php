{foreach from=$aRows key=sKey item=aRow}
    var element = document.getElementById('dvs_vin_btn_{$sKey}');
    var urlElement = element.childNodes[0];
    var loadingElement = element.childNodes[1];
    {if $aRow.url}
    urlElement.innerHTML = '{$sButtonText}';
    urlElement.setAttribute('href', '{$aRow.url}');
    urlElement.style.display = 'block';
    {/if}
    loadingElement.style.display = 'none';
{/foreach}