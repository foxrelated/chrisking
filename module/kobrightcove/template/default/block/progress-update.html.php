<script type="text/javascript">
	autoUpdate({$iOffset});

	{literal}
		$('#progress_inner').stop().animate({
			width: '{/literal}{$iPercentage}{literal}%'
		}, 300, function() {});
	{/literal}
	$("#progress_percentage").html("{$iPercentage}%");
	$("#progress_stopped").html("<a href=\"#\" onclick=\"restart({$iOffset});\">Restart</a>");
	

</script>
{$iOffset} of {$iTotal}. Batch completed in {$iTime} seconds.