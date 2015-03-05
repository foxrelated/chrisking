<?php

require_once 'Mobile_Detect.php';

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		DVS
 */
class Dvs_Service_Dvs extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs');
	}

	public function getModelInventory($ko_id = 0)
	{
		if(empty($ko_id)){
			return array();
		}

		$videoCar = $this->getVideoCar($ko_id);
		// $videoCar = $this->getVideoCar(3511);// delete this

		$where_arr    = array();
		$primaryTitle = $videoCar['year'].' '.$videoCar['make'].' '.$videoCar['model'];
		$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($primaryTitle)."%')";

		if(strstr($videoCar['model'], ' and ')){
			// chrysler town and country model
			$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($videoCar['year'].' '.$videoCar['make'].' '.str_replace(' and ', ' & ', $videoCar['model']))."%')";
		}

		if(strstr($videoCar['model'], '1 Series')){
			// 1 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*1[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], '2 Series')){
			// 2 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*2[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], '3 Series')){
			// 3 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*3[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], '5 Series')){
			// 5 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*5[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], '6 Series')){
			// 6 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*6[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], '7 Series')){
			// 7 Series
			$where_arr[]  = "(title REGEXP '".Phpfox::getLib('database')->escape('.*7[0-9]{2}(i|xi)')."')";
		}

		if(strstr($videoCar['model'], 'Hybrid-Energi')){
			// Ford Fusion Hybrid-Energi
			$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($videoCar['year'].' '.$videoCar['make'].' '.str_replace('Hybrid-Energi', 'Hybrid', $videoCar['model']))."%')";
			$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($videoCar['year'].' '.$videoCar['make'].' '.str_replace('Hybrid-Energi', 'Energi', $videoCar['model']))."%')";
		}

		if(strstr($videoCar['model'], '2500-3500')){
			// Chevrolet Silverado 2500-3500
			$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($videoCar['year'].' '.$videoCar['make'].' '.str_replace('2500-3500', '2500', $videoCar['model']))."%')";
			$where_arr[]  = "(title LIKE '%".Phpfox::getLib('database')->escape($videoCar['year'].' '.$videoCar['make'].' '.str_replace('2500-3500', '3500', $videoCar['model']))."%')";
		}

		$inventories = Phpfox::getLib('database')->select('*')
			->from(Phpfox::getT('ko_dvs_inventory'))
			->where(join(' OR ', $where_arr))
      ->group('link')
			// ->limit(0)
			->execute('getRows');

		return $inventories;
	}
  
	/*phpmasterminds Edited for sort in gallery and footer starts*/
