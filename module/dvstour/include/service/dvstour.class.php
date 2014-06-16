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
    * @package         Phpfox_Service
    * @version         $Id: sitetour.class.php 6889 2013-11-14 09:35:03Z Miguel_Espinoza $
    */
    class DVSTour_Service_DVSTour extends Phpfox_Service 
    {
        public function getTourOnSite($sUrl = '') 
        {
            if ($sUrl == '') 
            {
                $sUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }
            $iUserGroupId = 3;
            $aUser = Phpfox::getService('user')->get(Phpfox::getUserId());
            if(isset($aUser['user_id']))
            {
                $iUserGroupId = $aUser['user_group_id'];
            }
            $sController = Phpfox::getLib('module')->getFullControllerName();
            $aResult = $this->database()->select('st.*')
            ->from(Phpfox::getT('sitetour'), 'st')
            ->where("is_active=1 AND (url LIKE '%" . $sUrl . "' OR controller='".$sController."') AND (user_group_id = ".$iUserGroupId." OR user_group_id = 0)")
            ->order('sitetour_id DESC')
            ->limit(1)
            ->execute('getRow');
            return $aResult;
        }

        public function getStepOfTour($iTourId, $bPlay = true) 
        {
            $sCondition = '';
            if ($bPlay) {
                $sCondition = 'is_active=1 AND ';
            }
            $aReturns = $this->database()->select('*')
            ->from(Phpfox::getT('sitetour_step'))
            ->where($sCondition . 'sitetour_id=' . (int) $iTourId)
            ->order('ordering')
            ->execute('getRows');
            foreach($aReturns as $key=> $aStep)
            {
                if(is_numeric($aStep['duration']))
                {
                    if($aStep['duration'] == 0)
                    {
                        unset($aReturns[$key]['duration']);
                    }
                    else if($aStep['duration'] < 2000)
                    {
                        $aReturns[$key]['duration'] = 2000;
                    }
                }
                else
                {
                    unset($aReturns[$key]['duration']);
                }
            }
            return $aReturns;
        }

        public function getAllTours() 
        {
            $aReturns = $this->database()->select('sr.*,count(srs.step_id) AS total_step,ug.title AS group_title')
            ->from(Phpfox::getT('sitetour'), 'sr')
            ->join(Phpfox::getT('sitetour_step'), 'srs', 'srs.sitetour_id=sr.sitetour_id')
            ->leftJoin(Phpfox::getT('user_group'),'ug','sr.user_group_id=ug.user_group_id')
            ->group('sr.sitetour_id')
            ->order('url DESC')
            ->execute('getRows');
            return $aReturns;
        }

        public function getTour($iId) 
        {
            $aReturn = $this->database()->select('*')
            ->from(Phpfox::getT('sitetour'), 's')
            ->where('sitetour_id=' . (int) $iId)
            ->execute('getRow');
            return $aReturn;
        }

        public function getStep($iId) 
        {
            $aStep = $this->database()->select('*')
            ->from(Phpfox::getT('sitetour_step'), 's')
            ->where('step_id=' . (int) $iId)
            ->execute('getRow');
            return $aStep;
        }

        public function checkBlockTour($iSitetourId) 
        {
            $aTours = $this->database()->select('*')
            ->from(Phpfox::getT('sitetour_user_block'))
            ->where('user_id=' . Phpfox::getUserId() . ' AND sitetour_id=' . (int) $iSitetourId)
            ->execute('getRows');
            if (count($aTours) > 0) 
            {
                return true;
            } else 
            {
                return false;
            }
        }

        public function getSetting()
        {
            return $this->database()->select('*')
            ->from(Phpfox::getT('sitetour_setting'))
            ->where('setting_id=1')
            ->execute('getRow');
        }

        public function isView($iUserId,$iSiteTourId)
        {
            $aView = $this->database()->select('*')
            ->from(Phpfox::getT('sitetour_view'))
            ->where('user_id='.(int)$iUserId.' AND sitetour_id='.(int)$iSiteTourId)
            ->execute('getRows');
            if(count($aView) == 0)
            {
                return false;
            }
            return true;
        }

        public function getFullController($sLink)
        {
            $sController = '';
            $sContent = file_get_contents($sLink);
            $sRegex = '/var oParams = .*}/';
            preg_match($sRegex,$sContent,$aMatches);
            if(count($aMatches) > 0)
            {
                preg_match('/{.*}/',$aMatches[0],$asParams);
                if(count($asParams) > 0)
                {
                    $sParam = str_replace("'",'"',$asParams[0]);
                    $aParmam = json_decode($sParam,true);
                    if(isset($aParmam['sController']))
                    {
                        $sController = $aParmam['sController'];
                    }
                }
            }
            return $sController;
        }

    }

?>
