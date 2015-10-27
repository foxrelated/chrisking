<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		Konsort.org
 * @package 		DVS
 */
class Dvs_Component_Block_Download_Instructions_Cdk extends Phpfox_Component {
    public function process() {

        $this->template()
            ->assign(array(
                'aDvs' => Phpfox::getService('dvs')->get($this->getParam('iId')),
                'sCorePath' => Phpfox::getParam('core.path'),
                'bSubdomainMode' => Phpfox::getParam('dvs.enable_subdomain_mode')
            ));
    }

}

?>