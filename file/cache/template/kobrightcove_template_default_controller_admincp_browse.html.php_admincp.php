<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 23, 2014, 12:16 am */ ?>
<?php
/**
* [PHPFOX_HEADER]
*/

defined('PHPFOX') or exit('GO MICE!');

/**
*
*
* @copyright	Konsort.org
* @author  		Konsort.org
* @package 		KOBrightcove
*/
?>
<div id="video_list">
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
		<table>
		<th>ID</th>
		<th>Name</th>
		<th>Year</th>
		<th>Make</th>
		<th>Model</th>
		<th>Body Style</th>
		<th>Short Description</th>
		<th>Long Description</th>
		<th>Creation Date</th>
		<th>Tags</th>
		<th>Video Still</th>
		<th>Reference ID</th>
		<th>Year</th>
		<th>Make</th>
		<th>Model</th>
		<th>Bodystyle</th>
<?php if (count((array)$this->_aVars['aVideos'])):  foreach ((array) $this->_aVars['aVideos'] as $this->_aVars['key'] => $this->_aVars['aValue']): ?>
		<tr>
			<td><?php echo $this->_aVars['aValue']['ko_id']; ?></td>
			<td><?php echo $this->_aVars['aValue']['name']; ?></td>
			<td><?php echo $this->_aVars['aValue']['year']; ?></td>
			<td><?php echo $this->_aVars['aValue']['make']; ?></td>
			<td><?php echo $this->_aVars['aValue']['model']; ?></td>
			<td><?php echo $this->_aVars['aValue']['bodyStyle']; ?></td>
			<td><?php echo $this->_aVars['aValue']['shortDescription']; ?></td>
			<td><?php echo $this->_aVars['aValue']['longDescription']; ?></td>
			<td><?php echo $this->_aVars['aValue']['creationDate']; ?></td>
			<td><?php echo $this->_aVars['aValue']['tags']; ?></td>
			<td><a href="<?php echo $this->_aVars['aValue']['videoStillURL']; ?>"><img src="<?php echo $this->_aVars['aValue']['thumbnailURL']; ?>" border=0></a></td>	
			<td><?php echo $this->_aVars['aValue']['referenceId']; ?></td>
			<td><?php echo $this->_aVars['aValue']['year']; ?></td>
			<td><?php echo $this->_aVars['aValue']['make']; ?></td>
			<td><?php echo $this->_aVars['aValue']['model']; ?></td>
			<td><?php echo $this->_aVars['aValue']['bodyStyle']; ?></td>
		</tr>
<?php endforeach; endif; ?>
	</table>
</div>

