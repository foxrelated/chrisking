<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright   Konsort.org 
 * @author      Konsort.org
 * @package     DVS
 */
class Dvs_Component_Controller_Cronjob extends Phpfox_Component
{

  public function process()
  {
    // $iDvsId = $this->request()->getInt('id');
    $aDvsRows = Phpfox::getService('dvs')->getScheduledInventory();
    if($aDvsRows){
      foreach ($aDvsRows as $aDvsRow) {
        Phpfox::getService('dvs')->importInventory($aDvsRow['dvs_id']);
      }
    }
    echo 'success!';die();
  }

}

?>