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
class Dvs_Component_Controller_Dvs_Sitemap extends Phpfox_Component {

	public function process()
	{

		ob_clean();
		header("content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";

		$bSubdomain = Phpfox::getParam('dvs.enable_subdomain_mode');

		if ($bSubdomain)
		{
			$aDvs = Phpfox::getService('dvs')->get($this->request()->get('req1'), true);
			$sDvsUrl = Phpfox::getLib('url')->makeUrl($aDvs['title_url']);
		}
		else
		{
			$aDvs = Phpfox::getService('dvs')->get($this->request()->get('req2'), true);
			$sDvsUrl = Phpfox::getLib('url')->makeUrl('dvs') . $aDvs['title_url'] . '/';
		}

		Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);

		$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

		if ($aPlayer['featured_model'])
		{
			$aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
		}
		else
		{
			$aFeaturedVideo = array();
		}

		$aVideos = array_merge(array($aFeaturedVideo), Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']));

		$aVideos = Phpfox::getService('dvs.video')->removeDupes($aVideos);

		$aDealerSeoTags = explode(',', $aDvs['seo_tags']);
		$sDealerSeoTags = '';
		foreach ($aDealerSeoTags as $sTag)
		{
			$sDealerSeoTags .= '<video:tag>' . trim($sTag) . '</video:tag>';
		}

        if(!$aDvs['parent_url'] || !$aDvs['sitemap_parent_url']) {
            $aDvs['parent_url'] = $sDvsUrl;
        }

        if(!$aDvs['parent_video_url'] || !$aDvs['sitemap_parent_url']) {
            $aDvs['parent_video_url'] = $sDvsUrl . 'WTVDVS_VIDEO_TEMP/';
        }

		echo '<url>' . "\n" .
		'<loc>' . $aDvs['parent_url'] . '</loc>' . "\n" .
		'<lastmod>' . date('Y-m-d', $aDvs['dvs_time_stamp']) . '</lastmod>' . "\n" .
		'<changefreq>daily</changefreq>' . "\n" .
		'</url>' . "\n";

		foreach ($aVideos as $aVideo)
		{
			if (isset($aVideo['id']))
			{
                $aDvsPhraseOveride = Phpfox::getService('dvs.override')->getAll($aDvs, $aVideo);

				echo '<url>' . "\n" .
				'<loc>' . str_replace('WTVDVS_VIDEO_TEMP', $aVideo['video_title_url'], $aDvs['parent_video_url']) . '</loc>' . "\n" . '<video:video>' . "\n" .
				'<video:thumbnail_loc>' . Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.brightcove') . $aVideo['thumbnail_image'] . '</video:thumbnail_loc>' . "\n" .
				
				//'<video:title>' . Phpfox::getLib('parse.input')->clean($aVideo['name'], 100) . '</video:title>' . "\n" .
				'<video:title>' . Phpfox::getLib('parse.input')->clean($aVideo['name'] . ' | ' . $aDvs['city'] . ', ' . $aDvs['state_string'] . ' ' . $aDvs['postal_code'], 100) . ' | ' . $aDvs['dealer_name'] . '</video:title>' .
				//'<video:title>' .$aVideo['year'].' '. $aVideo['model']. '</video:title>' . "\n" .
				

				'<video:description>' . Phpfox::getLib('parse.input')->clean($aVideo['shortDescription'], 2048) . '.</video:description>' . "\n" .
				//'<video:description>' . Phpfox::getLib('parse.input')->clean($aVideo['shortDescription'] . ' View more ' . $aDvs['dealer_name'] . ' video test drives at ' . $sDvsUrl, 2048) . '.</video:description>' .
				
				'<video:publication_date>' . date('Y-m-d', (int) $aVideo['publishedDate'] / 1000) . '</video:publication_date>' . "\n" .
				'<video:category>Automotive</video:category>' . "\n" .
				'<video:tag>' . $aVideo['year'] . '</video:tag>' . "\n" .
				'<video:tag>' . $aVideo['make'] . '</video:tag> ' . "\n" .
				'<video:tag>' . $aVideo['model'] . '</video:tag> ' . "\n" .
				'<video:tag>' . $aVideo['bodyStyle'] . '</video:tag> ' . "\n" .
				$sDealerSeoTags . "\n" .
				//'<video:player_loc allow_embed="no">http://c.brightcove.com/services/viewer/federated_f9/1970101121001?isVid=1&amp;isUI=1&amp;domain=embed&amp;playerID=1970101121001&amp;publisherID=607012070001&amp;videoID=' . $aVideo['referenceId'] . '</video:player_loc>' . "\n" .
				'<video:duration>' . (int) ($aVideo['length'] / 1000) . '</video:duration>' . "\n" .
				'<video:rating>5.0</video:rating>' . "\n" .
				'<video:family_friendly>yes</video:family_friendly>' . "\n" .
				'<video:gallery_loc title="' . $aDvs['dealer_name'] . '">' . $aDvs['parent_url'] . '</video:gallery_loc>' . "\n" .
				'<video:uploader info="' . $aDvs['parent_url'] . '">' . $aDvs['dealer_name'] . '</video:uploader>' . "\n" .
				'</video:video>' . "\n" . '</url>' . "\n";
			}
		}

		echo '</urlset>';
		exit;
	}


}

?>