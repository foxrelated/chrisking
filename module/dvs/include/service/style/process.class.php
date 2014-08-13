<?php

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
class Dvs_Service_Style_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_style');
	}


	public function add($aDvs)
	{
        $aSql = array(
            'dvs_id' => (int) $aDvs['dvs_id'],
            'branding_file_id' => (int) $aDvs['branding_file_id'],
            'background_file_id' => (int) $aDvs['background_file_id'],
            'background_opacity' => $this->preParse()->clean($aDvs['background_opacity']),
            'background_repeat_type' => $this->preParse()->clean($aDvs['background_repeat_type']),
            'background_attachment_type' => $this->preParse()->clean($aDvs['background_attachment_type'])
        );

        if(Phpfox::isAdmin()) {
            $aSql['font_family_id'] = (int)$aDvs['font_family_id'];
            $aSql['menu_background'] = $this->preParse()->clean($aDvs['menu_background'], 6);
            $aSql['menu_link'] = $this->preParse()->clean($aDvs['menu_link'], 6);
            $aSql['page_background'] = $this->preParse()->clean($aDvs['page_background'], 6);
            $aSql['page_text'] = $this->preParse()->clean($aDvs['page_text'], 6);
            $aSql['button_background'] = $this->preParse()->clean($aDvs['button_background'], 6);
            $aSql['button_text'] = $this->preParse()->clean($aDvs['button_text'], 6);
            $aSql['button_top_gradient'] = $this->preParse()->clean($aDvs['button_top_gradient'], 6);
            $aSql['button_bottom_gradient'] = $this->preParse()->clean($aDvs['button_bottom_gradient'], 6);
            $aSql['button_border'] = $this->preParse()->clean($aDvs['button_border'], 6);
            $aSql['text_link'] = $this->preParse()->clean($aDvs['text_link'], 6);
            $aSql['footer_link'] = $this->preParse()->clean($aDvs['footer_link'], 6);
            $aSql['iframe_background'] = $this->preParse()->clean($aDvs['iframe_background'], 6);
            $aSql['iframe_text'] = $this->preParse()->clean($aDvs['iframe_text'], 6);
            $aSql['iframe_contact_background'] = $this->preParse()->clean($aDvs['iframe_contact_background'], 6);
            $aSql['iframe_contact_text'] = $this->preParse()->clean($aDvs['iframe_contact_text'], 6);
        }

		$this->database()->insert($this->_sTable, $aSql);
	}


	public function update($aDvs)
	{
        $aSql = array(
            'branding_file_id' => (int) $aDvs['branding_file_id'],
            'background_file_id' => (int) $aDvs['background_file_id'],
            'background_opacity' => $this->preParse()->clean($aDvs['background_opacity']),
            'background_repeat_type' => $this->preParse()->clean($aDvs['background_repeat_type']),
            'background_attachment_type' => $this->preParse()->clean($aDvs['background_attachment_type'])
        );

        if(Phpfox::isAdmin()) {
            $aSql['font_family_id'] = (int)$aDvs['font_family_id'];
            $aSql['menu_background'] = $this->preParse()->clean($aDvs['menu_background'], 6);
            $aSql['menu_link'] = $this->preParse()->clean($aDvs['menu_link'], 6);
            $aSql['page_background'] = $this->preParse()->clean($aDvs['page_background'], 6);
            $aSql['page_text'] = $this->preParse()->clean($aDvs['page_text'], 6);
            $aSql['button_background'] = $this->preParse()->clean($aDvs['button_background'], 6);
            $aSql['button_text'] = $this->preParse()->clean($aDvs['button_text'], 6);
            $aSql['button_top_gradient'] = $this->preParse()->clean($aDvs['button_top_gradient'], 6);
            $aSql['button_bottom_gradient'] = $this->preParse()->clean($aDvs['button_bottom_gradient'], 6);
            $aSql['button_border'] = $this->preParse()->clean($aDvs['button_border'], 6);
            $aSql['text_link'] = $this->preParse()->clean($aDvs['text_link'], 6);
            $aSql['footer_link'] = $this->preParse()->clean($aDvs['footer_link'], 6);
            $aSql['iframe_background'] = $this->preParse()->clean($aDvs['iframe_background'], 6);
            $aSql['iframe_text'] = $this->preParse()->clean($aDvs['iframe_text'], 6);
            $aSql['iframe_contact_background'] = $this->preParse()->clean($aDvs['iframe_contact_background'], 6);
            $aSql['iframe_contact_text'] = $this->preParse()->clean($aDvs['iframe_contact_text'], 6);
        }

		$this->database()->update($this->_sTable, $aSql, 'dvs_id = ' . (int) $aDvs['dvs_id']);
	}


	public function remove($iDvsId)
	{
		$this->database()->delete($this->_sTable, 'dvs_id = ' . (int) $iDvsId);
	}


}

?>