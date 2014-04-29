<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright   Konsort.org
 * @author      Konsort.org
 * @package     DVS
 */
class Dvs_Component_Block_Playermini_Preview extends Phpfox_Component {

  public function processNew()
  {
    $iWidth = $this->request()->getInt('width');
    $iHeight = $this->request()->getInt('height');

    if (!$iWidth || !$iHeight)
    {
      $iWidth = 880;
      $iHeight = 505;
    }

    $iPlayerWidth = $iWidth - 160;
    $iPlayerHeight = $iHeight - 100;

    $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');
    $sBrowser = Phpfox::getService('dvs')->getBrowser();

    $aValsClean = Phpfox::getLib('request')->getRequests();

    $aVals = array();

    foreach ($aValsClean as $sKey => $sVal)
    {
      $sKey = str_replace('-', '_', $sKey);
      $aVals[$sKey] = $sVal;
    }

    $aVals['selected_makes'] = explode(',', $aVals['selected_makes']);

    if (isset($aVals['dvs_id']))
    {
      $bIsDvs = true;
      $aDvs = Phpfox::getService('dvs')->get($aVals['dvs_id']);
    }
    else
    {
      $bIsDvs = false;
      $aDvs = array();
    }

    $sOverride = ($bSubdomainMode ? $this->request()->get('req2') : $this->request()->get('req3'));

    $aOverviewVideos = ($bIsDvs ? Phpfox::getService('dvs.video')->getOverviewVideos(0, $aVals['selected_makes']) : Phpfox::getService('idrive.player')->getVideos(0, $aVals['selected_makes']));

    //Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
    array_unshift($aOverviewVideos, '');
    unset($aOverviewVideos[0]);

    if (!empty($aVals['featured_model']))
    {
      $aFeaturedModel = explode(',', $aVals['featured_model']);
    }

    if (isset($aFeaturedModel[1]))
    {
      $aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aFeaturedModel[0], $aFeaturedModel[1], $aFeaturedModel[2]);
    }
    else
    {
      $aFeaturedVideo = array();
    }

    //We need to get the first video to play in order to set up the meta data
    if ($sOverride)
    {
      $aOverrideVideo = Phpfox::getService('dvs.video')->get($sOverride, true);
    }
    else
    {
      $aOverrideVideo = array();
    }

    if ($aOverrideVideo)
    {
      $aFirstVideo = $aOverrideVideo;
    }
    else if ($aFeaturedVideo)
    {
      $aFirstVideo = $aFeaturedVideo;
    }
    else
    {
      $aFirstVideo = $aOverviewVideos[1];
    }

    $sLinkBase = Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'));
    $sLinkBase .= $aFirstVideo['video_title_url'];
    $sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.brightcove') . $aFirstVideo['thumbnail_image'];
    $sThumbnailUrl = str_replace('index.php\?do=\/', '', $sThumbnailUrl);

