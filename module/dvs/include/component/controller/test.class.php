<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        $sAgent = 'Mozilla/5.0 (Linux; Android 4.2.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Safari/537.36';
        vdd($this->getBrowser($sAgent));
        /*if($this->request()->get('import')) {
            Phpfox::getService('dvs.inventory')->importFile();
            echo 'Import Completed';
            exit;
        }

        if($this->request()->get('update') == 'style') {
            Phpfox::getService('dvs.inventory')->updateEdStyleId();
            $bReturn = Phpfox::getService('dvs.inventory')->getPending('style');
            echo 'Pending : ' . $bReturn;
            exit;
        }

        if($this->request()->get('update') == 'video') {
            Phpfox::getService('dvs.inventory')->updateReferenceId();
            $bReturn = Phpfox::getService('dvs.inventory')->getPending('video');
            echo 'Pending : ' . $bReturn;
            exit;
        }

        echo 'No actions!';
        exit;*/

        //Phpfox::getService('dvs.inventory')->updateEdStyleId();

        //Phpfox::getService('dvs.inventory')->updateReferenceId(30);


        // Get the variables from the ajax call.
        //$sDvsName = 'showroomtest';
        //$iYear = '2008';

        // Get the DVS details based off the DVS name.
        //$aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
        //$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        // Get all of the makes for the DVS for the selected year.
        //$aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dealer_id']);
        //vdd($aMakes);
    }

    public function getBrowser($sAgent)
    {
        $this->_bIsMobile = false;

        if (preg_match("/Firefox\/(.*)/i", $sAgent, $aMatches) && isset($aMatches[1]))
        {
            $sAgent = 'Firefox ' . $aMatches[1];
        }
        elseif (preg_match("/MSIE (.*);/i", $sAgent, $aMatches))
        {
            $aParts = explode(';', $aMatches[1]);
            $sAgent = 'IE ' . $aParts[0];
        }
        elseif (preg_match("/Opera\/(.*)/i", $sAgent, $aMatches))
        {
            $aParts = explode(' ', trim($aMatches[1]));
            $sAgent = 'Opera ' . $aParts[0];
        }
        elseif (preg_match('/\s+?chrome\/([0-9.]{1,10})/i', $sAgent, $aMatches))
        {
            $aParts = explode(' ', trim($aMatches[1]));
            $sAgent = 'Chrome ' . $aParts[0];
        }
        elseif (preg_match('/android/i', $sAgent))
        {
            $this->_bIsMobile = true;
            $sAgent = 'Android';
        }
        elseif (preg_match('/opera mini/i', $sAgent))
        {
            $this->_bIsMobile = true;
            $sAgent = 'Opera Mini';
        }
        elseif (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine)/i', $sAgent))
        {
            $this->_bIsMobile = true;
            $sAgent = 'Palm';
        }
        elseif (preg_match('/blackberry/i', $sAgent))
        {
            $this->_bIsMobile = true;
            $sAgent = 'Blackberry';
        }
        elseif (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile|windows phone)/i', $sAgent))
        {
            $this->_bIsMobile = true;
            $sAgent = 'Windows Smartphone';
        }
        elseif (preg_match("/Version\/(.*) Safari\/(.*)/i", $sAgent, $aMatches) && isset($aMatches[1]))
        {
            if (preg_match("/iPhone/i", $sAgent) || preg_match("/ipod/i", $sAgent))
            {
                $aParts = explode(' ', trim($aMatches[1]));
                $sAgent = 'Safari iPhone ' . $aParts[0];
                $this->_bIsMobile = true;
            }
            else if (preg_match("/ipad/i", $sAgent))
            {
                $aParts = explode(' ', trim($aMatches[1]));
                $sAgent = 'ipad';
                $this->_bIsMobile = true;
            }
            else
            {
                $sAgent = 'Safari ' . $aMatches[1];
            }
        }
        //custom ipad detection
        elseif (preg_match('/crios/i', $sAgent)) //detects Chrome browser for iOS
        {
            $this->_bIsMobile = false;
            $sAgent = 'ipad';
        }
        elseif (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i', $sAgent))
        {
            $this->_bIsMobile = true;
        }

        if ($sAgent == 'ipad')
        {
            return 'ipad';
        }
        else
        {
            return ($this->_bIsMobile ? 'mobile' : 'desktop');
        }
    }
}
?>