<?php

    /**
    * [PHPFOX_HEADER]
    */
    defined('PHPFOX') or exit('NO DICE!');

    /**
    * 
    * 
    * @copyright        [PHPFOX_COPYRIGHT]
    * @author          phuclb@ceofox.com
    * @package          Module_Sitetour
    * @version         $Id: index.class.php 1321 2009-12-15 18:19:30Z Raymond_Benc $
    */
    class DVSTour_Component_Block_AddTour extends Phpfox_Component {

        public function process() 
        {
            $bCanPlayTour = true;
            $aSetting = Phpfox::getService('dvstour')->getSetting();
            $this->template()->assign(array('aSetting' => $aSetting));
            $sAddTourPosition  =  Phpfox::getParam('dvstour.add_new_tour_block_position');
            if(!empty($sAddTourPosition))
            {
                $aAddTourPosition =  json_decode($sAddTourPosition,true);
                if($aAddTourPosition)
                {
                    $this->template()->assign(array(
                        'aAddTourPosition' => $aAddTourPosition
                    ));
                }
            }
            $sPlayTourPosition  =  Phpfox::getParam('dvstour.play_tour_button_play_position');
            if(!empty($sPlayTourPosition))
            {
                $aPlayTourPosition =  json_decode($sPlayTourPosition,true);
                if($aPlayTourPosition)
                {
                    $this->template()->assign(array(
                        'aPlayTourPosition' => $aPlayTourPosition
                    ));
                }
            }
            $this->template()->assign(array(
                'bCanAdd' => Phpfox::getService('dvstour.check')->canAdd()
            ));
            $aTour = Phpfox::getService('dvstour')->getTourOnSite();
            if (isset($aTour) && isset($aTour['sitetour_id'])) 
            {
                $bCheckBlockTour = Phpfox::getService('dvstour')->checkBlockTour($aTour['sitetour_id']);
                if ($bCheckBlockTour) 
                {
                    $this->template()->assign(array(
                        'bCheckBlockTour' => true
                    ));
                    $bCanPlayTour = false;
                }
                $aUser = Phpfox::getService('user')->get(Phpfox::getUserId());
                $iUserGroupId = 3;
                if(isset($aUser['user_id']))
                {
                    $iUserGroupId = $aUser['user_group_id'];
                }
                if ($aTour['user_group_id'] != $iUserGroupId && $aTour['user_group_id'] != 0) 
                {
                    $bCanPlayTour = false;
                }

                if($aSetting['show_tour_first_time'])
                {
                    if(Phpfox::getService('dvstour')->isView(Phpfox::getUserId(),$aTour['sitetour_id']))
                    {
                        $bCanPlayTour = false;
                    }
                }
                Phpfox::getService('dvstour.process')->updateView(Phpfox::getUserId(),$aTour['sitetour_id']);
                $aSteps = Phpfox::getService('dvstour')->getStepOfTour($aTour['sitetour_id']);

                // setting show last step confirm
                if (false) 
                {
                    $aLastStep = end($aSteps);
                    $aConfirmStep = array(
                        'title' => "Sitetour",
                        'content' => '<input onclick="$.ajaxCall(\'sitetour.blockTour\',\'id=' . $aTour['sitetour_id'] . '\');" class="cb_dont_show_tour" type="checkbox"> Don\'t show tour in next time.',
                        'element' => $aLastStep['element'],
                        'placement' => 'auto',
                        'animate' => true,
                        'duration' => false,
                        'confirm_step' => true
                    );
                    $aSteps[] = $aConfirmStep;
                }
                $this->template()->assign(array(
                    'aTour' => $aTour,
                    'aSteps' => $aSteps,
                ));
            }
            else
            {
                $bCanPlayTour = false;
            }
            // setting show backdrop and show step number
            $this->template()->assign(array(
                'aSetting' => $aSetting,
                'bCanPlayTour' => $bCanPlayTour
            ));
        }

    }

?>
