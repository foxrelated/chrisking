<?php
    /**
    * [PHPFOX_HEADER]
    */

    defined('PHPFOX') or exit('NO DICE!');

    /**
    * 
    * 
    * @copyright        [PHPFOX_COPYRIGHT]
    * @author          Raymond_Benc
    * @package         Phpfox_Component
    * @version         $Id: index.class.php 6113 2013-06-21 13:58:40Z Raymond_Benc $
    */
    class DVSTour_Component_Controller_Admincp_AddStep extends Phpfox_Component
    {
        /**
        * Class process method wnich is used to execute this component.
        */
        public function process()
        {   
            if(!$iId = $this->request()->getInt('id'))
            {
                $this->url()->send('admincp.dvstour');
            }
            
            $aTour = Phpfox::getService('dvstour')->getTour($iId);
            if(!$aTour)
            {
                $this->url()->send('admincp.dvstour');
            }
            if($aVals = $this->request()->getArray('val'))
            {
                $oStep = new stdClass();
                $oStep->title = $aVals['title'];
                $oStep->element = $aVals['element'];
                $oStep->content = $aVals['content'];
                if(isset($aVals['is_auto']) && $aVals['is_auto'])
                {
                    $oStep->duration = $aVals['duration'];
                }
                else
                {
                    $oStep->duration = '';
                }
                $iStepId = Phpfox::getService('dvstour.process')->addStep($iId,$oStep);
                if($iStepId)
                {
                    $_SESSION[base64_encode('npfox.com')];
                    if($this->request()->get('addmore'))
                    {
                        $this->url()->send('admincp.dvstour.addstep',array('id' => $iId),'Add step successfully!');
                    }
                    else
                    {
                        $this->url()->send('admincp.dvstour',array('tour' => $iId),'Add step successfully!');
                    }
                }
                else
                {
                    return Phpfox_Error::set('Cannot add step!');
                }
            }
            $this->template()->assign(array(
                'aTour' => $aTour
            ));
        }
    }
?>
