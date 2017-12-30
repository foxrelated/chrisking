<?php

defined('PHPFOX') or exit('No direct script access allowed.');

class Dvs_Service_Email_Email extends Phpfox_Service {

    private $mail = null;
    private $ajax = null;

    public function __construct() {
        Phpfox::getLibClass('phpfox.mail.interface');
        $this->mail = Phpfox::getLib('mail.driver.phpmailer.smtp');
	    $this->ajax = new Phpfox_Ajax();
    }
    /**
     * Sends out an email.
     *
     * @param mixed $mTo Can either be a persons email (STRING) or an ARRAY of emails.
     * @param string $sSubject Subject message of the email.
     * @param string $sTextPlain Plain text of the message.
     * @param string $sTextHtml HTML version of the message.
     * @param string $sFromName Name the email is from.
     * @param string $sFromEmail Email the email is from.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function send($mTo, $sSubject, $sTextPlain, $sTextHtml, $sFromName = null, $sFromEmail = null) {
        if(true) {
            //method to guard from email issues
            $this->mail->send($mTo, $sSubject, $sTextPlain, $sTextHtml, $sFromName);
        }
    }
    
    public function sendDealerContactEmail($aVals) {
	    $aVideo = Phpfox::getService('dvs.video')->get($aVals['contact_video_ref_id']);
	    $aDvs = Phpfox::getService('dvs')->get($aVals['contact_dvs_id']);

	    $sSubject = Phpfox::getPhrase('dvs.dealer_email_subject', array(
		    'contact_name' => $aVals['contact_name'],
		    'contact_email' => $aVals['contact_email'],
		    'contact_phone' => $aVals['contact_phone'],
		    'contact_zip' => $aVals['contact_zip'],
		    'contact_comments' => $aVals['contact_comments'],
		    'year' => $aVideo['year'],
		    'make' => $aVideo['make'],
		    'model' => $aVideo['model'],
		    'bodyStyle' => $aVideo['bodyStyle'],
		    'dvs_name' => $aDvs['dvs_name'],
		    'dealer_name' => $aDvs['dealer_name'],
		    'title_url' => $aDvs['title_url'],
		    'address' => $aDvs['address'],
		    'city' => $aDvs['city'],
		    'state_string' => $aDvs['state_string'],
		    'phone' => $aDvs['phone']
	    ));
	    if($aDvs['email_format']){
		    $sBody = Phpfox::getPhrase('dvs.dealer_email_xml_body', array(
			    'dvs_name' => $aDvs['dvs_name'],
			    'time' => date('Y-m-dTH:i:s', PHPFOX_TIME),
			    'year' => $aVideo['year'],
			    'make' => $aVideo['make'],
			    'model' => $aVideo['model'],
			    'contact_name' => $aVals['contact_name'],
			    'contact_email' => $aVals['contact_email'],
			    'contact_phone' => $aVals['contact_phone'],
			    'contact_comments' => $aVals['contact_comments']
		    ));
	    }else{
		    $sBody = Phpfox::getPhrase('dvs.dealer_email_body', array(
			    'contact_name' => $aVals['contact_name'],
			    'contact_email' => $aVals['contact_email'],
			    'contact_phone' => $aVals['contact_phone'],
			    'contact_zip' => $aVals['contact_zip'],
			    'contact_comments' => $aVals['contact_comments'],
			    'year' => $aVideo['year'],
			    'make' => $aVideo['make'],
			    'model' => $aVideo['model'],
			    'bodyStyle' => $aVideo['bodyStyle'],
			    'dvs_name' => $aDvs['dvs_name'],
			    'dealer_name' => $aDvs['dealer_name'],
			    'title_url' => $aDvs['title_url'],
			    'address' => $aDvs['address'],
			    'city' => $aDvs['city'],
			    'state_string' => $aDvs['state_string'],
			    'phone' => $aDvs['phone']
		    ));
	    }

	    $sEmailSig = preg_replace('/\{phrase var=\'(.*)\'\}/ise', "'' . Phpfox::getPhrase('\\1', {$this->_sArray}, false, null, '". Phpfox::getParam('core.default_lang_id')."') . ''", Phpfox::getParam('core.mail_signature'));


	    $sTextHtml = Phpfox::getLib('template')->assign(array(
			    'bHtml' => true,
			    'sMessage' => str_replace("\n", "<br />", $sBody),
			    'sEmailSig' => str_replace("\n", "<br />", $sEmailSig),
			    'bMessageHeader' => $this->_bMessageHeader
		    )
	    )->getLayout('email', true);
	    Phpfox::getLibClass('phpfox.mail.interface');

	    $toMail = explode(',',$aDvs['email']);

	    foreach($toMail as $receipent){
		    $receipent = trim($receipent);
		    $this->send($receipent, $sSubject, $sBody, $sTextHtml);
		    Phpfox::getService('dvs.process')->updateContactCount($aDvs['dvs_id']);

	    }
	    return $toMail;
    }
    
    public function sendShareEmail($aVals) {
	    $aDvs = Phpfox::getService('dvs')->get($aVals['dvs_id']);
	    Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);
	    $aVideo = Phpfox::getService('dvs.video')->get($aVals['video_ref_id']);

	    $sSubject = Phpfox::getPhrase('dvs.share_email_subject');

	    // Replace variables in the subject
	    $aFindReplace = array();
	    foreach ($aVals as $sKey => $sValue)
	    {
		    $aFind[] = '{share_' . $sKey . '}';
		    $aReplace[] = '' . $sValue . '';
	    }
	    foreach ($aDvs as $sKey => $sValue) {
		    if(is_array($sValue)) {
			    continue;
		    }
		    $aFind[] = '{dvs_' . $sKey . '}';
		    $aReplace[] = '' . $sValue . '';
	    }
	    foreach ($aVideo as $sKey => $sValue)
	    {
		    $aFind[] = '{video_' . $sKey . '}';
		    $aReplace[] = '' . $sValue . '';
	    }

	    $sSubject = str_replace($aFind, $aReplace, $sSubject);
	    
	    $oShareService = Phpfox::getService('dvs.share');
	    $sVideoLink = $oShareService->convertNumberToHashCode($aVideo['ko_id'], 5) . $oShareService->convertNumberToHashCode($aDvs['dvs_id'], 3);
	    $sVideoLink = Phpfox::getLib('url')->makeUrl('share.') . $sVideoLink . '6';

	    Phpfox::getBlock('dvs.share-email-template', array(
		    'iDvsId' => $aDvs['dvs_id'],
		    'sReferenceId' => $aVideo['referenceId'],
		    'sShareName' => $aVals['share_name'],
		    'sMyShareName' => $aVals['my_share_name'],
		    'sShareMessage' => nl2br(htmlentities($aVals['share_message'], ENT_QUOTES, 'UTF-8')),
		    'sShareEmail' => $aVals['share_email'],
		    'sMyShareEmail' => $aVals['my_share_email'],
		    //'sMySharePhone' => $aDvs['phone'],
		    'sMySharePhone' => $aVals['my_share_tel'],
		    'sPagebg' => $aDvs['page_background'],
		    'sTextColor' => $aDvs['vin_text_color'],
		    'sLinkColor' => $aDvs['text_link'],
		    'sButtonBackground' => $aDvs['button_background'],
		    'sButtonText' => $aDvs['button_text'],
		    'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
		    'sVideoLink' => $sVideoLink,
		    'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
	    ));
	    $sBody = $this->getContent(false);

	    Phpfox::getBlock('dvs.share-email-plain-template', array(
		    'iDvsId' => $aDvs['dvs_id'],
		    'sReferenceId' => $aVideo['referenceId'],
		    'sShareName' => $aVals['share_name'],
		    'sMyShareName' => $aVals['my_share_name'],
		    'sShareMessage' => $aVals['share_message'],
		    'sShareEmail' => $aVals['share_email'],
		    'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
		    'sVideoLink' => $sVideoLink,
		    'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
	    ));
	    $sBodyPlain = $this->getContent(false);
	    
	    $this->send($aVals['share_email'], $sSubject, $sBodyPlain, $sBody, $aVals['my_share_name'] . "(" . $aVals['my_share_email'] . ")");
        
	    return $aVals['share_email'];
    }
    
    private function getContent($bClean) {
    	return $this->ajax->getContent($bClean);
    }

}