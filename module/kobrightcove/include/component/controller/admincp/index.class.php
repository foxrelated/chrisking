<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */
class Kobrightcove_Component_Controller_Admincp_Index extends Phpfox_Component {
	public function process() {
		if ($this->request()->get('status') == 'finished') {
			if ($this->request()->get('job') == 'import') {
                Phpfox::getService('kobrightcove')->sendImportedEmail();
				$this->url()->send('admincp.kobrightcove', null, $this->request()->get('total') . ' videos imported successfully.');
			} elseif ($this->request()->get('job') == 'update') {
				$this->url()->send('admincp.kobrightcove', null, $this->request()->get('total') . ' records updated successfully.');
			}
		}

		$this->template()
            ->setBreadcrumb('Manage Videos')
            ->assign(array());
	}
}

?>