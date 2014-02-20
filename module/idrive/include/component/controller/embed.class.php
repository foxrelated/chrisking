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
 * @package 		iDrive
 */
class Idrive_Component_Controller_Embed extends Phpfox_Component {

	public function process()
	{
		Phpfox::isUser(true);

		$aVals = $this->request()->getArray('val');


		if (!empty($aVals))
		{
			$aVals['email'] = urlencode($aVals['email']);

			$aVals['autoplay'] = (isset($aVals['autoplay']) && $aVals['autoplay'] ? 'true' : 'false');
			$aVals['new2u'] = (isset($aVals['new2u']) && $aVals['new2u'] ? 'true' : 'false');
			$aVals['1onone'] = (isset($aVals['1onone']) && $aVals['1onone'] ? 'true' : 'false');
			$aVals['top200'] = (isset($aVals['top200']) && $aVals['top200'] ? 'true' : 'false');
			$aVals['pov'] = (isset($aVals['pov']) && $aVals['pov'] ? 'true' : 'false');
			$aVals['showplaylist'] = (isset($aVals['showplaylist']) && $aVals['showplaylist'] ? 'true' : 'false');
			$aVals['showgetprice'] = (isset($aVals['showgetprice']) && $aVals['showgetprice'] && $aVals['email'] ? 'true' : 'false');
		}

		$this->template()
			->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'))
			->setBreadcrumb('Embed Code Generator', false)
			->assign(array(
				'aForms' => $aVals
		));
	}


}

?>
