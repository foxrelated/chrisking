<input type="hidden" id="completed_total_value" value="{$iCompleted}">
<div>
    <span id="build_ajax_processing" style="display: none;">{img theme='ajax/add.gif'}</span>
</div>

<div class="extra_info">
    <p>Current Item: <span id="current_item">#</span></p>
    <p>Total: <span id="completed_total">{$iCompleted}</span>/<span id="item_total">{$iTotal}</span></p>
</div>
<div class="table_clear">
    <input id="start_btn" type="button" class="button" value="Start" onclick="iReady = 1; $('#start_btn').hide(); $('#stop_btn').show();">
    <input style="display: none;" id="stop_btn" type="button" class="button" value="Stop" onclick="iReady = 0; $('#start_btn').show(); $('#stop_btn').hide();">
</div>


{literal}
<style type="text/css">
    .extra_info p {
        font-size: 15px;
        font-weight: bold;
        line-height: 20px;
        padding-bottom: 10px;
    }
</style>

<script type="text/javascript">
    var iReady = 0;
    var iContinue = 1;

    setInterval(function() {
        if(iReady && iContinue) {
            iContinue = 0;
            $('#build_ajax_processing').show();
            $.ajaxCall('imagesize.buildNextEmailItem');
        }
    }, 1000);
</script>
{/literal}