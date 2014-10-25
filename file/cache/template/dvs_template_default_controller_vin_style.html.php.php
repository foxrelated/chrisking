<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:05 pm */ ?>
.dvs_vin_btn a,
.dvs_vin_btn a:hover {
    display: block;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    height: 36px;
    max-width:300px;
    line-height: 36px;
    color: #FFFFFF;
    font-size: <?php echo $this->_aVars['aStyle']['vin_font_size']; ?>;
    background: <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?>; /* Old browsers */
    background: -moz-linear-gradient(top,  <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?> 0%, <?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?> 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?>), color-stop(100%,<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?>)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?> 0%,<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?> 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?> 0%,<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?> 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?> 0%,<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?> 100%); /* IE10+ */
    background: linear-gradient(to bottom,  <?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?> 0%,<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?> 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $this->_aVars['aStyle']['vin_top_gradient']; ?>', endColorstr='<?php echo $this->_aVars['aStyle']['vin_bottom_gradient']; ?>',GradientType=0 ); /* IE6-9 */
}

.dvs_vin_loading {
    background: url('<?php echo $this->_aVars['aStyle']['loading_image']; ?>') scroll no-repeat top left transparent;
    display: block;
    width: 16px;
    height: 11px;
}
