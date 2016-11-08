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
class Dvs_Component_Controller_Index extends Phpfox_Component {
    public function process() {
        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $sDvsRequest = $this->request()->get(($bSubdomainMode ? 'req1' : 'req2'));
        if (($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'iframe')
            && ($this->request()->get(($bSubdomainMode ? 'req3' : 'req4')) == 'cdk')) {
            $sDvsRequest = Phpfox::getService('dvs')->getTitleByCdk($sDvsRequest);
        }
        if ($aDvs = Phpfox::getService('dvs')->get($sDvsRequest, true)) {
            if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'sitemap') {
                return Phpfox::getLib('module')->setController('dvs.dvs-sitemap');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'share') {
                return Phpfox::getLib('module')->setController('dvs.share');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'gallery') {
                return Phpfox::getLib('module')->setController('dvs.gallery');
            } else if ($this->request()->get($bSubdomainMode ? 'req3' : 'req4') == 'player') {
                return Phpfox::getLib('module')->setController('dvs.player.player');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'iframe') {
                if ($this->request()->get(($bSubdomainMode ? 'req3' : 'req4')) == 'cdk') {
                    return Phpfox::getLib('module')->setController('dvs.cdk-iframe');
                }
                return Phpfox::getLib('module')->setController('dvs.iframe');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'inventory-player') {
                return Phpfox::getLib('module')->setController('dvs.inventory-player');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'dvs-vdp-iframe') {
                return Phpfox::getLib('module')->setController('dvs.dvs-vdp-iframe');
            } else {
                return Phpfox::getLib('module')->setController('dvs.view');
            }
        } else {
            $aShortUrl = Phpfox::getService('dvs.shorturl')->get($sDvsRequest);

            // Even with ShortURL mode on, the short url should come in as req2
            if (!empty($aShortUrl)) {
                $aShortUrl = Phpfox::getService('dvs.shorturl')->get($this->request()->get('req2'));
            }

            if (!empty($aShortUrl)) {
                return Phpfox::getLib('module')->setController('dvs.view');
            }
        }

        // Load the index if the user has access to this DVS
        // Make sure user
        if (!Phpfox::isUser()) {
            $this->url()->send('');
            return false;
        }

        $sMessage = '';

        if ($aVals = $this->request()->getArray('val')) {
            if ($aVals['step'] == 'settings') {
                if ($aVals['country_child_id'] == 0) {
                    $aVals['country_child_id'] = '';
                }

                $aValidation = array(
                    'dealer_name' => Phpfox::getPhrase('dvs.please_enter_a_dealer_name'),
                    'dvs_name' => Phpfox::getPhrase('dvs.please_enter_a_showroom_name'),
                    'address' => Phpfox::getPhrase('dvs.please_enter_an_address'),
                    'city' => Phpfox::getPhrase('dvs.please_enter_a_city'),
                    'country_child_id' => Phpfox::getPhrase('dvs.please_select_a_state')
                );

                $oValid = Phpfox::getLib('validator')->set(array(
                    'sFormName' => 'add_dvs',
                    'aParams' => $aValidation
                ));

                if ($oValid->isValid($aVals)) {

                    if (strlen($aVals['welcome']) > Phpfox::getParam('dvs.welcome_greeting_max_chars')) {
                        $aVals['welcome'] = substr($aVals['welcome'], 0, Phpfox::getParam('dvs.welcome_greeting_max_chars'));
                    }

                    if (isset($aVals['dvs_id']) && $aVals['dvs_id']) {

                        Phpfox::getService('dvs.process')->update($aVals);						Phpfox::getService('dvs.override.process')->addUpdateRemove($aVals['dvs_id'], $aVals['phrase_overrides']);
                        $sMessage = Phpfox::getPhrase('dvs.settings_saved_successfully');
                    } else {

                        $iId = Phpfox::getService('dvs.process')->add($aVals);
                        Phpfox::getService('dvs.override.process')->addUpdateRemove($iId, $aVals['phrase_overrides']);

                        $this->url()->send('dvs.customize', array('id' => $iId));
                    }
                } else {

                    //Validation failed, reload all JS and pass aVals back to contrller as aForms. We need to load the dvs JS for preview.
                    Phpfox::getLib('module')->setController('dvs.settings');

                    $this->template()->assign(array(
                        'aForms' => $aVals,
                        'bCanAddDvss' => true,
                        'bIsEdit' => true
                    ))
                        ->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
                        ->setBreadcrumb(Phpfox::getPhrase('dvs.edit_dealer_video_showroom'));
                }
            }
            else if ($aVals['step'] == 'customize') {
                if ($aVals['is_edit']) {
                    Phpfox::getService('dvs.style.process')->update($aVals);
                    $sMessage = Phpfox::getPhrase('dvs.customization_saved_successfully');
                } else {
                    Phpfox::getService('dvs.style.process')->add($aVals);

                    $this->url()->send('dvs.player.add', array('id' => $aVals['dvs_id']), null);
                }
            }
        }

