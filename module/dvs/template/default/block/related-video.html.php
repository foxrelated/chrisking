{foreach from=$aFooterLinks key=iKey item=aVideo name=videos}
<li>
<a href="{if isset($aVideo.parent_video_url)}{$aVideo.parent_video_url}{else}{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}{$aVideo.video_title_url}{/if}" onclick="menuFooter('Footer Link Clicks');" target="_parent">
    {$aVideo.year} {$aVideo.make} {$aVideo.model}
</a>
</li>
{/foreach}