public function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    arsort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
	return $array;
}
public function aaasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    //asort($sorter);
    arsort($sorter);
	
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
	return $array;
}
/*phpmasterminds Edited for sort in gallery and footer starts*/

	public function cleanImages()
	{
		return true;

		$inventories = Phpfox::getLib('database')->select('*')
			->from(Phpfox::getT('ko_dvs_inventory'))
			->limit(500)
			->execute('getRows');

			if($inventories){
				$image_dest_dir  = Phpfox::getParam('core.dir_file');
				foreach ($inventories as $inv) {
		    	if(file_exists($image_dest_dir.$inv['image']) && 0){
		    		$new_path = str_replace('inventory/2014/', 'inventory/2014a/', $inv['image']);
						Phpfox::getLib('file')->copy(Phpfox::getParam('core.path').'file/'.$inv['image'], $image_dest_dir.$new_path);
			    }
	    		$new_path = str_replace('inventory/2014/', 'inventory/2014a/', $inv['image']);
		    	if(!file_exists($image_dest_dir.$new_path && 0)){
		    		var_dump($new_path);
			    }
				}
			}
			return true;
	}

	public function importInventory($dvs_id)
	{
		//global admin cp setting for userGuid and apiKey
    $userGuid  = $this->getSettingValue('dvs_inventory_guid');
    $apiKey    = $this->getSettingValue('dvs_inventory_api_key');
    $connector = $this->getInventoryConnector($dvs_id);
    $dvs       = $this->get($dvs_id);

		$connector['inventory_url'] = str_replace('http://', '', $dvs['inv_domain']);

    if(empty($connector) || empty($connector['guid']) || empty($connector['inventory_url'])){
      return array('error' => 'Connector Error', 'status' => false);
    }

		//Load player data
    $aPlayer            = Phpfox::getService('dvs.player')->get($dvs_id);
    $detailedImportType = false;

    $time_start      = microtime(true);
    $refusedMakes    = array();
    $mcnt            = 0;
    $firstItemLink   = '';
    $lastItemLink    = '';
    $trackingDevMode = (($_COOKIE['dev'] == 1)?true:false);
    // $trackingDevMode = false;

    if(!$detailedImportType){
      if($connector['pagination_type'] == 0){ // is offset
        $paginator = 0;
      }else{ // is page
        $paginator = 1;
      }

      $this->emptyDvsInventories($dvs_id); // purge old entries

      do {
        $result = $this->importInventoryQuery($apiKey, $connector['guid'], array(
          "paginator"       => $paginator,
          "pagination_name" => ($connector['pagination_name']?$connector['pagination_name']:'start'),
        ));
        $carsArr = array_shift($result['results']);
        if($_COOKIE['dev'] == 1){
          // var_dump($firstItemLink);
          // var_dump($lastItemLink);
          // var_dump($carsArr);
          // die();
        }
        if(empty($carsArr[1]['image']['href']) || $firstItemLink == $carsArr[1]['image']['href']){
          if(empty($carsArr[1]['name']['href']) || $firstItemLink == $carsArr[1]['name']['href']){
            break;
          }else{
            $carsarr_first_href = $carsArr[1]['name']['href'];
          }
        }else{
          $carsarr_first_href = $carsArr[1]['image']['href'];
        }

        if(!empty($lastItemLink) && $lastItemLink == $carsarr_first_href){
          break;
        }
        if($connector['pagination_type'] == 0){ // is offset
          if($paginator >= 640) break;
        }else{ // is page
          if($paginator >= 30) break;
        }
        if(empty($firstItemLink) && !empty($carsarr_first_href)){
          $firstItemLink = $carsarr_first_href;
        }
        if(!empty($carsarr_first_href)){
          $lastItemLink = $carsarr_first_href;
        }
        if($_COOKIE['dev'] == 1){
          // var_dump($firstItemLink);
          // var_dump($lastItemLink);
          // var_dump($carsArr);
          // die();
        }
        if(!empty($result)){
          $mcnt += $result['count'];
          $addedCount = $this->addDvsInventories($carsArr, $dvs_id);
          if($connector['pagination_type'] == 0){ // is offset
            $paginator += $addedCount;
          }else{ // is page
            $paginator++;
          }
        }
      }while (!empty($carsArr));

    }else{
  		$aValidVSYears = Phpfox::getService('dvs.video')->getValidVSYears($aPlayer['makes']);

  		if(empty($aValidVSYears)){
  			return array('error' => 'Valid Years Error Setting', 'status' => false);
  		}

  		foreach ($aValidVSYears as $yearValue) {
  			$aValidVSMakes = Phpfox::getService('dvs.video')->getValidVSMakes($yearValue, $aPlayer['makes']);
  			if(!empty($aValidVSMakes)){
  				foreach ($aValidVSMakes as $makeValue) {

  					// check if this make unavailable by this catalogue, checked previously
  					if(in_array($makeValue['make'], $refusedMakes)){
  						continue;
  					}

  					// check if this make unavailable by this catalogue
  					$result = $this->importInventoryQuery($apiKey, $connector['guid'], array(
  						"make"   => $makeValue['make'],
  					));

  					$totalResults = $result->totalResults;
  					
  					$pages = ceil($totalResults / 16);

  					if(empty($result->results)){
  						$refusedMakes[] = $makeValue['make'];
  						continue;
  					}else{
  						// check if this make unavailable by this catalogue for selected year
  						$result = $this->importInventoryQuery($connector['guid'], array(
  							"year"   => $yearValue,
  							"make"   => $makeValue['make'],
  							"domain" => $connector['inventory_url'],
  						), $userGuid, $apiKey, false);
  						if(empty($result->results)){
  							continue;
  						}else{ // full make import, then filter items on render by regular expressoin
  							// echo 'full import success.'."\n";
  							$mcnt += count($result->results);
  							$this->addDvsInventories($result->results, $dvs_id);
  						}
  					}

  					$thinImportMode = null;
  					if($thinImportMode){ // thin import mode - import only certain model car inventory // currently temporary disabled
  						$aVideoSelect = Phpfox::getService('dvs.video')->getVideoSelect($yearValue, $makeValue['make'], '', true);
  						if(!empty($aVideoSelect)){
  							foreach ($aVideoSelect as $videoValue) {
  								$result = $this->importInventoryQuery($connector['guid'], array(
  									"year"   => $videoValue['year'],
  									"make"   => $videoValue['make'],
  									"model"  => $videoValue['model'],
  									"domain" => $connector['inventory_url'],
  								), $userGuid, $apiKey, false);
  								if(!empty($result->results)){
  									$this->addDvsInventories($result->results, $dvs_id, $yearValue);
  								}
  							}
  							$mcnt += count($aValidVSMakes);
  							if($mcnt > 2){
  								break;
  							}
  						}
  					}
  				}
  			}
  		}
    }
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start);
		if($trackingDevMode){
			echo "\n";
			echo 'Total Execution Time: '.$execution_time.' sec'."\n";
			echo 'finaly - '.$mcnt;
      die();
		}

		if(isset($result->error)){
			return array('error' => $result->error, 'status' => false);
		}

    $res = Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs'), array(
			'inv_last_cronjob' => time(),
    ), "dvs_id = '".$dvs_id."'");

		return array('mcnt' => $mcnt, 'status' => true);
	}

  /**
   * Api request to import.io
   */
	function importInventoryQuery($apiKey, $userGuid, $params) {

    $request = "http://www.kimonolabs.com/api/{$userGuid}?apikey={$apiKey}";

    if(!empty($params['year'])){
      $request .= "&year=".$params['year'];
    }
    if(!empty($params['make'])){
      $request .= "&make=".$params['make'];
    }
    if(!empty($params['model'])){
      $request .= "&model=".$params['model'];
    }
    if(!empty($params['paginator']) && !empty($params['pagination_name'])){
      $request .= "&".$params['pagination_name']."=".$params['paginator'];
    }

    $response = file_get_contents($request);

    if(json_decode($response, TRUE) == NULL){
      sleep(2);
      $response = file_get_contents($request);
    }

    return json_decode($response, TRUE);

	}

  /**
   * Add multiple dvs invenotry.
   */
  public function addDvsInventories($inventories= array(), $dvs_id = 0, $yearValue = null)
  {
    if(empty($inventories) || empty($dvs_id)){
      return false;
    }

    $res = 0;

    foreach ($inventories as $item) {
      if(empty($item['name'])) continue;

      if($this->addDvsInventory($item, $dvs_id, $yearValue)){
        $res++;
      }
    }

    return $res;
  }

  /**
   * Add multiple dvs invenotry.
   */
  public function emptyDvsInventories($dvs_id = 0)
  {
		if(empty($dvs_id)){
			return false;
		}

    $items = Phpfox::getLib('database')->select('inv.*')
      ->from(Phpfox::getT('ko_dvs_inventory'), 'inv')
      ->where('dvs_id = ' . (int) $dvs_id)
      ->execute('getRows');

		foreach ($items as $item) {
      if(file_exists(Phpfox::getParam('core.dir_file').$item['image'])){
        Phpfox::getLib('file')->unlink(Phpfox::getParam('core.dir_file').$item['image']);
      }
		}

    $this->database()->delete(Phpfox::getT('ko_dvs_inventory'), 'dvs_id = ' . (int) $dvs_id);

    return true;
  }

  /**
   * Add dvs invenotry. if exists - update
   */
  public function addDvsInventory($inventory = array(), $dvs_id = 0, $yearValue = null)
  {
		if(empty($inventory) || empty($inventory['name'])){
			return false;
		}

    if(empty($yearValue)){
    	$invTitleArr = explode(' ', $inventory['name']['text']);
    	$invTitleArrCpy = array_values($invTitleArr);
    	$firstInvItem = array_shift($invTitleArrCpy);
      $yearValue = intval($firstInvItem);
      if(empty($yearValue)){
        $yearValue = date('Y');
      }
    }

		$prev_inventory  = $this->getInventoryItem($inventory, $dvs_id);
		
		$image_dest_dir  = Phpfox::getParam('core.dir_file').'static/inventory/';
		// build server dir structure
		if (!is_dir($image_dest_dir))
		{
			@mkdir($image_dest_dir, 0777);
			@chmod($image_dest_dir, 0777);
		}

		$image_dest_dir .= ($yearValue == null?date('Y'):$yearValue).'/';
		if (!is_dir($image_dest_dir))
		{
			@mkdir($image_dest_dir, 0777);
			@chmod($image_dest_dir, 0777);
		}

    if(!empty($prev_inventory)){ // delete old image
    	if(file_exists(Phpfox::getParam('core.dir_file').$prev_inventory['image'])){
	    	Phpfox::getLib('file')->unlink(Phpfox::getParam('core.dir_file').$prev_inventory['image']);
    	}
    }

		$matches = array();
		preg_match_all('/([a-zA-Z0-9]*)\.(jpg|gif|jpeg|png)$/im', strtolower($inventory['image']['src']), $matches);
		$image_full_name = $matches[0][0];
		$image_name      = $matches[1][0];
		$image_ext       = $matches[2][0];

		$dest_image_name = $image_name.'_'.uniqid().'.'.$image_ext;
		$dest_image      = $image_dest_dir.$dest_image_name;
		
		$uploaded_image_res  = Phpfox::getLib('file')->copy($inventory['image']['src'], $dest_image);
		if(is_array($inventory['price'])){
			$invPriceValues  = array_values($inventory['price']);
			$inventory_price = array_shift($invPriceValues);
		}else{
			$inventory_price = $inventory['price'];
		}

    if(!empty($inventory['name']) && is_string($inventory['name'])){
      $inventory_name = trim(preg_replace('/\s+/', ' ', $inventory['name']));
    }elseif(!empty($inventory['name']['text']) && is_string($inventory['name']['text'])){
      $inventory_name = trim(preg_replace('/\s+/', ' ', $inventory['name']['text']));
    }else{
      $inventory_name = '';
    }
    $inventory_name = str_replace('\n', ' ', $inventory_name);

    if(!empty($inventory['image']['href']) && is_string($inventory['image']['href'])){
      $inventory_href = $inventory['image']['href'];
    }elseif(!empty($inventory['name']['href']) && is_string($inventory['name']['href'])){
      $inventory_href = $inventory['name']['href'];
    }else{
      $inventory_href = '';
    }

    if(!empty($prev_inventory)){
      $res = Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_inventory'), array(
				'title'         => Phpfox::getLib('database')->escape($inventory_name),
				'image'         => 'static/inventory/'.($yearValue == null?date('Y'):$yearValue).'/'.$dest_image_name,
				'price'         => Phpfox::getLib('database')->escape($inventory_price),
				'color'         => Phpfox::getLib('database')->escape($inventory['color']),
				'link'          => Phpfox::getLib('database')->escape($inventory_href),
				'modified_date' => time(),
      ), "inventory_id = '".$prev_inventory['inventory_id']."'");
    }else{
      $res = Phpfox::getLib('database')->insert(Phpfox::getT('ko_dvs_inventory'), array(
				'dvs_id'        => $dvs_id,
				'title'         => Phpfox::getLib('database')->escape($inventory_name),
				'image'         => 'static/inventory/'.($yearValue == null?date('Y'):$yearValue).'/'.$dest_image_name,
				'price'         => Phpfox::getLib('database')->escape($inventory_price),
				'color'         => Phpfox::getLib('database')->escape($inventory['color']),
				'link'          => Phpfox::getLib('database')->escape($inventory_href),
				'creation_date' => time(),
				'modified_date' => time(),
        )
      );
    }

    return $res;
  }

  /**
   * Get single inventory item
   */
  public function getScheduledInventory()
  {

    $dvsRows = Phpfox::getLib('database')->select('*')
      ->from(Phpfox::getT('ko_dvs'))
      ->where("(inv_display_status = '1') AND (FROM_UNIXTIME(inv_last_cronjob) < (NOW() - INTERVAL inv_schedule_hours HOUR))")
      ->limit(50)
      ->execute('getRows');

    return $dvsRows;

      // 13-05-2014 - 1399939200
      // 16-05-2014 - 1400255613
  }

  /**
   * Get single inventory item
   */
  public function getInventoryItem($inventory = null, $dvs_id = 0)
  {
  	if(empty($inventory) || empty($dvs_id)){
  		return false;
  	}

    if(is_array($inventory['price'])){
      $invPriceValues  = array_values($inventory['price']);
      $inventory_price = array_shift($invPriceValues);
    }else{
      $inventory_price = $inventory['price'];
    }

    if(!empty($inventory['name']) && is_string($inventory['name'])){
      $inventory_name = trim(preg_replace('/\s+/', ' ', $inventory['name']));
    }elseif(!empty($inventory['name']['text']) && is_string($inventory['name']['text'])){
      $inventory_name = trim(preg_replace('/\s+/', ' ', $inventory['name']['text']));
    }else{
      $inventory_name = '';
    }

    if(!empty($inventory['image']['href']) && is_string($inventory['image']['href'])){
      $inventory_href = $inventory['image']['href'];
    }elseif(!empty($inventory['name']['href']) && is_string($inventory['name']['href'])){
      $inventory_href = $inventory['name']['href'];
    }else{
      $inventory_href = '';
    }

    $dvsRow = Phpfox::getLib('database')->select('*')
      ->from(Phpfox::getT('ko_dvs'))
      ->where("(dvs_id = '".Phpfox::getLib('database')->escape($dvs_id)."')")
      ->limit(1)
      ->execute('getRow');

  	$where_arr[] = "(dvs.inv_feed_type = '".Phpfox::getLib('database')->escape($dvsRow['inv_feed_type'])."')";
    $where_arr[] = "(inv.link = '".Phpfox::getLib('database')->escape($inventory_href)."')";
    $extended_search_list = null;
    if($extended_search_list){
    	$where_arr[] = "(inv.title = '".Phpfox::getLib('database')->escape($inventory_name)."')";
    	$where_arr[] = "(inv.color = '".Phpfox::getLib('database')->escape($inventory['color'])."')";
	  	$where_arr[] = "(inv.price = '".Phpfox::getLib('database')->escape($inventory_price)."')";
  	}

    $value = Phpfox::getLib('database')->select('inv.*')
      ->from(Phpfox::getT('ko_dvs_inventory'), 'inv')
			->leftjoin(Phpfox::getT('ko_dvs'), 'dvs', 'inv.dvs_id = dvs.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_inventory_connectors'), 'ic', 'ic.connector_id = dvs.inv_feed_type')
      ->where(join(' AND ', $where_arr))
      ->execute('getRow');

    return (!empty($value)?$value:null);
  }

  /**
   * Get video car item
   */
  public function getVideoCar($ko_id = 0)
  {
    $value = Phpfox::getLib('database')->select('*')
      ->from(Phpfox::getT('ko_brightcove'))
      ->where("ko_id = '".Phpfox::getLib('database')->escape($ko_id)."'")
      ->execute('getRow');

    return $value;
  }

  /**
   * Get inventory settings
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
   * Get dvs inventory connector
   */
  public function getInventoryConnector($dvs_id = 0)
  {
		$connector = $this->database()
			->select('d.inventory_url, ic.*')
			->from($this->_sTable, 'd')
			->leftjoin(Phpfox::getT('ko_dvs_inventory_connectors'), 'ic', 'ic.connector_id = d.inv_feed_type')
			->where("(d.inv_display_status = '1') AND (d.inv_display_status = '1') AND (d.dvs_id = '".$dvs_id."')")
			->limit(1)
			->execute('getRow');

    return $connector;
  }

	public function getConnectors()
	{
    $values = Phpfox::getLib('database')->select('*')
      ->from(Phpfox::getT('ko_dvs_inventory_connectors'))
      ->order('connector_id DESC')
      ->limit(1000)
      ->execute('getRows');

    return $values;
	}

	public function listDvss($iPage, $iPageSize, $iUserId, $bPaginate = true, $bGetAll = false)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$iUserId = (int) $iUserId;
        $sWhere = '1';
	    if ($iUserId && !$bGetAll) {
            $sWhere .= ' AND d.user_id =' . $iUserId;
            $aIsManagerDvs = Phpfox::getService('dvs.manager')->getAllDvs($iUserId);

            if(count($aIsManagerDvs)) {
                $sWhere .= ' OR d.dvs_id IN (' . implode(',', $aIsManagerDvs) . ')';
            }
        }

		if ($bPaginate) {
			$iCnt = $this->database()->select('COUNT(*)')
				->from($this->_sTable, 'd')
                ->where($sWhere)
				->execute('getField');

			$this->database()->limit($iPage, $iPageSize, $iCnt);
		}

		$aDvss = $this->database()
			->select('d.*, t.text, s.branding_file_id, s.background_file_id, s.menu_background, s.menu_link, s.page_background, s.page_text, s.button_background, s.button_text, s.button_top_gradient, s.button_bottom_gradient, s.button_border, s.text_link, s.footer_link, cc.name as state_string, ' . Phpfox::getUserField())
			->from($this->_sTable, 'd')
			->leftjoin(Phpfox::getT('country_child'), 'cc', 'cc.child_id = d.country_child_id')
			->leftjoin(Phpfox::getT('ko_dvs_text'), 't', 't.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_style'), 's', 's.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_players'), 'p', 'p.dvs_id = d.dvs_id')
			//->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = d.user_id')
            ->where($sWhere)
			->execute('getRows');

        foreach($aDvss as $iKey => $aDvs) {
            if(isset($aDvs['dealer_id']) && ($aDvs['dealer_id'])) {
                $aDvss[$iKey]['dealer_id'] = @unserialize($aDvs['dealer_id']);
                if(!is_array($aDvss[$iKey]['dealer_id'])) {
                    $aDvss[$iKey]['dealer_id'] = array();
                }
            }
        }

		if ($bPaginate)
		{
			return array($aDvss, $iCnt);
		}
		else
		{
			return $aDvss;
		}
	}


	public function getTitleUrl($sDvsName, $iDvsId = 0)
	{
		$sDvsName = preg_replace("/[^A-Za-z0-9 ]/", "", $sDvsName);

		return $this->preParse()->prepareTitle('dvs', $sDvsName, 'title_url', null, $this->_sTable, ($iDvsId ? 'title_url LIKE "%' . $this->preParse()->clean($sDvsName) . '%" AND dvs_id !=' . (int) $iDvsId : null), false, false);
	}


	public function get($mDvs, $bUseTitle = false)
	{
		if (!$mDvs)
		{
			return array();
		}

		if ($bUseTitle)
		{
			$this->database()->where('d.title_url = "' . $this->preParse()->clean($mDvs) . '"');
		}
		else
		{
			$this->database()->where('d.dvs_id = ' . (int) $mDvs);
		}

		$aDvs = $this->database()
			->select('cc.name as state_string, t.*, s.*, b.*, bg.*, p.*, pr.*, bv.*, ' . Phpfox::getUserField('u', 'dealer_user_') . ', d.*')
			->from($this->_sTable, 'd')
			->leftjoin(Phpfox::getT('country_child'), 'cc', 'cc.child_id = d.country_child_id')
			->leftjoin(Phpfox::getT('ko_dvs_text'), 't', 't.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_style'), 's', 's.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
            ->leftjoin(Phpfox::getT('tbd_dvs_vdp_files'), 'bv', 'bv.vdp_id = s.vdp_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_players'), 'p', 'p.dvs_id = d.dvs_id')
			//->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = d.user_id')
			->execute('getRow');

        if(isset($aDvs['font_family_id'])) {
            $aDvs['font_family'] = Phpfox::getService('dvs.style')->getFontFamily($aDvs['font_family_id']);
        }

        if(isset($aDvs['dealer_id']) && ($aDvs['dealer_id'])) {
            $aDvs['dealer_id'] = @unserialize($aDvs['dealer_id']);
            if(!is_array($aDvs['dealer_id'])) {
                $aDvs['dealer_id'] = array();
            }
        }


		return $aDvs;
	}


	public function geoCode($sAddress, $bRecursion = true)
	{
		$sAddress = utf8_encode($sAddress);

		// output
		$aOutput = array();

        $sRequestUrl = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false" . "&address=" . urlencode($sAddress);

        $oXml = file_get_contents($sRequestUrl);
        $oXml = json_decode($oXml, true);

        $sStatusCode = (string) $oXml['status'];

        if (strcmp($sStatusCode, "OK") == 0)
        {
            $aOutput['latitude'] = (string) $oXml['results'][0]['geometry']['location']['lat'];
            $aOutput['longitude'] = (string) $oXml['results'][0]['geometry']['location']['lng'];
        }
		else if (strcmp($sStatusCode, "620") == 0)
		{
			if ($bRecursion === true)
			{
				sleep(1);
				$aOutput = $this->geoCode($sAddress, false);
			}
		}
		else
		{
			// failure to geocode
		}

		if (!empty($aOutput['latitude']) && !empty($aOutput['longitude']))
		{
			$aOutput['success'] = true;
		}
		else
		{
			$aOutput['success'] = false;
		}

		return $aOutput;
	}


	public function makeAddress($iCountryChildId, $sCityLocation, $sZipCode, $sStreetAddress)
	{
		$oCountry = Phpfox::getService('core.country');
		$oParseOutput = Phpfox::getLib('parse.output');
		$aAddress = array();

		if (!empty($sStreetAddress))
		{
			$aAddress['address'] = $oParseOutput->clean($sStreetAddress);
		}

		if (!empty($sCityLocation))
		{
			$aAddress['city'] = $oParseOutput->clean($sCityLocation);
		}

		if (!empty($iCountryChildId) && $iCountryChildId > 0)
		{
			$aAddress['country_child'] = $oCountry->getChild($iCountryChildId);
		}

		if (!empty($sZipCode))
		{
			$aAddress['postal_code'] = $sZipCode;
		}

		return implode(', ', $aAddress);
	}

	public function getinvCss($aDvs)
	{
	
		return $this->buildCss('#overview_inventory li .view_details a', array(
		'color' => '#' . $aDvs['text_link']
		), true);

	}
	public function getCss($aDvs, $bSubdomainMode)
	{

		$sCss = $this->buildCss('body', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['page_background'] . ' !important',
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('h1', array(
			'color' => '#' . $aDvs['page_text']
		));
		//added 7/23 by Collin
		$sCss .= $this->buildCss('#sharelink-access a', array(
			'color' => '#' . $aDvs['text_link']
		));
		
		$sCss .= $this->buildCss('#dealer-links', array(
			'color' => '#' . $aDvs['page_text']
		));
		
		$sCss .= $this->buildCss('.inventory_info_message a', array(
			'color' => '#' . $aDvs['text_link']
		));
		
		//added 3/21 by Collin
		$sCss .= $this->buildCss('h2', array(
			'color' => '#' . $aDvs['page_text']
		));
		
		$sCss .= $this->buildCss('h3', array(
			'color' => '#' . $aDvs['page_text']
		));
		
		$sCss .= $this->buildCss('.dvs-info', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('#dvs_branding_container h1', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['page_background'],
			'color' => '#' . $aDvs['page_text']
			), true);

		if (!$aDvs['background_opacity'])
		{
			$aDvs['background_opacity'] = 1;
		}


		// The following addition can come out when the dvs_background div is removed from the desktop template
		$sCss .= $this->buildCss('#dvs_background', array(
			'background' => '#' . $aDvs['page_background'] . ($aDvs['background_file_name'] ? ' url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')' : ''),
			'opacity' => $aDvs['background_opacity'],
			'filter' => 'alpha(opacity=' . ($aDvs['background_opacity'] * 100) . ')'
		));

		$sCss .= $this->buildCss('.dvs_background', array(
			'background' => '#' . $aDvs['page_background'] . ' url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')'
		));

		if ($aDvs['background_file_name'])
		{
			$sCss .= $this->buildCss('.dvs_background_image', array(
				'background' => 'url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')',
				'opacity' => $aDvs['background_opacity'],
				'filter' => 'alpha(opacity=' . ($aDvs['background_opacity'] * 100) . ')'
			));
		}

		$sCss .= $this->buildCss('#dvs_menu_container', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['menu_background']
		));

		$sCss .= $this->buildCss('#dvs_menu_container a', array(
			'color' => '#' . $aDvs['menu_link']
			), true);

		$sCss .= $this->buildCss('#dvs_dealer_info a', array(
			'color' => '#' . $aDvs['text_link']
			), true);

		$sCss .= $this->buildCss('.text_expander_links', array(
			'color' => '#' . $aDvs['text_link']
		));

		$sCss .= $this->buildCss('.text_expander_links:hover', array(
			'color' => '#' . $aDvs['text_link']
		));

		$sCss .= $this->buildCss('#dvs_vehicle_select_container', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('#dvs_video_information a', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('.dvs_c2a_button', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_top_gradient'] . '), color-stop(1, #' . $aDvs['button_bottom_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_top_gradient'] . ', #' . $aDvs['button_bottom_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_top_gradient'] . ' 5%, #' . $aDvs['button_bottom_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_top_gradient'] . '\', endColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_top_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('.dvs_c2a_button:hover', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_bottom_gradient'] . '), color-stop(1, #' . $aDvs['button_top_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_bottom_gradient'] . ', #' . $aDvs['button_top_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_bottom_gradient'] . ' 5%, #' . $aDvs['button_top_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\', endColorstr=\'#' . $aDvs['button_top_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_bottom_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('#dvs_footer_container', array(
			'color' => '#' . $aDvs['footer_link']
		));

		$sCss .= $this->buildCss('.dvs_footer_link', array(
			'color' => '#' . $aDvs['footer_link']
			), false, true);

		$sCss .= $this->buildCss('.dvs_footer_link:hover', array(
			'color' => '#' . $aDvs['footer_link']
		));

		$sCss .= $this->buildCss('.dvs_footer_info a', array(
			'color' => '#' . $aDvs['footer_link']
			), false, true);

		$sCss .= $this->buildCss('.dvs_footer_info a:hover', array(
			'color' => '#' . $aDvs['footer_link']
		));

		//contact-form buttons
		$sCss .= $this->buildCss('.dvs_form_button', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_top_gradient'] . '), color-stop(1, #' . $aDvs['button_bottom_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_top_gradient'] . ', #' . $aDvs['button_bottom_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_top_gradient'] . ' 5%, #' . $aDvs['button_bottom_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_top_gradient'] . '\', endColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_top_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('.dvs_form_button:hover', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_bottom_gradient'] . '), color-stop(1, #' . $aDvs['button_top_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_bottom_gradient'] . ', #' . $aDvs['button_top_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_bottom_gradient'] . ' 5%, #' . $aDvs['button_top_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\', endColorstr=\'#' . $aDvs['button_top_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_bottom_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		return $sCss;
	}


	public function buildCss($sSelector, $aDeclarations, $bContextual = false, $bEnd = false)
	{
		$sCss = $sSelector . ($bContextual ? '' : ' ') . '{' . "\n";

		foreach ($aDeclarations as $sProperty => $sValue)
		{
			$sCss .= "\t" . $sProperty . ': ' . $sValue . ';' . "\n";
		}

		$sCss .= '}' . ($bEnd ? '' : "\n\n");

		return $sCss;
	}


	public function getCname()
	{
		$aUrl = explode('.', $_SERVER['SERVER_NAME']);

		if ($aUrl[0] == 'www' || $aUrl[0] == 'dvs' || $aUrl[0] == 'idrive')
		{
			return false;
		}

		$aDvs = $this->get($aUrl[0], true);

		return (isset($aDvs['title_url']) ? $aDvs['title_url'] : false);
	}


	public function hasAccess($iId, $iUserId, $sIdSource = '')
	{
		if (Phpfox::isAdmin())
		{
			return true;
		}

		if (!$iId || !$iUserId)
		{
			return false;
		}

		if ($sIdSource == '')
		{
			$aDvs = $this->get($iId, false);

			if ($aDvs['user_id'] == $iUserId)
			{
				return true;
			}

            if (Phpfox::getService('dvs.manager')->get($iUserId, $iId)) {
                return true;
            }
		}

		if ($sIdSource == 'branding')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_branding_files'))
				->where('branding_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'background')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_background_files'))
				->where('background_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

        if ($sIdSource == 'vdp') {
            $iOwnerId = $this->database()
                ->select('user_id')
                ->from(Phpfox::getT('tbd_dvs_vdp_files'))
                ->where('vdp_id = ' . (int) $iId)
                ->execute('getField');

            if ($iOwnerId == $iUserId) {
                return true;
            }
        }

		if ($sIdSource == 'logo')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_logo_files'))
				->where('logo_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'preroll')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_preroll_files'))
				->where('preroll_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}
		return false;
	}


	public function getBrowser() {
        return 'mobile';
        $this->_bIsMobile = false;
        $detect = new Mobile_Detect;
        if ($detect->isTablet()) {
            return 'ipad';
        } else {
            if ($detect->isMobile()) {
                $this->_bIsMobile = true;
                return 'mobile';
            }
        }

        return 'desktop';
	}
}

?>