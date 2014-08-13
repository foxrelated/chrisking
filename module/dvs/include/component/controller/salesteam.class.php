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
                    if (Phpfox::getService('dvs.manager')->get(Phpfox::getUserId(), $iDvsId)) {

                    } else {
                        $this->url()->send('dvs');
                    }
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
					$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'Successfully Added Team Member.');
				}
				else
				{
					$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'User already invited.');
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
						$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'User added');
					}
					else
					{
						$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'User already added.');
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

						//$this->url()->send(($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.admincp.addtestuer.add') : Phpfox::getLib('url')->makeUrl('admincp.addtestuser.add')), null, 'User ' . $iId . ' Successfully Created ');

						/*phpmasterminds Subdomain starts*/
						if(Phpfox::getParam('dvs.enable_subdomain_mode'))
						{
							$sLink = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'user.' : '') . 'register', array('salesteam' => '1'));
						}
						else
						{
							$sLink = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'user.register', array('salesteam' => '1'));
						}
						
						/*phpmasterminds Subdomain ends*/
						$sBody = Phpfox::getPhrase('dvs.invite_email_to_sales_team_member_body', array(
								'dvs_name' => $aDvs['dvs_name'],
								'dealer_name' => $aDvs['dealer_name'],
								'title_url' => $aDvs['title_url'],
								'address' => $aDvs['address'],
								'city' => $aDvs['city'],
								'state_string' => $aDvs['state_string'],
								'phone' => $aDvs['phone'],
								'link' => $sLink
						));

						Phpfox::getLib('mail')
							->to($aVals['email'])
							->subject($sSubject)
							->message($sBody)
							->send();
						/*phpmasterminds phpfox Invite process*/
						$iInvite = Phpfox::getService('invite.process')->addInvite($aVals['email'], Phpfox::getUserId());			
						$sLink = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));
						$bSent = Phpfox::getLib('mail')->to($sMail)		
						->fromEmail(Phpfox::getUserBy('email'))				
						->fromName(Phpfox::getUserBy('full_name'))				
						->subject(array('invite.full_name_invites_you_to_site_title', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'))))
						->message(array('invite.full_name_invites_you_to_site_title_link', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'), 'link' => $sLink)))
						->send();
						
						/*phpmasterminds phpfox Invite process*/
						$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'Invite sent! They will be added to the DVS upon sign up.');
					}
					else
					{
						$this->url()->send('dvs.salesteam', array('id' => $iDvsId), 'This user has already been invited.');
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
