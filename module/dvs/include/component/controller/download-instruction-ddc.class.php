<?php
defined('PHPFOX') or exit('No direct script access allowed.');

class Dvs_Component_Controller_Download_Instruction_Ddc extends Phpfox_Component {

	public function process() {
        $iId = $this->request()->getInt('id');

        Phpfox::getBlock('dvs.download-instructions-ddc', array(
            'iId' => $iId
        ));
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=Dealer.com DVS Integration Instructions.txt");
        $this->template()->setTemplate('');
	}

}

?>