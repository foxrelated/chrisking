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
    * @version         $Id: ajax.class.php 7107 2014-02-11 19:46:17Z Fern $
    */
    class DVSTour_Component_Ajax_Ajax extends Phpfox_Ajax
    {
        public function showFormAddTour()
        {
            $aGroups = Phpfox::getService('user.group')->getForEdit();
            $sUserGroup = '<select id="user_group_id">';
            $sUserGroup.= '<option value="0">Anybody</option>';
            foreach($aGroups['special'] as $aGroup)
            {
                $sUserGroup.= '<option value="'.$aGroup['user_group_id'].'">'.$aGroup['title'].'</option>';
            }
            $sUserGroup.= '</select>';
            
            $this->setTitle('Add new tour');
            $sHtml = '<p style="margin-bottom:10px;"><strong>Tour Name: </strong></p>';
            $sHtml.= '<input type="text" id="tb_tour_title" style="width:255px;">';
            $sHtml.= '<p style="margin-bottom:15px;"><strong>Autorun This Tour: <input style="position:relative;top:2px" type="checkbox" id="cb_autorun"></strong></p>';
            $sHtml.= '<div style="margin-top:10px;"><strong>Type User View: </strong>'.$sUserGroup.'</div>';
            $sHtml.= '<div style="margin-top:10px"><input id="bt_save_tour" type="button" class="button" value="submit"></div>';
            $this->call('<script type="text/javascript">$("#" + tb_get_active()+" .js_box_content").append(\''.$sHtml.'\');</script>');
        }

        public function addTour()
        {
            $sTitle = $this->get('title');
            if($sTitle && !empty($sTitle) && $sTitle != '')
            {
                $sUrl = $this->get('url');
                $sData = $this->get('data');
                $aData = json_decode($sData);
                $bIsAutorun = $this->get('is_autorun');
                $iUserGroupId = $this->get('user_group_id');
                $sController = $this->get('controller');
                $iTourId = Phpfox::getService('dvstour.process')->addTour($sTitle,$aData,$sUrl,$bIsAutorun,$iUserGroupId,$sController);
                if($iTourId)
                {
                    $sMessage = 'Add tour successful!';
                    $this->call('$("#" + tb_get_active()+" .js_box_content").html(\''.$sMessage.'\');setTimeout("tb_remove()",3000);');
                }   
                else
                {
                    $this->alert('Add tour fail!');
                }
            }
            else
            {
                $this->alert('Please enter tour name!');
            }
        }

        public function blockTour()
        {
            $iTourId = $this->get('id');
            if($iTourId && is_numeric($iTourId))
            {
                Phpfox::getService('dvstour.process')->blockTour($iTourId);        
            }
            $this->call('$Core.Tour.end();');
        }

        public function categorySubOrdering()
        {
            $aVals = $this->get('val');
            Phpfox::getService('core.process')->updateOrdering(array(
                'table' => 'sitetour_step',
                'key' => 'step_id',
                'values' => $aVals['ordering']
                )
            );        
        } 

        public function updateActivity()
        {
            if (Phpfox::getService('dvstour.process')->updateActivity($this->get('id'), $this->get('active'), $this->get('step')))
            {

            }
        }  
        
        public function updateAutoRun()
        {
            if (Phpfox::getService('dvstour.process')->updateAutoRun($this->get('id'), $this->get('active')))
            {
                
            }
        } 
        
        public function updateAddTourPosition()
        {
            if(!Phpfox::isAdmin())
            {
                return;
            }
            $sPosition = $this->get('position');
            if($sPosition && !empty($sPosition))
            {
                $aVals = array(
                    'order' => array(
                        'add_new_tour_block_position' => 1
                    ),
                    'value' => array(
                        'add_new_tour_block_position' => $sPosition
                    )
                );
                Phpfox::getService('admincp.setting.process')->update($aVals);
            }
        } 
        
        public function updatePlayTourPosition()
        {
            if(!Phpfox::isAdmin())
            {
                return;
            }
            $sPosition = $this->get('position');
            if($sPosition && !empty($sPosition))
            {
                $aVals = array(
                    'order' => array(
                        'play_tour_button_play_position' => 1
                    ),
                    'value' => array(
                        'play_tour_button_play_position' => $sPosition
                    )
                );
                Phpfox::getService('admincp.setting.process')->update($aVals);
            }
        }
    }
?>
