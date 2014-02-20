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
class Research_Component_Controller_External extends Phpfox_Component {

	public function process()
	{
		$aVideoReq = explode("/", $this->request()->get('do'));
		$sVideoReq = end($aVideoReq);

		if (Phpfox::getService('research')->getVideoByRefId($sVideoReq)) {
			$this->template()->assign(array(
				'sRefId' => $sVideoReq,
				'sPlaylist' => false
			));
		} else {
			$this->template()->assign(array(
				'sRefId' => false,
				'sPlaylist' => $sVideoReq
			));
		}

		$this->template()
				->setTemplate('blank')
				->setHeader(array(
					'playlist.js' => 'module_research'
				))
				->assign(array(
					'iPlayerId' => $this->request()->getInt('id', ''),
					'sKey' => $this->request()->get('key', ''),
					'iWidth' => $this->request()->getInt('width', ''),
					'iHeight' => $this->request()->getInt('height', '')
				));
	}

}

?>

