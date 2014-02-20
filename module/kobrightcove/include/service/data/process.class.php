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
class Kobrightcove_Service_Data_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tVideos = Phpfox::getT('ko_brightcove');
	}


	/**
	 * Store a video in the DB
	 * 
	 * @param type $aBcVideo
	 * @return type
	 */
	public function add($aBcVideo)
	{
		// DB escape
		$this->escapeAll($aBcVideo);

		$sTitleUrl = $this->preParse()->prepareTitle('kobrightcove', $aBcVideo['name'], 'video_title_url', null, $this->_tVideos);

		// Download images
		$sThumbnailImage = Phpfox::getService('kobrightcove.image')->download($aBcVideo['thumbnailURL'], $sTitleUrl . '_thumb');
		$sVideoStillImage = Phpfox::getService('kobrightcove.image')->download($aBcVideo['videoStillURL'], $sTitleUrl . '_still');

		// Add to database
		$iKoId = $this->database()->insert($this->_tVideos, array(
			'id' => $aBcVideo['id'],
			'name' => $aBcVideo['name'],
			'adKeys' => $aBcVideo['adKeys'],
			'shortDescription' => $aBcVideo['shortDescription'],
			'longDescription' => $aBcVideo['longDescription'],
			'creationDate' => $aBcVideo['creationDate'],
			'publishedDate' => $aBcVideo['publishedDate'],
			'lastModifiedDate' => $aBcVideo['lastModifiedDate'],
			'linkURL' => $aBcVideo['linkURL'],
			'linkText' => $aBcVideo['linkText'],
			'tags' => implode(',', $aBcVideo['tags']),
			'videoStillURL' => $aBcVideo['videoStillURL'],
			'thumbnailURL' => $aBcVideo['thumbnailURL'],
			'referenceId' => $aBcVideo['referenceId'],
			'length' => $aBcVideo['length'],
			'economics' => $aBcVideo['economics'],
			'playsTotal' => $aBcVideo['playsTotal'],
			'playsTrailingWeek' => $aBcVideo['playsTrailingWeek'],
			'year' => $aBcVideo['year'],
			'make' => $aBcVideo['make'],
			'model' => $aBcVideo['model'],
			'bodyStyle' => $aBcVideo['bodyStyle'],
			'timestamp' => PHPFOX_TIME,
			'video_title_url' => $sTitleUrl,
			'server_id' => ($sThumbnailImage || $sVideoStillImage ? Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID') : 0),
			'thumbnail_image' => ($sThumbnailImage ? $sThumbnailImage : ''),
			'video_still_image' => ($sVideoStillImage ? $sVideoStillImage : '')
		));

		return $iKoId;
	}


	/**
	 * Updates a video in the BC database and downloads images
	 * 
	 * @param type $aBcVideo
	 * @return boolean
	 */
	public function update($aBcVideo)
	{
		$this->escapeAll($aBcVideo);

		$aCurrentVideo = $this->database()->select('ko_id, thumbnail_image, video_still_image, video_title_url')
			->from($this->_tVideos)
			->where('referenceId LIKE "' . $aBcVideo['referenceId'] . '"')
			->execute('getRow');

		// Video doesn't exist in the DB
		if (empty($aCurrentVideo))
		{
			return false;
		}

		// Remove old images if necessary
		if ($aCurrentVideo['thumbnail_image'])
		{
			Phpfox::getService('kobrightcove.image')->delete($aCurrentVideo['thumbnail_image']);
		}
		if ($aCurrentVideo['video_still_image'])
		{
			Phpfox::getService('kobrightcove.image')->delete($aCurrentVideo['video_still_image']);
		}

		// Download new images
		$sThumbnailImage = Phpfox::getService('kobrightcove.image')->download($aBcVideo['thumbnailURL'], $aCurrentVideo['video_title_url'] . '_thumb');
		$sVideoStillImage = Phpfox::getService('kobrightcove.image')->download($aBcVideo['videoStillURL'], $aCurrentVideo['video_title_url'] . '_still');

		// Update the db
		return $this->database()->update($this->_tVideos, array(
				'id' => $aBcVideo['id'],
				'name' => $aBcVideo['name'],
				'adKeys' => $aBcVideo['adKeys'],
				'shortDescription' => $aBcVideo['shortDescription'],
				'longDescription' => $aBcVideo['longDescription'],
				'creationDate' => $aBcVideo['creationDate'],
				'publishedDate' => $aBcVideo['publishedDate'],
				'lastModifiedDate' => $aBcVideo['lastModifiedDate'],
				'linkURL' => $aBcVideo['linkURL'],
				'linkText' => $aBcVideo['linkText'],
				'tags' => implode(',', $aBcVideo['tags']),
				'videoStillURL' => $aBcVideo['videoStillURL'],
				'thumbnailURL' => $aBcVideo['thumbnailURL'],
				'length' => $aBcVideo['length'],
				'economics' => $aBcVideo['economics'],
				'playsTotal' => $aBcVideo['playsTotal'],
				'playsTrailingWeek' => $aBcVideo['playsTrailingWeek'],
				'year' => $aBcVideo['year'],
				'make' => $aBcVideo['make'],
				'model' => $aBcVideo['model'],
				'bodyStyle' => $aBcVideo['bodyStyle'],
				'timestamp' => PHPFOX_TIME,
				'server_id' => ($sThumbnailImage || $sVideoStillImage ? Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID') : 0),
				'thumbnail_image' => ($sThumbnailImage ? $sThumbnailImage : ''),
				'video_still_image' => ($sVideoStillImage ? $sVideoStillImage : '')
				), 'ko_id = ' . (int) $aCurrentVideo['ko_id']);
	}


	public function remove($iID)
	{
		$this->database()->delete($this->_tVideos, 'ko_id = "' . $iID . '"');
		return true;
	}


	public function escapeAll(&$aArray)
	{
		array_walk_recursive($aArray, function(&$mValue) {
				$mValue = Phpfox::getLib('database')->escape($mValue);
			});
	}


}

?>