{if $bIsUser}
{literal}
<script type="text/javascript">
mixpanel.track("DVS Page View", {
	{/literal}
    "name": "{$aUser.full_name}",
    "type": "User",
    "time_stamp": "{$iTime|date:'core.extended_global_time_stamp'}",
    "dealer name": "{$aDvs.dealer_name}"
});
</script>
{else}
{literal}
<script type="text/javascript">
mixpanel.track("DVS Page View", {
	{/literal}
   	"ip": "{$aUser.ip}",
    "type": "Anonymously",
    "time_stamp": "{$iTime|date:'core.extended_global_time_stamp'}",
    "dealer name": "{$aDvs.dealer_name}"
});
</script>
{/if}
