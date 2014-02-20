<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('DRINK SLICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		Research
 */
class Research_Service_Research extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_brightcove');
	}


	public function searchVideos($iPage, $iPageSize, $sText = '', $sType = 'all')
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$sText = $this->preParse()->clean($sText);
		$sType = $this->preParse()->clean($sType);

		$aVideos = array();
		$i = 0;
		$aTerms = explode(' ', $sText);
		$sWhere = '';

		foreach ($aTerms as $sTerm)
		{
			$sWhere .= '(tags LIKE "%' . $sTerm . '%" OR make LIKE "%' . $sTerm . '%" OR model LIKE "%' . $sTerm . '%" OR bodyStyle LIKE "%' . $sTerm . '%")';
			$i++;
			if ($i < count($aTerms)) $sWhere .= ' AND ';
		}
		$iCnt = $this->database()->select('COUNT(*)')
				->from($this->_sTable)
				->where($sWhere)
				->execute('getField');

		$aVideos = $this->database()
				->select('*')
				->from($this->_sTable)
				->where($sWhere)
				->limit($iPage, $iPageSize, $iCnt)
				->execute('getRows');

		$aVideos = $this->convertBcTimestamp($aVideos);

		$aVideos = $this->trimShortDesc($aVideos, Phpfox::getParam('research.character_max_before_trim'));

		return array($aVideos, $iCnt);
	}


	public function searchVideosByFields($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = 'all', $iPage = 0, $iPageSize = 0)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		if ($sMake == 'undefined') $sMake = '';
		if ($sModel == 'undefined') $sModel = '';

		$aVideos = array();

		if ($iPageSize)
		{
			$iCnt = $this->database()->select('COUNT(*)')
					->from($this->_sTable)
					->where('tags LIKE "%' . $sYear . '%" AND make LIKE "%' . $sMake . '%" AND model LIKE "%' . $sModel . '%" AND bodyStyle LIKE "%' . $sBodyStyle . '%"')
					->execute('getField');

			$this->database()->limit($iPage, $iPageSize, $iCnt);
		}

		$aVideos = $this->database()
				->select('*')
				->from($this->_sTable)
				->where('tags LIKE "%' . $sYear . '%" AND make LIKE "%' . $sMake . '%" AND model LIKE "%' . $sModel . '%" AND bodyStyle LIKE "%' . $sBodyStyle . '%"')
				->execute('getRows');

		$aVideos = $this->convertBcTimestamp($aVideos);

		$aVideos = $this->trimShortDesc($aVideos, Phpfox::getParam('research.character_max_before_trim'));

		if ($iPageSize)
		{
			return array($aVideos, $iCnt);
		}
		else
		{
			return $aVideos;
		}
	}


	public function createPlaylist($aVideos)
	{

//		$aVideos = $this->sortVideosByType($aVideos, $sType);

		$sVideoIds = '';

		foreach ($aVideos as $iKey => $aValue)
		{
			$sVideoIds .= $aValue['id'] . ', ';
		}

		return $sVideoIds;
	}


	public function sortVideosByType($aVideos, $sType)
	{
		$aVideosTemp = array();
		if ($sType == 'new')
		{
			$aVideosTemp = $this->buildArrayByRefId($aVideos, '1onONE', $aVideosTemp);
			$aVideosTemp = $this->buildArrayByRefId($aVideos, 'Top200', $aVideosTemp);
			$aVideosTemp = $this->buildArrayByRefId($aVideos, 'POV', $aVideosTemp);

			return $aVideosTemp;
		}
		elseif ($sType == 'used')
		{
			$aVideosTemp = $this->buildArrayByRefId($aVideos, 'POV', $aVideosTemp);
			$aVideosTemp = $this->buildArrayByRefId($aVideos, 'Top200', $aVideosTemp);
			$aVideosTemp = $this->buildArrayByRefId($aVideos, '1onONE', $aVideosTemp);

			return $aVideosTemp;
		}
		else
		{
			return $aVideos;
		}
	}


	public function buildArrayByRefId($aVideos, $sSort, $aResults)
	{
		foreach ($aVideos as $iKey => $aValue)
		{
			if (strpos($aValue['referenceId'], $sSort) === 0)
			{
				array_push($aResults, $aValue);
			}
		}

		return $aResults;
	}


	public function convertBcTimestamp($aVideosTemp)
	{
		$aVideos = array();

		foreach ($aVideosTemp as $key => $aValue)
		{
			$aValue['creationDate'] = date('m/d/Y H:i:s', substr($aValue['creationDate'], 0, -3));
			$aValue['publishedDate'] = date('m/d/Y H:i:s', substr($aValue['publishedDate'], 0, -3));
			$aValue['lastModifiedDate'] = date('m/d/Y H:i:s', substr($aValue['lastModifiedDate'], 0, -3));
			$aVideos[$key] = $aValue;
		}

		return $aVideos;
	}


	public function getVideoByRefId($sRefId)
	{
		$sRefId = $this->preParse()->clean($sRefId);

		return $this->database()
						->select('*')
						->from($this->_sTable)
						->where('referenceId = "' . $sRefId . '"')
						->execute('getRow');
	}


	public function getVideoTitleUrl($sTitleUrl)
	{
		$sTitleUrl = $this->preParse()->clean($sTitleUrl);

		return $this->database()
						->select('*')
						->from($this->_sTable)
						->where('video_title_url = "' . $sTitleUrl . '"')
						->execute('getRow');
	}


	public function getVideoByName($sName)
	{
		$sName = $this->preParse()->clean($sName);

		return $this->database()
						->select('*')
						->from($this->_sTable)
						->where('name = "' . $sName . '"')
						->execute('getRow');
	}


	public function getVideoBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '')
	{
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		if ($sMake == 'undefined') $sMake = '';
		if ($sModel == 'undefined') $sModel = '';

		if ($sModel == 's2000')
		{
			$this->database()->where('tags LIKE "%,' . $sYear . '%" AND make LIKE "%' . $sMake . '%" AND model LIKE "%' . $sModel . '%" AND bodyStyle LIKE "%' . $sBodyStyle . '%"');
		}
		else
		{
			$this->database()->where('tags LIKE "%' . $sYear . '%" AND make LIKE "%' . $sMake . '%" AND model LIKE "%' . $sModel . '%" AND bodyStyle LIKE "%' . $sBodyStyle . '%"');
		}
		$aVideos = $this->database()
				->select('*')
				->from($this->_sTable)
				->execute('getRows');

		$aVideos = $this->sortVideosByType($aVideos, $sType);
		return (isset($aVideos[0]) ? $aVideos[0] : array());
	}


	public function getPopularVideosByName($sName, $aVideo = false)
	{
		if (!$aVideo)
		{
			$aVideo = $this->database()
					->select('year')
					->from($this->_sTable)
					->where('name = "' . $sName . '"')
					->execute('getRow');
		}

		if (strpos(Phpfox::getParam('research.new_model_year'), $aVideo['year']) === false)
		{
			return $this->getPopularVideos('used');
		}
		else
		{
			return $this->getPopularVideos('new');
		}
	}


	public function getPopularVideosBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '')
	{
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		$aVideo = $this->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);
		return $this->getPopularVideosByName(false, $aVideo);
	}


	public function getFeaturedVideosByName($sName, $aVideo = false)
	{
		if (!$aVideo)
		{
			$aVideo = $this->database()
					->select('year')
					->from($this->_sTable)
					->where('name = "' . $sName . '"')
					->execute('getRow');
		}

		if (strpos(Phpfox::getParam('research.new_model_year'), $aVideo['year']) === false)
		{
			return $this->getFeaturedVideos(Phpfox::getParam('research.featured_used_playlist'));
		}
		else
		{
			return $this->getFeaturedVideos(Phpfox::getParam('research.featured_new_playlist'));
		}
	}


	public function getFeaturedVideosBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '')
	{
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		$aVideo = $this->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);
		return $this->getFeaturedVideosByName(false, $aVideo);
	}


	public function getLatestVideosByName($sName, $aVideo = false)
	{
		if (!$aVideo)
		{
			$aVideo = $this->database()
					->select('year')
					->from($this->_sTable)
					->where('name = "' . $sName . '"')
					->execute('getRow');
		}

		if (strpos(Phpfox::getParam('research.new_model_year'), $aVideo['year']) === false)
		{
			return $this->getLatestVideos('used');
		}
		else
		{
			return $this->getLatestVideos('new');
		}
	}


	public function getLatestVideosBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '')
	{
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		$aVideo = $this->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);
		return $this->getLatestVideosByName(false, $aVideo);
	}


	public function getRelatedBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '', $iLimit = 2)
	{
		$aVideo = $this->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);

		return $this->getRelatedByName(false, $aVideo, $iLimit);
	}


	public function getRelatedByName($sName, $aVideo = false, $iLimit = 2)
	{
		$aRelated = array();

		if (!$aVideo)
		{
			$sName = $this->preParse()->clean($sName);
			$aVideo = $this->database()
					->select('year, make, bodyStyle, name, video_title_url')
					->from($this->_sTable)
					->where('name = "' . $sName . '"')
					->execute('getRow');
		}

		if (strpos(Phpfox::getParam('research.new_model_year'), $aVideo['year']) === false)
		{
//Get related for used cars. (reversed) 1onONE, Top200, POV
			$aRelated = array_merge($this->getRelated($aVideo, '1onONE', $iLimit), $aRelated);
			$aRelated = array_merge($this->getRelated($aVideo, 'Top200', $iLimit), $aRelated);
			$aRelated = array_merge($this->getRelated($aVideo, 'POV', $iLimit), $aRelated);
		}
		else
		{
//Get related for new cars. (reversed) POV, 1onONE, Top200
			$aRelated = array_merge($this->getRelated($aVideo, 'POV', $iLimit), $aRelated);
			$aRelated = array_merge($this->getRelated($aVideo, '1onONE', $iLimit), $aRelated);
			$aRelated = array_merge($this->getRelated($aVideo, 'Top200', $iLimit), $aRelated);
		}
		return $aRelated;
	}


	public function uniqueMd($aUnique)
	{
		array_walk($aUnique, create_function('&$value,$key', '$value = json_encode($value);'));
		$aUnique = array_unique($aUnique);
		array_walk($aUnique, create_function('&$value,$key', '$value = json_decode($value, true);'));

		return $aUnique;
	}


	public function getRelated($aVideo, $sType, $iLimit, $bLimitToMake = false, $bLimitToNew = false)
	{
		$aRelated = array();

		$aSearch = array(
			'referenceID LIKE "%' . $sType . '%"',
			'bodyStyle LIKE "%' . $aVideo['bodyStyle'] . '%"',
			'year LIKE "' . $aVideo['year'] . '"',
			'make LIKE "%' . $aVideo['make'] . '%"'
		);

		$aExclude = array(
			'video_title_url LIKE "' . $aVideo['video_title_url'] . '"'
		);

		$iLoops = 0;

		do
		{
			$sConditions = '';

			//build search
			for ($i = 0; $i <= (3 - $iLoops); $i++)
			{
				if ($i > 0) $sConditions .= ' AND ';
				$sConditions .= $aSearch[$i];
			}

			$i = 0;
			$sConditions .= ' AND NOT (';

			foreach ($aExclude as $sExclude)
			{
				if ($i > 0) $sConditions .= ' OR ';
				$sConditions .= $aExclude[$i];
				$i++;
			}

			$sConditions .= ')';

			if ($bLimitToMake)
			{
				$sConditions .= ' AND make = "' . $aVideo['make'] . '"';
			}

			if ($bLimitToNew)
			{
				$aYears = $this->getYears('new');

				$sConditions .= ' AND (';

				foreach ($aYears as $aYear)
				{
					$sConditions .= 'year = ' . $aYear['year'] . ' OR ';
				}

				$sConditions = rtrim($sConditions, ' OR ') . ')';

				$this->database()->order('year DESC');
			}

			$aResults = $this->database()
					->select('*')
					->from($this->_sTable)
					->where($sConditions)
					->limit($iLimit)
					->execute('getRows');

			foreach ($aResults as $aVideo)
			{
				if (count($aRelated) < $iLimit)
				{
					$aRelated[] = $aVideo;
					$aExclude[] = 'video_title_url LIKE "' . $aVideo['video_title_url'] . '"';
				}
				else
				{
					break;
				}
			}

			$iLoops++;
		}
		while (count($aRelated) < $iLimit && $iLoops <= 3);

		return $aRelated;
	}


	public function getPopularVideos($sType)
	{
		$sWhere = $this->buildWhereYears($sType);
		return $this->database()
						->select('*')
						->from($this->_sTable)
						->where('referenceId LIKE "%' . $this->convertBcType($sType) . '%" AND (' . $sWhere . ')')
						->order('playsTrailingWeek DESC')
						->limit(Phpfox::getParam('research.popular_videos'))
						->execute('getRows');
	}


	public function getFeaturedVideos($sPlaylistId)
	{
		$aVideoIds = Phpfox::getService('kobrightcove.koechove')->getPlaylistById($sPlaylistId);
		$i = 0;
		$sWhere = '';

		if (!$aVideoIds) return array();

		foreach ($aVideoIds as $iId)
		{
			$sWhere .= 'id LIKE "' . $iId . '"';
			$i++;
			if ($i < count($aVideoIds)) $sWhere .= ' OR ';
		}

		if ($sWhere)
		{

			return $this->database()
							->select('*')
							->from($this->_sTable)
							->where($sWhere)
							->limit(100)
							->execute('getRows');
		}
		else
		{
			return array();
		}
	}


	public function getLatestVideos($sType)
	{
		$sWhere = $this->buildWhereYears($sType);
		return $this->database()
						->select('*')
						->from($this->_sTable)
						->where('referenceId LIKE "%' . $this->convertBcType($sType) . '%" AND (' . $sWhere . ')')
						->order('lastModifiedDate DESC')
						->limit(6)
						->execute('getRows');
	}


	public function buildWhereYears($sType)
	{
		$aYears = $this->getYears($sType);
		$i = 0;
		$sWhere = '';

		foreach ($aYears as $aYear)
		{
			$sWhere .= 'tags LIKE "%' . $aYear['year'] . '%"';
			$i++;
			if ($i < count($aYears)) $sWhere .= ' OR ';
		}
		return $sWhere;
	}


	public function getYears($sType = 'all')
	{
		$aYears = $this->database()
				->select('year')
				->from($this->_sTable)
				->group('year')
				->order('year DESC')
				->execute('getRows');

		if ($sType == 'used')
		{

			$aExcludeYears = explode(',', Phpfox::getParam('research.used_model_year_exclusion'));

			$i = 0;

			foreach ($aYears as $aYear)
			{
				foreach ($aExcludeYears as $sYear)
				{
					if ($aYear['year'] == $sYear) unset($aYears[$i]);
				}

				$i++;
			}

			return $aYears;
		}
		else if ($sType == 'new')
		{
			$sYears = Phpfox::getParam('research.new_model_year');

			if (strpos($sYears, ',') === false)
			{
				return array('0' => array('year' => $sYears));
			}
			else
			{
				$aYearsTemp = explode(',', $sYears);
				$aYears = array();
				foreach ($aYearsTemp as $iKey => $iValue)
				{
					$aYears[$iKey] = array('year' => $iValue);
				}
				return $aYears;
			}
		}

		return $aYears;
	}


	public function getMakes($iYear)
	{
		$iYear = (int) $iYear;

		return $this->database()
						->select('make')
						->from($this->_sTable)
						->where('tags LIKE "%' . $iYear . '%"')
						->group('make')
						->order('make')
						->execute('getRows');
	}


	public function getModels($iYear, $sMake)
	{
		$iYear = (int) $iYear;
		$sMake = $this->preParse()->clean($sMake);

		return $this->database()
						->select('model')
						->from($this->_sTable)
						->where('tags LIKE "%' . $iYear . '%" AND make = "' . $sMake . '"')
						->group('model')
						->order('model')
						->execute('getRows');
	}


	public function getStyleListByName($sName)
	{
		$sName = $this->preParse()->clean($sName);

		$sRefId = $this->database()->select('referenceId')
				->from(Phpfox::getT('ko_brightcove'))
				->where('name = "' . $sName . '"')
				->execute('getField');

		$aStyleList = array();

//Temp fix for two digit year in Videomap. To be fixed by Chrome.
		$sRefId = str_replace('_2009_', '_09_', $sRefId);
		$sRefId = str_replace('_2008_', '_08_', $sRefId);
		$sRefId = str_replace('_2007_', '_07_', $sRefId);
		$sRefId = str_replace('_2006_', '_06_', $sRefId);
		$sRefId = str_replace('_2005_', '_05_', $sRefId);
		$sRefId = str_replace('_2004_', '_04_', $sRefId);
		$sRefId = str_replace('_2003_', '_03_', $sRefId);
		$sRefId = str_replace('_2002_', '_02_', $sRefId);
		$sRefId = str_replace('_2001_', '_01_', $sRefId);

		$aStyles = $this->database()->select('style_id')
				->from(Phpfox::getT('ko_chrome_videomap'))
				->where('bc_ref_id = "' . $sRefId . '"')
				->execute('getRows');

		foreach ($aStyles as $iKey => $iValue)
		{
			$aStyleList[$iKey] = array('style_id' => $iValue['style_id'], 'cf_style_name' => $this->getCFStyleNameByStyleId($iValue['style_id']));
		}

		if (empty($aStyleList)) $aStyleList[0] = array('style_id' => 0, 'cf_style_name' => 'no data');

		return $aStyleList;
	}


	public function getCFStyleNameByStyleId($iStyleId)
	{
		return $this->database()->select('cf_style_name')
						->from(Phpfox::getT('ko_chrome_data'))
						->where('style_id = "' . $iStyleId . '"')
						->execute('getField');
	}


	public function getStyleListBySearch($sYear = '', $sMake = '', $sModel = '', $sBodyStyle = '', $sType = '')
	{
		$sYear = $this->preParse()->clean($sYear);
		$sMake = $this->preParse()->clean($sMake);
		$sModel = $this->preParse()->clean($sModel);
		$sBodyStyle = $this->preParse()->clean($sBodyStyle);
		$sType = $this->preParse()->clean($sType);

		$aVideo = $this->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);
		return $this->getStyleListByName($aVideo['name']);
	}


	public function convertBcType($sType)
	{
		if ($sType == 'new')
		{
			return '1onONE';
		}
		elseif ($sType == 'used')
		{
			return 'POV';
		}
		else
		{
			return '';
		}
	}


	public function trimShortDesc($aVideosTemp, $iLimit = 80)
	{
		$aVideos = array();

		foreach ($aVideosTemp as $key => $aValue)
		{
			if (strlen($aValue['shortDescription']) > $iLimit)
			{
				$aValue['shortDescription'] = substr($aValue['shortDescription'], 0, strrpos(substr($aValue['shortDescription'], 0, $iLimit), ' ')) . '...';
			}
			$aVideos[$key] = $aValue;
		}

		return $aVideos;
	}


	public function getStyle($iStyleId)
	{
		$iStyleId = (int) $iStyleId;

		$aStyle = $this->database()->select('*')
				->from(Phpfox::getT('ko_chrome_data'))
				->where('style_id = "' . $iStyleId . '"')
				->execute('getRow');

		if (empty($aStyle)) $aStyle = array(
				'style_id' => $iStyleId,
				'year' => 'no data',
				'make' => 'no data',
				'model' => 'no data',
				'style_name' => 'no data',
				'style_name_without_trim' => 'no data',
				'trim_name' => 'no data',
				'cf_style_name' => 'no data',
				'drivetrain' => 'no data',
				'bodystyle' => 'no data',
				'crash_test_rating' => 'no data',
				'rebate' => 'no data',
				'recall' => 'no data',
				'warranty' => 'no data',
				'engine' => 'no data',
				'horsepower' => 'no data',
				'torque' => 'no data',
				'transmission' => 'no data',
				'mpg_city' => 'no data',
				'mpg_highway' => 'no data',
				'passengers' => 'no data',
				'structured_consumer_info' => 'no data',
				'editorial' => 'no data');
		return $aStyle;
	}


}

?>