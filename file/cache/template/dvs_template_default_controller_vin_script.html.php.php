<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:05 pm */ ?>
<?php if (count((array)$this->_aVars['aRows'])):  foreach ((array) $this->_aVars['aRows'] as $this->_aVars['sKey'] => $this->_aVars['aRow']): ?>
    var element = document.getElementById('dvs_vin_btn_<?php echo $this->_aVars['sKey']; ?>');
    var urlElement = element.childNodes[0];
    var loadingElement = element.childNodes[1];
<?php if ($this->_aVars['aRow']['url']): ?>
    urlElement.innerHTML = '<?php echo $this->_aVars['sButtonText']; ?>';
    urlElement.setAttribute('href', '<?php echo $this->_aVars['aRow']['url']; ?>');
    urlElement.style.display = 'block';
<?php endif; ?>
    loadingElement.style.display = 'none';
<?php endforeach; endif; ?>
