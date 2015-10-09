<canvas id="circle-stats-canvas" width="980" height="200"></canvas>

<div id="table-chart-wrapper">
    <div id="table-chart-left">
        <h3>Most Watched Videos</h3>
        <div id="top-video-table"></div>
    </div>

    <div id="table-chart-right">
        <h3>Most Clicked Chapters</h3>
        <div id="top-chapter-table"></div>
    </div>
    <div class="clear"></div>
</div>

{if !empty($sJavascript)}{$sJavascript}{/if}