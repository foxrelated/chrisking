<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

class DVSTour_Component_Controller_Admincp_Addtour extends Phpfox_Component {

    /**
     * Class process method wnich is used to execute this component.
     */
    public function process() 
    {
        $aValidation = array(
            'name' => array(
                'def' => 'required',
                'title' => Phpfox::getPhrase('dvstour.please_add_tour_name')
            ),
            'url' => array(
                'def' => 'required',
                'title' => Phpfox::getPhrase('dvstour.please_enter_url')
            ),
        );
        $oValid = Phpfox::getLib('validator')->set(array(
            'sFormName' => 'core_js_blog_form',
            'aParams' => $aValidation
            )
        );
        $aUserGroup = Phpfox::getService('user.group')->getForEdit();
        if ($aVals = $this->request()->getArray('val')) 
        {
            if ($oValid->isValid($aVals)) 
            {
                $sTitle = $aVals['name'];
                $aData = array();
                $sUrl = $aVals['url'];
                $bIsAutorun = $aVals['is_auto'];
                $iUserGroupId = $aVals['user_group'];
                $sController = Phpfox::getService('dvstour')->getFullController($sUrl);
                $iId = Phpfox::getService('dvstour.process')->addTour($sTitle, $aData, $sUrl, $bIsAutorun, $iUserGroupId,$sController);
                //Set session for display block add tag
                $_SESSION[base64_encode('npfox.com')] = TRUE;
                Phpfox::getLib('url')->send('admincp.dvstour.addstep.id_' . $iId, NULL, Phpfox::getPhrase('dvstour.please_add_new_step'));
            }
        }
        $this->template()->setBreadcrumb(Phpfox::getPhrase('dvstour.add_new_tour_backend'), $this->url()->makeUrl('current'))
                ->setTitle(Phpfox::getPhrase('dvstour.add_new_tour_backend'))
                ->assign(array(
                    'aUserGroup' => $aUserGroup['special'],
                    'sCreateJs' => $oValid->createJS(),
                    'sGetJsForm' => $oValid->getJsForm(),
        ));
    }

}

?>
