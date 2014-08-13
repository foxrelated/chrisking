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
class Dvs_Component_Block_Share_Email_Template extends Phpfox_Component {

	public function process()
	{
		$sReferenceId = $this->getParam('sReferenceId');
		$iDvsId = $this->getParam('iDvsId');
		
		$aForms = Phpfox::getService('dvs.style')->get($iDvsId);
		
		$selected = Phpfox::getService('dvs.style')->getFontFamilies();
		$ses='';
		foreach($selected as $ik=>$sele)
		{
			if($ik == $aForms['font_family_id'])
			{
				$ses = $sele;
				break;
			}
		}
		
		$this->template()
			->assign(array(
				'aVideo' => Phpfox::getService('dvs.video')->get($sReferenceId),
				'aDvs' => Phpfox::getService('dvs')->get($iDvsId, false),
				'sShareName' => $this->getParam('sShareName'),
				'sMyShareName' => $this->getParam('sMyShareName'),
				'sShareMessage' => $this->getParam('sShareMessage'),
				'sBackgroundImageUrl' => $this->getParam('sBackgroundImageUrl'),
				'sVideoLink' => $this->getParam('sVideoLink'),
				'sImagePath' => $this->getParam('sImagePath'),
				'sShareEmail' => $this->getParam('sShareEmail'),
				'aForms'	=> $aForms,
				'ses'		=> $ses
		));
	}


}

?>