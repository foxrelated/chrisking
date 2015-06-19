<?php
class Mixpanel_Component_Block_Track_Views extends Phpfox_Component 
{
	
	public function process()
	{	
		$bIsUser = true;
		$aUser = array();
		$aDvs = $this->getParam('aDvs');
		if(!Phpfox::getUserId()){
			$aUser = array(
				'ip' => Phpfox::getIp()
			);
			$bIsUser = false;
		}else{
			$aUser = Phpfox::getService('mixpanel')->get(Phpfox::getUserId());
		
		}
		$this->template()->assign(array(
			'aUser' => $aUser,
			'bIsUser' => $bIsUser,
			'aDvs' => $aDvs,
			'iTime' => PHPFOX_TIME
			)
		);
		
		return 'block';
	}
	
}

?>