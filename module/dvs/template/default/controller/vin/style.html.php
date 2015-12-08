.dvs_vin_btn a,
.dvs_vin_btn a:hover {l}
    {if isset($aStyle.vdp_background)}
        display: inline-block;
    {else}
        display: block;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        height: 36px;
        width:100%;
        max-width:300px;
        line-height: 36px;
        color: {$aStyle.vin_text_color};
        font-size: {$aStyle.vin_font_size};
        background: {$aStyle.vin_top_gradient}; /* Old browsers */
        background: -moz-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%, {$aStyle.vin_bottom_gradient} 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$aStyle.vin_top_gradient}), color-stop(100%,{$aStyle.vin_bottom_gradient})); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* IE10+ */
        background: linear-gradient(to bottom,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$aStyle.vin_top_gradient}', endColorstr='{$aStyle.vin_bottom_gradient}',GradientType=0 ); /* IE6-9 */
    {/if}
{r}

.dvs_vin_loading {l}
    background: url('{$aStyle.loading_image}') no-repeat scroll top left transparent;
    display: block;
    width: 16px;
    height: 11px;
{r}

#dvs_vin_layout_wrapper {l}
    opacity: 0;
    display: none;
    background: url("{$sPopupBg}") repeat scroll 0 0 transparent;
    height: 100%;
    left: 0;
    position: fixed;
    _position:absolute;
    top: 0;
    _top:expression(eval(document.body.scrollTop));
    width: 102%;
    z-index: 10000;
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity = 80);
{r}

#dvs_vin_popup_wrapper {l}
    opacity: 0;
    display: none;
    height: {if $sBrowser == 'mobile'}{$iPopupHeight}px{else}500px{/if};
    left: 0;
    position: fixed;
    _position:absolute;
    top: 0;
    _top:expression(eval(document.body.scrollTop));
    width: 102%;
    z-index: 10001;
{r}

#dvs_vin_popup {l}
    display: block;
    width: 90%;
    max-width:930px;
    position: relative;
    margin: 0 auto;
    height: 100%;
    /*max-height:{if $sBrowser == 'mobile'}{$iPopupHeight}px{else}500px{/if};*/
    box-shadow: 0 0 10px #222222;
    border-radius: 10px;
    z-index:10002;
    top: 33%;
{r}

#dvs_vin_popup_content {l}
    display: block;
    width: 100%;
    max-width:930px;
    height: 100%;
    max-height:{if $sBrowser == 'mobile'}{$iPopupHeight}px{else}500px{/if};
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    z-index:10001;

{r}

#dvs_vin_close_btn {l}
    background: url("{$aStyle.close_btn}") no-repeat scroll left top transparent;
    cursor: pointer;
    display: block;
    font-size: 0;
    height: 22px;
    position: absolute;
    right: -9px;
    top: -10px;
    width: 22px;
    z-index: 10002;
{r}