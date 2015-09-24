<canvas id="circle-stats-canvas" width="980" height="200"></canvas>

<div id="main-session-wrapper">
    <div id="session-line-chart"></div>
</div>

<div id="mini-chart-wrapper">
    <div id="mini-chart-left">
        <div id="mini-chart-session" class="mini-chart">
            <div id="mini-chart-session-total" class="mini-chart-total" style="display: none;">{$iSessionTotal}</div>
            <div id="mini-chart-session-content"></div>
        </div>
        <div id="mini-chart-user" class="mini-chart">
            <div id="mini-chart-user-total" class="mini-chart-total" style="display: none;">{$iUserTotal}</div>
            <div id="mini-chart-user-content"></div>
        </div>
        <div id="mini-chart-pageview" class="mini-chart">
            <div id="mini-chart-pageview-total" class="mini-chart-total" style="display: none;">{$iPageViewTotal}</div>
            <div id="mini-chart-pageview-content"></div>
        </div>
        <div class="clear"></div>

        <div id="mini-chart-pagepersession" class="mini-chart">
            <div id="mini-chart-pagepersession-total" class="mini-chart-total" style="display: none;">{$iPagePerSessionTotal}</div>
            <div id="mini-chart-pagepersession-content"></div>
        </div>
        <div id="mini-chart-avgtimepage" class="mini-chart">
            <div id="mini-chart-avgtimepage-total" class="mini-chart-total" style="display: none;">{$iAvgTimePageTotal}</div>
            <div id="mini-chart-avgtimepage-content"></div>
        </div>
        <div id="mini-chart-bouncerate" class="mini-chart">
            <div id="mini-chart-bouncerate-total" class="mini-chart-total" style="display: none;">{$iBounceRateTotal}%</div>
            <div id="mini-chart-bouncerate-content"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="mini-chart-right">
        <div id="new-visitor-chart"></div>
    </div>
    <div class="clear"></div>
</div>

<div id="table-chart">
    <h3>Sessions by City</h3>
    <div id="session-city-chart"></div>
</div>

{if !empty($sJavascript)}{$sJavascript}{/if}