        $aMakes = Phpfox::getService('dvs.video')->getMakes();
        $aCustomMakeDataFilter = array(
            array(
                'link' => '',
                'phrase' => ($this->request()->get('make') ? 'All Makes' : ' - Make - ')
            )
        );
        foreach($aMakes as $aMake) {
            $aCustomMakeDataFilter[] = array(
                'link' => str_replace(' ', '-', $aMake['make']),
                'phrase' => $aMake['make']
            );
        }


        $this->search()->set(array(
                'type' => 'dvs',
                'field' => 'dvs.dvs_id',
                'search_tool' => array(
                    'table_alias' => 'dvs',
                    'search' => array(
                        'action' => $this->url()->makeUrl('dvs', array('view' => $this->request()->get('view'))),
                        'default_value' => 'Search by Dealership',
                        'name' => 'search',
                        'field' => array('dvs.dealer_name')
                    ),
                    'sort' => array(
                        'ascending' => array(
                            0 => 'dvs.dealer_name',
                            1 => 'Ascending',
                            2 => 'ASC',
                            'default_sort_order' => 'ASC'
                        ),
                        'descending' => array('dvs.dealer_name', 'Descending', 'DESC')
                    ),
                    'show' => array(20, 50, 100),
                    'custom_filters' => array(
                        ' -Active- ' => array(
                            'param' => 'active',
                            'default_phrase' => ' - Any - ',
                            'data' => array(
                                array('link' => '', 'phrase' => ($this->request()->get('active') ? 'Any' : ' - Any - ')),
                                array('link' => 'active', 'phrase' => 'Active'),
                                array('link' => 'inactive', 'phrase' => 'Inactive'),
                            )
                        ),

                        ' -Make- ' => array(
                            'param' => 'make',
                            'default_phrase' => ' Any Make ',
                            'data' => $aCustomMakeDataFilter
                        )
                    )
                )
            )
        );

        $aBrowseParams = array(
            'module_id' => 'dvs',
            'alias' => 'dvs',
            'field' => 'dvs_id',
            'table' => Phpfox::getT('ko_dvs')
        );

        $sActive = $this->request()->get('active');
        switch ($sActive) {
            case 'active':
                Phpfox::isUser(true);
                $this->search()->setCondition('AND dvs.is_active = 1');
                break;
            case 'inactive':
                Phpfox::isUser(true);
                $this->search()->setCondition('AND dvs.is_active = 0');
                break;
        }

        $sMake = $this->request()->get('make');
        if($sMake != '') {
            $this->search()->setCondition('AND dmake.pmake_id > 0');
        }

        if(!Phpfox::getUserParam('dvs.can_view_other_dvs')) {
            $iUserId = Phpfox::getUserId();
            $sWhere = ' AND (dvs.user_id = ' . $iUserId;
            $aIsManagerDvs = Phpfox::getService('dvs.manager')->getAllDvs($iUserId);
            if(count($aIsManagerDvs)) {
                $sWhere .= ' OR dvs.dvs_id IN (' . implode(',', $aIsManagerDvs) . ')';
            }
            $sWhere .= ')';

            $this->search()->setCondition($sWhere);
        }

        $this->search()->browse()->params($aBrowseParams)->execute();

        $aDvss = $this->search()->browse()->getRows();
        $iCnt = $this->search()->browse()->getCount();

        Phpfox::getLib('pager')->set(array('page' => $this->search()->getPage(), 'size' => $this->search()->getDisplay(), 'count' => $iCnt));

        /*$iPage = $this->request()->getInt('page');
		$iPageSize = 20;
		list($aDvss, $iCnt) = Phpfox::getService('dvs')->listDvss($iPage, $iPageSize, Phpfox::getUserId(), true, Phpfox::getUserParam('dvs.can_view_other_dvs'));

        Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));*/
        
        $stCorePath = str_replace('https:','',Phpfox::getParam('core.path'));
        $stCorePath = str_replace('http:','',$stCorePath);
        
        
        if ($iCnt < Phpfox::getUserParam('dvs.dvss')) {
            $bCanAddDvss = true;
        } else {
            $bCanAddDvss = false;
        }                                 
        

        $this->template()->assign(array(
            'sMessage' => $sMessage,
            'aDvss' => $aDvss,
            'bCanAddDvss' => $bCanAddDvss,
            'bSubdomainMode' => $bSubdomainMode,
            'sCorePath' => Phpfox::getParam('core.path'),
            'stCorePath' => $stCorePath,
            'urll' => $_SERVER['SERVER_NAME'] 
        ))
            ->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'))
            ->setHeader('cache', array(
                'pager.css' => 'style_css',
                'activity.css' => 'module_dvs',
                'activity.js' => 'module_dvs',
                'index.css' => 'module_dvs'
            ));


    }

}

?>