<?php
if (Phpfox::getParam('dvs.enable_subdomain_mode'))
{
	if ($this->_sModule == 'profile')
	{
    if( $aShortUrl = Phpfox::getService('dvs.shorturl')->get($oReq->get('req1')) ) {
      $this->_sModule = 'dvs';
      $this->_sController = 'view';
    } else {
      $this->_sModule = 'dvs';
    }
	}

	if ($this->_sModule == 'core' && $aShortUrl = Phpfox::getService('dvs.shorturl')->get($oReq->get('req2')))
	{
		$this->_sModule = 'dvs';
		$this->_sController = 'view';
	}
}
?>
