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
class Dvs_Component_Controller_Salesteam extends Phpfox_Component {

	public function process()
	{
		Phpfox::isUser(true);

		if (($iDvsId = $this->request()->getInt('id')))
		{
			if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId()))
			{
				$this->url()->send('dvs');
			}

			if (($aDvs = Phpfox::getService('dvs')->get($iDvsId)))
			{
				if ($aDvs['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
				{
					
				}
				else
				{
					$this->url()->send('dvs');
				}
			}
			else
			{
				$this->url()->send('dvs');
			}
		}
		else
		{
			$this->url()->send('dvs');
		}


		if ($aVals = $this->request()->getArray('val'))
		{
			if (isset($aVals['user_id']) && $aVals['user_id'])
			{
				// Dont add dupes
				$aTeamMember = Phpfox::getService('dvs.salesteam')->get($aVals['user_id'], $aDvs['dvs_id']);
				if (empty($aTeamMember))
				{
					Phpfox::getService('dvs.salesteam.process')->add($aDvs['dvs_id'], $aVals['user_id']);
				}
			}

			if (isset($aVals['email']) && $aVals['email'])
			{
				// See if member exists
				$iUserId = Phpfox::getService('dvs.salesteam')->searchUserId($aVals['email']);

				if ($iUserId)
				{
					// User exists, try adding them, dont add dupes
					$aTeamMember = Phpfox::getService('dvs.salesteam')->get($iUserId, $aDvs['dvs_id']);
					if (empty($aTeamMember))
					{
						Phpfox::getService('dvs.salesteam.process')->add($aDvs['dvs_id'], $iUserId);
					}
				}
				else
				{
					// Send an invite if one does not already exist for this email address for this dvs
					$aInvite = Phpfox::getService('dvs.invite')->get($aDvs['dvs_id'], $aVals['email']);
					if (empty($aInvite))
					{
						Phpfox::getService('dvs.invite.process')->add($aDvs['dvs_id'], $aVals['email']);

						// Send email to invited team member
						$sSubject = Phpfox::getPhrase('dvs.invite_email_to_sales_team_member_subject', array(
								'dvs_name' => $aDvs['dvs_name'],
								'dealer_name' => $aDvs['dealer_name'],
								'title_url' => $aDvs['title_url'],
								'address' => $aDvs['address'],
								'city' => $aDvs['city'],
								'state_string' => $aDvs['state_string'],
								'phone' => $aDvs['phone']
						));

						$sBody = Phpfox::getPhrase('dvs.invite_email_to_sales_team_member_body', array(
								'dvs_name' => $aDvs['dvs_name'],
								'dealer_name' => $aDvs['dealer_name'],
								'title_url' => $aDvs['title_url'],
								'address' => $aDvs['address'],
								'city' => $aDvs['city'],
								'state_string' => $aDvs['state_string'],
								'phone' => $aDvs['phone'],
								'link' => Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'user.register', array('salesteam' => '1'))
						));

						Phpfox::getLib('mail')
							->to($aVals['email'])
							->subject($sSubject)
							->message($sBody)
							->send();
					}
				}
			}
		}

		$this->template()
			->setHeader(array(
				'add.css' => 'module_dvs'
			))
			->assign(array(
				'aDvs' => $aDvs,
				'aSalesteam' => Phpfox::getService('dvs.salesteam')->getAll($iDvsId),
				'aUsers' => Phpfox::getService('dvs.salesteam')->getRelated($aDvs['dvs_id'])
			))
			->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
			->setBreadcrumb(Phpfox::getPhrase('dvs.manage_sales_team_for_dvs_name', array('dvs_name' => $aDvs['dvs_name'])), null, true);
	}


}

?>
