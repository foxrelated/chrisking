<?php
defined('PHPFOX') or exit('NO DICE!');
class Dvs_Component_Controller_Admincp_Blacklists_Index extends Phpfox_Component
{
  public function process()
  {
    $this->template()->setTitle(Phpfox::getPhrase('dvs.manage_blacklists_domain'))
            ->setBreadcrumb(Phpfox::getPhrase('dvs.manage_blacklists_domain'))
            ->assign(array(
                   'aBlacklists' => phpfox::getService('dvs.blacklists')->getAllDomain()
                )
            );
  }
}

?>