    $aFirstVideoMeta = array(
      'url' => Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $aFirstVideo['video_title_url']),
      'thumbnail_url' => $sThumbnailUrl,
      'upload_date' => date('Y-m-d', (int) ($aFirstVideo['publishedDate'] / 1000)),
      'duration' => 'PT' . (int) ($aFirstVideo['length'] / 1000) . 'S',
      'name' => $aFirstVideo['name'],
      'year' => $aFirstVideo['year'],
      'make' => $aFirstVideo['make'],
      'model' => $aFirstVideo['model'],
      'description' => Phpfox::getLib('parse.output')->clean($aFirstVideo['longDescription']),
      'referenceId' => $aFirstVideo['referenceId']
    );

    if ($bIsDvs)
    {
      $aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);
    }
    $sBrowser = Phpfox::getService('dvs')->getBrowser();

    $iPlaylistThumbnails = floor(($iPlayerWidth - 98 ) / 155);
    if ($iPlaylistThumbnails > 1)
    {
      $iScrollAmt = $iPlaylistThumbnails - 1;
    }
    else
    {
      $iScrollAmt = 1;
    }

    // Determine the number of extra li's to add.
    $iExtraLi = (count($aOverviewVideos) - $iPlaylistThumbnails) % $iScrollAmt;
    $sExtraLi = '';
    for ($i=0; $i < $iExtraLi; $i++)
    {
      $sExtraLi .= '<li style="display: none;"></li>';
    }

    $this->template()
      ->assign(array(
        'aPlayer' => $aVals,
        'iDvsId' => ($bIsDvs ? $aVals['dvs_id'] : 0),
        'sPrerollXmlUrl' => substr_replace(Phpfox::getLib('url')->makeUrl('idrive.prxml', array('pr-id' => $aVals['preroll_file_id'], 'duration' => $aVals['preroll_duration'])), '', -1) . '?',
        'aVideos' => $aOverviewVideos,
        'aOverviewVideos' => $aOverviewVideos,
        'bPreview' => true,
        'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
        'bIsDvs' => $bIsDvs,
        'bIsExternal' => false,
        'aDvs' => ($bIsDvs ? $aDvs : array()),
        'aFeaturedVideo' => $aFeaturedVideo,
        'aOverrideVideo' => array(),
        'sLinkBase' => $sLinkBase,
        'aFirstVideoMeta' => $aFirstVideoMeta,
        'bSubdomainMode' => $bSubdomainMode,
        'sBrowser' => $sBrowser,
        'iPlayerWidth' => $iPlayerWidth,
        'iPlayerHeight' => $iPlayerHeight,
        'sExtraLi' => $sExtraLi,
        'sJavascript' => '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>'
        . '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>'
        . '<script type="text/javascript">var bIsDvs = ' . ($bIsDvs ? 'true' : 'false') . '</script>'
        . '<script type="text/javascript">var sFirstVideoTitleUrl = "' . $aFirstVideo['video_title_url'] . '";</script>'
        . '<script type="text/javascript">var bGoogleAnalytics = false;</script>'
        . '<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>'
    ));

    $this->template()
      ->setTemplate('blank')
      ->setHeader(array(
//        '<style type="text/css">' . Phpfox::getService('dvs.player')->getCss($aVals) . '</style>',
//        'player.css' => 'module_dvs',
//        '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
//        '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
//        '<script type="text/javascript">var bIsDvs = ' . ($bIsDvs ? 'true' : 'false') . '</script>',
//        '<script type="text/javascript">var sFirstVideoTitleUrl = "' . $aFirstVideo['video_title_url'] . '";</script>',
//        '<script type="text/javascript">var bGoogleAnalytics = false;</script>',
        'player.js' => 'module_dvs',
        'overlay.js' => 'module_dvs',
        'google_analytics.js' => 'module_dvs',
        'jcarousellite.js' => 'module_dvs',
        //'cursordivscroll.js' => 'module_dvs',
//        '<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
        'get_price.css' => 'module_dvs',
        'share_email.css' => 'module_dvs',
        'showroom.css' => 'module_dvs',
        'chapter_buttons.css' => 'module_dvs'
    ));
  }

  public function process()
  {
    $aVals = $this->request()->getArray('val');
    $aValsClean = array();

    foreach ($aVals as $sKey => $sVal)
    {
      $sKey = str_replace('_', '-', $sKey);
      $aValsClean[$sKey] = $sVal;
    }

    $aValsClean['logo-branding-url'] = '';

    $sMakes = '';

    foreach ($aVals['selected_makes'] as $sMake => $bSelected)
    {
      if ($bSelected)
      {
        $sMakes .= $sMake . ',';
      }
    }

    $aValsClean['selected-makes'] = rtrim($sMakes, ',');

    $sUrl = 'dvs.view.preview.' . $aVals['dvs_id'];
    $sIframeUrl = Phpfox::getLib('url')->makeUrl($sUrl, $aValsClean);

    if( isset($aVals['shorturl']) and !empty($aVals['shorturl']) ) {
      if( Phpfox::getParam('dvs.enable_subdomain_mode') ) {
        $sIframeUrl = Phpfox::getLib('url')->makeUrl( 'www' ) . $aVals['shorturl'].'/bc_refid';
      } else {
        $sIframeUrl = Phpfox::getLib('url')->makeUrl( '' ) . $aVals['shorturl'].'/bc_refid';
      }
    }
    $this->template()
      ->assign(array(
        'aVals' => $aVals,
        'sIframeUrl' => $sIframeUrl,
    ));
  }


}

?>