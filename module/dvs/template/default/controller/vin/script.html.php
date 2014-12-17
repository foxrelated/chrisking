var vinLoopCount = 0;
var vinInterval = setInterval(function(){l}
	vinLoopCount++;
	
	{foreach from=$aRows key=sKey item=aRow}
	    var element = document.getElementById('dvs_vin_btn_{$sKey}');
		if(element != null) {l}
			clearInterval(vinInterval);
		
		    for(var i=0; i < element.childNodes.length; i++) {l}
		        if(element.childNodes[i].tagName == "DIV") {l}
		            var loadingElement = element.childNodes[i];
		        {r}
		        if(element.childNodes[i].tagName == "A") {l}
		            var urlElement = element.childNodes[i];
		        {r}
		    {r}
		
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
		{r}
	{/foreach}
	
	if(vinLoopCount >= 10) {l}
		clearInterval(vinInterval);
	{r}
{r}, 2000);