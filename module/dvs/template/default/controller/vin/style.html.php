.dvs_vin_btn a,
.dvs_vin_btn a:hover {l}
    display: block;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    height: 36px;
    max-width:300px;
    line-height: 36px;
    color: #FFFFFF;
    font-size: {$aStyle.vin_font_size};
    background: {$aStyle.vin_top_gradient}; /* Old browsers */
    background: -moz-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%, {$aStyle.vin_bottom_gradient} 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$aStyle.vin_top_gradient}), color-stop(100%,{$aStyle.vin_bottom_gradient})); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* IE10+ */
    background: linear-gradient(to bottom,  {$aStyle.vin_top_gradient} 0%,{$aStyle.vin_bottom_gradient} 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$aStyle.vin_top_gradient}', endColorstr='{$aStyle.vin_bottom_gradient}',GradientType=0 ); /* IE6-9 */
{r}

.dvs_vin_loading {l}
    background: url('{$aStyle.loading_image}') scroll no-repeat top left transparent;
    display: block;
    width: 16px;
    height: 11px;
{r}

#dvs_vin_popup_wrapper {l}
    display: none;
    background: url("{$sPopupBg}") repeat scroll 0 0 transparent;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 99;
{r}

#dvs_vin_popup {l}
    background: #FFFFFF;
    display: block;
    width: 900px;
    position: absolute;
    left: 50%;
    margin-left: -465px;
    height: 585px;
    top: 50%;
    margin-top: -305px;
    padding: 15px;
    border-radius: 10px;
{r}

#dvs_vin_popup_content {l}
    display: block;
    width: 900px;
    height: 565px;
{r}

#dvs_vin_close_btn {l}
    color: #000000;
    text-align: right;
{r}