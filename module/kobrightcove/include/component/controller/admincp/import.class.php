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
 * @package 		KOBrightcove
 */
class Kobrightcove_Component_Controller_Admincp_Import extends Phpfox_Component {

	public function process()
	{

		if ($this->request()->get('req4') == 'update')
		{
			$sJob = 'update';
			$sBreadcrumb = 'Update Database';
		}
		else
		{
			$sJob = 'import';
			$sBreadcrumb = 'Import Videos';
		}

		if ($aVals = $this->request()->getArray('val'))
		{
			if ($aVals['total'] > 0)
			{
				$this->template()
					->setBreadcrumb($sBreadcrumb)
					->assign(array(
						'bImport' => true,
						'sJob' => $aVals['job'],
						'iTotal' => $aVals['total'],
						'iTotalVideos' => $aVals['totalvideos'],
						'iBatch' => 1
				));
			}
			else
			{
				Phpfox_Error::set('Total Not Set.');
				$this->template()->assign(array(
					'sJob' => $sJob,
					'bImport' => false
				));
			}
		}
		else
		{
			$iTotalVideos = Phpfox::getService('kobrightcove.koechove')->getTotal();

			$this->template()
				->setBreadcrumb($sBreadcrumb)
				->assign(array(
					'bImport' => false,
					'sJob' => $sJob,
					'iTotal' => ceil(($iTotalVideos / 10)),
					'iTotalVideos' => $iTotalVideos
			));
		}
	}


}

?>