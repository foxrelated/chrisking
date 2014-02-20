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
class Dvs_Component_Controller_Reports_Share extends Phpfox_Component {

	public function process()
	{
		$sDvsTitle = $this->request()->get('req4');
		$aDvs = Phpfox::getService('dvs')->get($sDvsTitle, true);

		$aVals = $this->request()->getArray('val');
		if (isset($aVals['user_id']) && $aVals['user_id'])
		{
			$aShareReport = Phpfox::getService('dvs.salesteam')->getShareReport($aDvs['dvs_id'], $aVals);

			// Export CSV
			if ($aVals['csv'])
			{
				$sCsv = Phpfox::getService('dvs.salesteam')->makeCsv($aShareReport);
				Phpfox::getService('dvs.salesteam')->downloadSendHeaders("share_report_" . $aVals['start_year'] . '-' . $aVals['start_month'] . '-' . $aVals['start_day'] . '_to_' . $aVals['end_year'] . '-' . $aVals['end_month'] . '-' . $aVals['end_day'] . ".csv");
				echo $sCsv;
				exit;
			}
		}
		else
		{
			$aShareReport = array();
		}

		$aDvsOwner = array(Phpfox::getService('user')->get($aDvs['user_id']));
		$aTeamMembers = array_merge($aDvsOwner, Phpfox::getService('dvs.salesteam')->getAll($aDvs['dvs_id']));
		if (Phpfox::isAdmin() && $aDvs['user_id'] != Phpfox::getUserId())
		{
			$aAdmin = array(Phpfox::getService('user')->get($aDvs['user_id']));
			$aTeamMembers = array_merge($aAdmin, $aTeamMembers);
		}


		$this->template()
			->setTitle(Phpfox::getPhrase('dvs.share_report'))
			->setBreadcrumb(Phpfox::getPhrase('dvs.share_report'))
			->setHeader(array(
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'share-report.css' => 'module_dvs'
			))
			->assign(array(
				'aDvs' => $aDvs,
				'aForms' => $aVals,
				'aTeamMembers' => $aTeamMembers,
				'aShareReport' => $aShareReport,
				'aMember' => (isset($aVals['user_id']) ? Phpfox::getService('user')->get($aVals['user_id']) : array())
		));
	}


}

?>