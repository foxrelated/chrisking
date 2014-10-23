<?php

class Dvs_Component_Controller_Utm extends Phpfox_Component {
    public function process() {
        /** DISABLE HEADER & FOOTER **/
        $aLocale = Phpfox::getLib('locale')->getLang();
        $this->template()->assign(array(
                'sLocaleDirection' => $aLocale['direction'],
                'sLocaleCode' => $aLocale['language_code'],
                'sLocaleFlagId' => $aLocale['image'],
                'sLocaleName' => $aLocale['title']
            )
        );

        echo $this->template()->getTemplate('dvs.controller.utm', true);
        exit;
    }
}
?>