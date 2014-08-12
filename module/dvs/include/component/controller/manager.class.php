<?php

class Dvs_Component_Controller_Manager extends Phpfox_Component {
    public function process() {
        Phpfox::isAdmin(true);

        if (($iDvsId = $this->request()->getInt('id'))) {
            if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId())) {
                $this->url()->send('dvs');
            }

            if (($aDvs = Phpfox::getService('dvs')->get($iDvsId))) {
                if ($aDvs['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin()) {

                } else {
                    $this->url()->send('dvs');
                }
            } else {
                $this->url()->send('dvs');
            }
        } else {
            $this->url()->send('dvs');
        }


        if ($aVals = $this->request()->getArray('val')) {
            if (isset($aVals['user_id']) && $aVals['user_id']) {
                // Dont add dupes
                $aTeamMember = Phpfox::getService('dvs.manager')->get($aVals['user_id'], $aDvs['dvs_id']);
                if (empty($aTeamMember)) {
                    Phpfox::getService('dvs.manager.process')->add($aDvs['dvs_id'], $aVals['user_id']);
                    $this->url()->send('dvs.manager', array('id' => $iDvsId), 'Successfully Added Team Member.');
                } else {
                    $this->url()->send('dvs.manager', array('id' => $iDvsId), 'User already invited.');
                }
            }


            if (isset($aVals['email']) && $aVals['email']) {
                // See if member exists
                $iUserId = Phpfox::getService('dvs.manager')->searchUserId($aVals['email']);


                if ($iUserId) {
                    // User exists, try adding them, dont add dupes
                    $aTeamMember = Phpfox::getService('dvs.manager')->get($iUserId, $aDvs['dvs_id']);

                    if (empty($aTeamMember)) {
                        Phpfox::getService('dvs.manager.process')->add($aDvs['dvs_id'], $iUserId);
                        $this->url()->send('dvs.manager', array('id' => $iDvsId), 'User added');
                    } else {
                        $this->url()->send('dvs.manager', array('id' => $iDvsId), 'User already added.');
                    }
                } else {
                    // Send an invite if one does not already exist for this email address for this dvs
                    $aInvite = Phpfox::getService('dvs.invite')->get($aDvs['dvs_id'], $aVals['email'], true);

                    if (empty($aInvite)) {
                        Phpfox::getService('dvs.invite.process')->add($aDvs['dvs_id'], $aVals['email'], true);

                        // Send email to invited team member
                        $sSubject = Phpfox::getPhrase('dvs.invite_email_to_manager_team_member_subject', array(
                            'dvs_name' => $aDvs['dvs_name'],
                            'dealer_name' => $aDvs['dealer_name'],
                            'title_url' => $aDvs['title_url'],
                            'address' => $aDvs['address'],
                            'city' => $aDvs['city'],
                            'state_string' => $aDvs['state_string'],
                            'phone' => $aDvs['phone']
                        ));


                        if(Phpfox::getParam('dvs.enable_subdomain_mode')) {
                            $sLink = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'user.' : '') . 'register', array('managersteam' => '1'));
                        } else {
                            $sLink = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'user.register', array('managersteam' => '1'));
                        }


                        $sBody = Phpfox::getPhrase('dvs.invite_email_to_manager_team_member_body', array(
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

                        $iInvite = Phpfox::getService('invite.process')->addInvite($aVals['email'], Phpfox::getUserId());
                        $sLink = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));
                        /*$bSent = Phpfox::getLib('mail')->to()
                            ->fromEmail(Phpfox::getUserBy('email'))
                            ->fromName(Phpfox::getUserBy('full_name'))
                            ->subject(array('invite.full_name_invites_you_to_site_title', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'))))
                            ->message(array('invite.full_name_invites_you_to_site_title_link', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'), 'link' => $sLink)))
                            ->send();*/


                        $this->url()->send('dvs.manager', array('id' => $iDvsId), 'Invite sent! They will be added to the DVS upon sign up.');
                    }
                    else
                    {
                        $this->url()->send('dvs.manager', array('id' => $iDvsId), 'This user has already been invited.');
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
                'aManagersteam' => Phpfox::getService('dvs.manager')->getAll($iDvsId),
                'aUsers' => Phpfox::getService('dvs.manager')->getRelated($aDvs['dvs_id'])
            ))
            ->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
            ->setBreadcrumb('Managers Team of ' . $aDvs['dvs_name'], null, true);
    }
}
?>