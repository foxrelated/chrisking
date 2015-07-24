<?php
defined('PHPFOX') or exit('No direct script access allowed.');

class Dvs_Component_Controller_Download_Introduction extends Phpfox_Component {

	public function process() {
        $iId = $this->request()->getInt('id');

        Phpfox::getBlock('dvs.download-introductions', array(
            'iId' => $iId
        ));
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=introductions.txt");
        $this->template()->setTemplate('');
	}

}

?>