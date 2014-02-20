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
class Dvs_Component_Controller_Sitemap extends Phpfox_Component {

	public function process()
	{
		ob_clean();
		header("content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
		'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

		$aDvsList = Phpfox::getService('dvs')->listDvss(0, 0, 0, false);

		foreach ($aDvsList as $aDvs)
		{
			echo '<sitemap>' . "\n" .
			'<loc>' . (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl($aDvs['title_url']) : Phpfox::getLib('url')->makeUrl('dvs') . $aDvs['title_url'] . '/') . 'sitemap</loc>' . "\n" .
			'<lastmod>' . date('Y-m-d', $aDvs['dvs_time_stamp']) . '</lastmod>' . "\n" .
			'</sitemap>' . "\n";
		}

		echo '</sitemapindex>';
		exit;
	}


}

?>