<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox_Component
 * @version 		$Id: add.class.php 3402 2011-11-01 09:07:31Z Miguel_Espinoza $
 */
class DVSTour_Component_Controller_Admincp_Add extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$bIsEdit = false;
		$bIsStep = false;
		if (($iEditId = $this->request()->getInt('id')))
		{
			$aRow = Phpfox::getService('dvstour')->getTour($iEditId);
            $aUserGroup = Phpfox::getService('user.group')->getForEdit();
			$bIsEdit = true;
			$this->template()->assign(array(			
					'aForms' => $aRow,
					'iEditId' => $iEditId,
                    'aUserGroup' => $aUserGroup['special']
				)
			);
		}
		
		if (($iSubtEditId = $this->request()->getInt('step')))
		{
			$aRow = Phpfox::getService('dvstour')->getStep($iSubtEditId);
			$iEditId = $iSubtEditId;
			$bIsEdit = true;
			$bIsStep = true;
			$this->template()->assign(array(			
					'aForms' => $aRow,
					'iEditId' => $iEditId,
				)
			);
		}		

		if (($aVals = $this->request()->getArray('val')))
		{
			if ($bIsEdit)
			{
                if ($bIsStep)
                {
                    if (Phpfox::getService('dvstour.process')->updateStep($iEditId, $aVals))
                    {
                        $this->url()->send('admincp.dvstour', array('tour' => $this->request()->get('tour')), Phpfox::getPhrase('dvstour.update_step_succesfully'));
                    }
                }
                else
                {
                    if (Phpfox::getService('dvstour.process')->updateSitetour($iEditId, $aVals))
                    {
                        $this->url()->send('admincp.dvstour', null, Phpfox::getPhrase('dvstour.update_sitetour_sucessfully'));
                    }
                }			
			}
		}
		
		$this->template()->setTitle(Phpfox::getPhrase('dvstour.edit_sitetour'))
			->setBreadcrumb(Phpfox::getPhrase('dvstour.edit_sitetour'))
			->assign(array(
				'bIsEdit' => $bIsEdit,
			)
		)		
			->setHeader(array(
				'add.js' => 'module_sitetour'
			));
         $sLink = Phpfox::getLib('url')->makeUrl('admincp.language.phrase');
         $this->template()->assign(array(
             'sLinkEdit' => $sLink,
         ));
        if(!$bIsEdit)
        {
            $this->url()->send('admincp.dvstour');
        }
	}
}

?>