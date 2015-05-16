<?php
defined('PHPFOX') or exit('NO DICE!');
class Dvs_Component_Controller_AdminCP_Blacklists_Add extends Phpfox_Component
{
	public function process()
	{
		$bIsEdit = false; 
        $aValidation = array(
            'name' => array(
                    'def' => 'required',
                    'title' => Phpfox::getPhrase('dvs.fill_the_domain_name')
                ),
            'domain' => array(
                    'def' => 'required',
                    'title' => Phpfox::getPhrase('dvs.fill_the_domain_url')
                ),
        );
        $oValid = Phpfox::getLib('validator')->set(array(
                'sFormName' => 'core_js_link_form',
                'aParams' => $aValidation
        ));
        if ($iEditId = $this->request()->getInt('id'))
        {
            if ($aBlacklists = Phpfox::getService('dvs.blacklists')->getById($iEditId))
            {
                $bIsEdit = true;
                $this->template()->assign('aForms', $aBlacklists);
            }
        } 
        if ($aVals = $this->request()->getArray('val'))
        {
            if(phpfox_error::isPassed())
            {
                if(!$bIsEdit)
                {
                    if($iId = phpfox::getService('dvs.blacklists')->add($aVals, $_POST))
                    {
                        $this->url()->send('admincp.dvs.blacklists');
                    }    
                }
                else
                {
                    if(phpfox::getService('dvs.blacklists')->update($iEditId, $aVals, $_POST))
                    {
                         $this->url()->send('admincp.dvs.blacklists');
                    }
                }
                
            }
        }  
        $this->template()->setTitle(($bIsEdit ? Phpfox::getPhrase('dvs.edit_domain_blacklist'): Phpfox::getPhrase('dvs.add_new_domain_to_blacklist')))
            ->setBreadcrumb(($bIsEdit ? Phpfox::getPhrase('dvs.edit_domain_blacklist') : Phpfox::getPhrase('dvs.add_new_domain_to_blacklist')), $this->url()->makeUrl('admincp.dvs.blacklists.add'))
            ->assign(array(
                    'bIsEdit' => $bIsEdit,
                    'sCoreUrl' => phpfox::getParam('core.path'),
                    'aVals' => $aVals,
                    'sCreateJs' => $oValid->createJS(),
                    'sGetJsForm' => $oValid->getJsForm(),
                    'aControllers' => Phpfox::getService('admincp.component')->get(true),
                )
            )
            ;   
	}

}

?>