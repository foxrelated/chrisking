<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:31 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		Konsort.org
 * @package 		DVS
 */

?>

<style type="text/css">
  .js_box_content { padding: 0; }
</style>
<iframe src="<?php echo $this->_aVars['sIframeUrl']; ?>" width="<?php if ($this->_aVars['aVals']['player_type']): ?>620<?php else: ?>900<?php endif; ?>" height="<?php if ($this->_aVars['aVals']['player_type']): ?>360<?php else: ?>600<?php endif; ?>"/>
