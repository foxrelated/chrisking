<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright   [PHPFOX_COPYRIGHT]
 * @author      Raymond Benc
 * @package     Phpfox_Component
 * @version     $Id: stat.class.php 4093 2012-04-16 12:54:05Z Raymond_Benc $
 */
class Dvs_Component_Controller_Admincp_Inventory extends Phpfox_Component
{
  /**
   * Class process method wnich is used to execute this component.
   */
  public function process()
  {
    $dvs_service = Phpfox::getService('dvs');

    if(!empty($_POST)){
      Phpfox::getService('log.session')->verifyToken();

      if(!empty($_POST['save'])){ // import.io settings save
        if($this->getSettingValue('dvs_inventory_guid')){
          Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_inventory_settings'), array('value' => Phpfox::getLib('database')->escape($_POST['dvs_inventory_guid'])), "name = 'dvs_inventory_guid'");
        }else{
          Phpfox::getLib('database')->insert(Phpfox::getT('ko_dvs_inventory_settings'), array(
              'name'         => 'dvs_inventory_guid',
              'value' => Phpfox::getLib('database')->escape($_POST['dvs_inventory_guid'])
            )
          );
        }
        if($this->getSettingValue('dvs_inventory_api_key')){
          Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_inventory_settings'), array('value' => Phpfox::getLib('database')->escape($_POST['dvs_inventory_api_key'])), "name = 'dvs_inventory_api_key'");
        }else{
          Phpfox::getLib('database')->insert(Phpfox::getT('ko_dvs_inventory_settings'), array(
              'name'         => 'dvs_inventory_api_key',
              'value' => Phpfox::getLib('database')->escape($_POST['dvs_inventory_api_key'])
            )
          );
        }
      }
    }

    // io.settings
    $dvs_inventory_guid    = $dvs_service->getSettingValue('dvs_inventory_guid');
    $dvs_inventory_api_key = $dvs_service->getSettingValue('dvs_inventory_api_key');

    // connectors
    $connectors            = $this->getConnectors();
    // var_dump($connectors);die();
    $pagination_types = array(
      0 => Phpfox::getPhrase('dvs.pagination_type_is_offset'),
      1 => Phpfox::getPhrase('dvs.pagination_type_is_page')
    );

    $this->template()->setTitle(Phpfox::getPhrase('dvs.dvs_dvs_inventory_title'))
      ->setBreadcrumb(Phpfox::getPhrase('dvs.dvs_dvs_inventory_title'))
      ->assign(array(
          'dvs_inventory_guid'    => $dvs_inventory_guid,
          'dvs_inventory_api_key' => $dvs_inventory_api_key,
          'connectors'            => $connectors,
          'pagination_types'      => $pagination_types,
        )
      );
  }
  
  /**
   * Get settings
   */
  public function getSettingValue($name = '')
  {
    $value = Phpfox::getLib('database')->select('value')
      ->from(Phpfox::getT('ko_dvs_inventory_settings'))
      ->where("name = '".Phpfox::getLib('database')->escape($name)."'")
      ->execute('getField');

    return $value;
  }
  
  /**
   * Get connectors
   */
  public function getConnectors()
  {
    $values = Phpfox::getLib('database')->select('*')
      ->from(Phpfox::getT('ko_dvs_inventory_connectors'))
      ->order('connector_id DESC')
      ->limit(1000)
      ->execute('getRows');

    return $values;
  }
  
  /**
   * Garbage collector. Is executed after this class has completed
   * its job and the template has also been displayed.
   */
  public function clean()
  {
    (($sPlugin = Phpfox_Plugin::get('core.component_controller_admincp_stat_clean')) ? eval($sPlugin) : false);
  }
}

?>