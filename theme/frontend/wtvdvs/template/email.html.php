{if $bHtml}	
{if $bMessageHeader}
	{if isset($sMessageHello)}
	{$sMessageHello}
	{else}
	{phrase var='core.hello'}
	{/if},
	<br />
	<br />
{/if}
	{$sMessage}
	<br />
	<br />
	{$sEmailSig}	
{else}	
{if $bMessageHeader}
	{if isset($sMessageHello)}
	{$sMessageHello}
	{else}
	{phrase var='core.hello'}
	{/if},
{/if}	
	{$sMessage}

	{$sEmailSig}	
{/if}