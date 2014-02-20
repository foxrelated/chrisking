<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		G
 */
class G_Service_My_Shows extends Phpfox_Service {

	public $aMessages = array();

	public function __construct()
	{
		
	}

	public function getPage()
	{
		$sPatternTorrentTable = "/(?i)(?:<table id=\"searchResult\">)(?<torrentTable>[\d\W\w\s ,.]*?)(?:<\/table>)/";
		$sPatternSingleTorrent = "/(?i)(<tr>)(?<singleTorrent>[\d\W\w\s ,.]*?)(?:<\/tr>)/";
		$sPatternPagination = "/(?i)td colspan=\"9\"/";
		$sPatternCategory = "/(?i)More from this category\">(?<torrentCategories>[\d\W\w\s ,.-]*?)<\/a>/";
		$sPatternInfo = "/(?i)(a href=\"\/torrent\/)(?<torrentDescURL>[\d\W\w\s ,.]*?)(\" class=\"detLink\" title=\"Details for )(?<torrentTitle>[\d\W\w\s ,.]*?)(\")/";
		$sPatternUploadTimeAndSize = "/(?i)Uploaded (?<torrentTime>[\d\W\w\s -:]*?), Size (?<torrentSize>[\d\W\w\s .]*?),/";
		$sPatternDownloadUrl = "/(?i)(<a href=\"http:\/\/torrents.thepiratebay.se\/)(?<torrentDownloadURL>[\d\W\w\s ,.]*?)(\" title=\"Download this torrent\">)/";
		$sPatternMagnetLink = "/(?i)(<a href=\"magnet:\?)(?<torrentMagnetURI>[\d\W\w\s ,.]*?)(\" title=\"Download this torrent using magnet)/";

		$iCategory = 200;
		$sSearchTerms = 'deadliest catch s08e05';

		$aTorrents = array();

		$sSiteURI = "http://thepiratebay.se/search/" . $this->encodeUrl($sSearchTerms) . "/0/7/" . $iCategory;

		$sData = $this->getTPB($sSiteURI);

		if ($sData)
		{
			preg_match_all($sPatternTorrentTable, $sData, $aTorrentTable);

			if (!isset($aTorrentTable['torrentTable']['0']))
			{
				$this->aMessages['error'][] = 'Search results not found';
				return false;
			}

			preg_match_all($sPatternSingleTorrent, $aTorrentTable['torrentTable'][0], $aTorrentRows);

			for ($iRow = 0; $iRow < count($aTorrentRows['singleTorrent']); $iRow++)
			{
				//make sure we're not in the pagination
				if (preg_match_all($sPatternPagination, $aTorrentRows['singleTorrent'][$iRow], $aPagination)) continue;

				//parse categories
				preg_match_all($sPatternCategory, $aTorrentRows['singleTorrent'][$iRow], $aTorrentCats);
				$aTorrents[$iRow]['category'] = $aTorrentCats['torrentCategories'][0] . " -&gt; " . $aTorrentCats['torrentCategories'][1];

				//parse torrent URL
				preg_match_all($sPatternInfo, $aTorrentRows['singleTorrent'][$iRow], $aTorrentInfo);

				//parse torrent upload time and size
				preg_match($sPatternUploadTimeAndSize, $aTorrentRows['singleTorrent'][$iRow], $aUploadTimeAndSize);

				$sTorrentUploadTime = strip_tags($aUploadTimeAndSize['torrentTime']);

				$aDatePatterns = array(
					0 => '/mins/',
					1 => '/&nbsp;/',
					2 => '/Y-day/',
					3 => '/-/'
				);

				$aDateReplacements = array(
					0 => 'minutes',
					1 => ' ',
					2 => 'yesterday',
					3 => '/'
				);

				$sTorrentUploadTime = gmdate('r', strtotime(preg_replace($aDatePatterns, $aDateReplacements, $sTorrentUploadTime)));

				$dNow = gmdate('r');

				if (strtotime($sTorrentUploadTime) > strtotime($dNow))
				{
					$sTorrentUploadTime = $dNow;
				}

				$aTorrents[$iRow]['upload_time'] = strtotime($sTorrentUploadTime);

				$aTorrents[$iRow]['size'] = $this->sizeToBytes($aUploadTimeAndSize['torrentSize']);

				$sSeedersRaw = strstr($aTorrentRows['singleTorrent'][$iRow], '<td align="right">');
				$sSeedersIntRaw = substr($sSeedersRaw, 18);
				$iEndSeeders = strpos($sSeedersIntRaw, '<');
				$aTorrents[$iRow]['seeders'] = substr($sSeedersIntRaw, 0, $iEndSeeders);

				$sLeechersRaw = strstr($sSeedersIntRaw, '<td align="right">');
				$sLeechersIntRaw = substr($sLeechersRaw, 18);
				$iEndLeechers = strpos($sLeechersIntRaw, '<');
				$aTorrents[$iRow]['leechers'] = substr($sLeechersIntRaw, 0, $iEndLeechers);

				//parse torrent title
				$aTorrents[$iRow]['title'] = $aTorrentInfo['torrentTitle'][0];

				$aTorrents[$iRow]['url'] = "http://" . $this->encodeUrl("thepiratebay.se/torrent/" . $aTorrentInfo['torrentDescURL'][0]);

				//parse torrent download URL

				preg_match_all($sPatternDownloadUrl, $aTorrentRows['singleTorrent'][$iRow], $aTorrentInfo);

				//parse torrent magnet URI

				preg_match_all($sPatternMagnetLink, $aTorrentRows['singleTorrent'][$iRow], $aTorrentInfo);

				$aTorrents[$iRow]['magnet'] = "magnet:?" . $aTorrentInfo['torrentMagnetURI'][0];
			}
		}
		else
		{
			$this->aMessages['error'][] = 'No data received.';
			return false;
		}

		Phpfox::getService('g')->d($aTorrents, true, '$aTorrents', false, false, false);
		return $aTorrents;

	}

	public function sizeToBytes($sSize)
	{
		$aVals = array(
			'TiB' => 1000 * 1000 * 1000 * 1000,
			'TB' => 1024 * 1024 * 1024 * 1024,
			'GiB' => 1000 * 1000 * 1000,
			'GB' => 1024 * 1024 * 1024,
			'MiB' => 1000 * 1000,
			'MB' => 1024 * 1024,
			'KiB' => 1000,
			'KB' => 1024
		);

		$aKeys = array_keys($aVals);

		for ($i = 0; $i < count($aKeys); $i++)
		{
			if (strpos($sSize, $aKeys[$i]) !== false)
			{
				$iSize = preg_replace('#[^0-9.]#', '', strip_tags($sSize));
				$iBytes = $sSize * $aVals[$aKeys[$i]];
			}
		}
		return $iBytes;

	}

	public function encodeUrl($sUrl)
	{
		$sUrl = urlencode($sUrl);
		$sUrl = preg_replace('/%2F/', '/', $sUrl);

		return $sUrl;

	}

	public function getTPB($siteURI)
	{
		$curlSession = curl_init();
		curl_setopt($curlSession, CURLOPT_URL, $siteURI);
		curl_setopt($curlSession, CURLOPT_HEADER, 0);
		curl_setopt($curlSession, CURLOPT_TIMEOUT, 13);
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlSession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		$data = curl_exec($curlSession);
		curl_close($curlSession);
		return $data;

	}

}

?>