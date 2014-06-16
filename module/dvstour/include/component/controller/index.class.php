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
    class DVSTour_Component_Controller_Index extends Phpfox_Component
    {    
        public function process()
        {
            d(Phpfox::getLib('module')->getFullControllerName());
            $sLink = 'http://localhost/snowfox/snowfox.3.7/index.php?do=/blog/2/sdtdggdshfy-hdsg-sdfg-dfsg/';
            d($this->getFullController($sLink));die();
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
