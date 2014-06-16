<?php

defined('PHPFOX') or exit('NO DICE!');

class DVSTour_Service_Check extends Phpfox_Service {

    public function canAdd() 
    {   
        if (Phpfox::isAdminPanel()) 
        {
            return false;
        }
        if (Phpfox::isAdmin()) 
        {
            return true;
        }
        return false;
    }

    public function addPhrase($sText) 
    {
        $sVarName = Phpfox::getService('language.phrase.process')->prepare($sText);
        $aLanguages = Phpfox::getService('language')->get();
        $aText = array();
        foreach ($aLanguages as $aLanguage) 
        {
            $aText[$aLanguage['language_id']] = $sText;
        }
        $aVals = array(
            'product_id' => 'sitetour',
            'module' => 'sitetour|sitetour',
            'var_name' => $sVarName,
            'text' => $aText,
        );
        $iNumber = 1;
        do 
        {
            $bVarNameOk = Phpfox::getService('language.phrase')->isPhrase($aVals);
            if ($bVarNameOk) 
            {
                $aVals['var_name'] = $sVarName . '_' . $iNumber;
                $iNumber++;
            }
        } 
        while ($bVarNameOk);
        $sPhrase = Phpfox::getService('language.phrase.process')->add($aVals);
        return $sPhrase;
    }

}
