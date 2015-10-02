<div id="chart-menu">
    <div class="chart-menu-item">
        {if $sTab != 'overall'}<a class="chart-menu-item" href="{url link='dvs.analytics' id=$aDvs.dvs_id tab='overall' day=30}">{/if}Overall Stats{if $sTab != 'overall'}</a>{/if}
    </div>
    <div class="chart-menu-item">
        {if $sTab != 'video'}<a class="chart-menu-item" href="{url link='dvs.analytics' id=$aDvs.dvs_id tab='video' day=30}">{/if}Videos Stats{if $sTab != 'video'}</a>{/if}
    </div>
    <div class="chart-menu-item">
        {if $sTab != 'sharing'}<a class="chart-menu-item" href="{url link='dvs.analytics' id=$aDvs.dvs_id tab='sharing' day=30}">{/if}Sharing Stats{if $sTab != 'sharing'}</a>{/if}
    </div>
    <div class="clear"></div>
</div>

<div id="chart-header">
    <div id="date-selector-container">
        <span class="DVSDateLabel">Date Range:</span>
        <select class="DVSDateSelector" onchange="reloadChartPage($(this).val());">
            <option value="7"{if $iDays==7} selected="selected"{/if}>Past 7 Days</option>
            <option value="30"{if $iDays==30} selected="selected"{/if}>Past 30 Days</option>
            <option value="90"{if $iDays==90} selected="selected"{/if}>Past 90 Days</option>
        </select>
    </div>

    <div id="chart-export">
        <span>Export: </span>
        <a id="chart-export-csv" href="#" onclick="exportCSV(); return false;">CSV</a>
        <a id="chart-export-pdf" href="#" onclick="exportAllChart(); return false;">PDF</a>
    </div>
    <div class="clear"></div>
</div>


{if $sTab == 'overall'}
    {module name='dvs.analytics.overall'}
{/if}

{if $sTab == 'video'}
    {module name='dvs.analytics.video'}
{/if}

{if $sTab == 'sharing'}
    {module name='dvs.analytics.sharing'}
{/if}

<iframe id="download_iframe" width="1" height="1" src="#"></iframe>

{$sGlobalJavascript}
{literal}
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    function reloadChartPage(iDay) {
        var sNewPath = sFullPath.replace('tempdays', iDay);
        window.location.href = sNewPath;
    }
</script>
{/literal}
