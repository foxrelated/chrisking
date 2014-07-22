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
    ob_start();
    echo 'cronjob completed ('.date('Y-m-d H:i:s').')';
    echo "\n";
    $c = ob_get_clean();
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/file/static/cronjob_log.txt', $c, FILE_APPEND);
    echo 'success!';die();
  }

}

?>