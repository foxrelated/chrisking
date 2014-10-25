<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:37 pm */ ?>
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
<div id="dvs_share_wrapper">
    <section id="select_new">
<?php if ($this->_aVars['aVideoSelectYears']): ?>
		<table width="650">
		<tr>
		<td style="vertical-align:bottom;padding-right:10px;"><h1 style="font-size:14px;font-weight:bold;">Filter Videos:</h1></td>
        
<?php if (isset ( $this->_aVars['aVideoSelectYears']['1'] )): ?>
        <td style="vertical-align:top;">
        <ul id="year">
            <li class="init"><span class="init_selected"><?php if (isset ( $this->_aVars['iYear'] ) && ( $this->_aVars['iYear'] > 0 )):  echo $this->_aVars['iYear'];  else: ?>Select Year<?php endif; ?></span>
                <ul>
<?php if (count((array)$this->_aVars['aVideoSelectYears'])):  foreach ((array) $this->_aVars['aVideoSelectYears'] as $this->_aVars['iYear']): ?>
                    <li onclick="$.ajaxCall('dvs.getShareMakes', 'iYear=<?php echo $this->_aVars['iYear']; ?>&amp;sDvsName=<?php echo $this->_aVars['aDvs']['title_url']; ?>');">
<?php echo $this->_aVars['iYear']; ?>
                    </li>
<?php endforeach; endif; ?>
                </ul>
            </li>
        </ul>
        </td>
<?php endif; ?>
		<td style="vertical-align:top;">
        <ul id="makes">
            <li class="init">
<?php if (isset ( $this->_aVars['sMake'] ) && $this->_aVars['sMake']): ?><span class="init_selected"><?php echo $this->_aVars['sMake']; ?></span><?php else:  echo Phpfox::getPhrase('dvs.select_make');  endif; ?>
                <ul>
<?php if (isset ( $this->_aVars['aMakes'] ) && count ( $this->_aVars['aMakes'] )): ?>
<?php if (count((array)$this->_aVars['aMakes'])):  foreach ((array) $this->_aVars['aMakes'] as $this->_aVars['aMake']): ?>
                    <li onclick="$.ajaxCall('dvs.getShareModels', 'sDvsName=<?php echo $this->_aVars['aDvs']['title_url']; ?>&amp;iYear=<?php echo $this->_aVars['iYear']; ?>&amp;sMake=<?php echo $this->_aVars['aMake']['make']; ?>');"><?php echo $this->_aVars['aMake']['make']; ?></li>
<?php endforeach; endif; ?>
<?php else: ?>
                    <li>
<?php echo Phpfox::getPhrase('dvs.please_select_a_year_first'); ?>
                    </li>
<?php endif; ?>
                </ul>
            </li>
        </ul>
        </td>
        </tr>
        </table>
<?php endif; ?>
        <div class="clear"></div>
    </section>
<br>

	<div id="dvs_share_container">
		<input class="dvs_share_text_box" type="hidden" id="share_link_box">

<?php $this->assign('baseUrl', ''); ?>
<?php if ($this->_aVars['baseUrl'] = Phpfox ::getParam('core.path')):  endif; ?>
		<script type="text/javascript" src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/jscript/clipboard/ZeroClipboard.js"></script>

        <div id="video_items">
<?php Phpfox::getBlock('dvs.share-video', array('aShareVideos' => $this->_aVars['aDvsVideos'],'aDvs' => $this->_aVars['aDvs'])); ?>
        </div>
	</div>
</div>
