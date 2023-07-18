<?php

require_once('custom/LoginSecurity/LoginSecurityFunction.php');
require_once('include/MVC/View/SugarView.php');
class Viewloginsecurityconfig extends SugarView {
	public function __construct() {
		parent::init();
	}//end of function

	public function display() {
        global $theme, $current_user, $mod_strings;
        
        $recordId = "";
        if(isset($_REQUEST['records'])){
            $recordId = $_REQUEST['records'];   
        }

        $dateFormat = $current_user->getPreference('datef');

        $smarty = new Sugar_Smarty();
        if($recordId != ""){
            $fieldNames = array('*');
            $whereCondition = array('id'=>$recordId, 'deleted'=>0);
            $getIpBlockingData = getLoginSecurityRecord("kiyo_ip_blocking", $fieldNames, $whereCondition, $orderby = array());
            $getIpBlockingRow = $GLOBALS['db']->fetchOne($getIpBlockingData);

            $ipBlockingData = array();  
            if(!empty($getIpBlockingRow)){
                $ipBlockingData = array(
                    "ipBlockingType" => $getIpBlockingRow['ip_blocking_type'],
                    "usersTypeIpBlocking"=> $getIpBlockingRow['users_type_ip_blocking'],
                    "users" => json_decode(html_entity_decode($getIpBlockingRow['users'])),
                    "allowIpAddresses" => $getIpBlockingRow['allow_ip_addresses'],
                    "denyIpAddresses" => $getIpBlockingRow['deny_ip_addresses'],
                    "status" => $getIpBlockingRow['status'],

                    "dateEntered" => date($dateFormat.' '.'H:i', strtotime($getIpBlockingRow['date_entered'])),
                    "dateModified" => date($dateFormat.' '.'H:i', strtotime($getIpBlockingRow['date_modified']))
                );
            }//end of if
            
            $whereCondition = array('ip_blocking_id'=>$recordId, 'deleted'=>0);
            $getOtpBasedData = getLoginSecurityRecord("kiyo_otp_based", $fieldNames, $whereCondition, $orderby = array());
            $getOtpBasedRow = $GLOBALS['db']->fetchOne($getOtpBasedData);
         
            $otpBasedData = array();  
            if(!empty($getOtpBasedRow)){
                $otpBasedData = array(
                    "enableOtpBased" => $getOtpBasedRow['enable_otp_based'],
                    "otpType"=> $getOtpBasedRow['otp_type'],
                    "emailSubject" => $getOtpBasedRow['email_subject'],
                    "body" => html_entity_decode($getOtpBasedRow['body']),
                    "smsTrigger" => $getOtpBasedRow['sms_trigger'],
                    "resendOtp" => $getOtpBasedRow['resend_otp'],
                     "resendOtpMinutes" => $getOtpBasedRow['resend_otp_minutes'],
                    "dateEntered" => date($dateFormat.' '.'H:i', strtotime($getOtpBasedRow['date_entered'])),
                    "dateModified" => date($dateFormat.' '.'H:i', strtotime($getOtpBasedRow['date_modified']))
                );
            }//end of if
            $smarty->assign('IP_BLOCKING_DATA', $ipBlockingData);
            $smarty->assign('OTP_BASED_DATA', $otpBasedData);
        }//end of if

        $listViewLink = "?module=Administration&action=loginsecuritylistview";
        $helpLineImagePath = 'custom/modules/Administration/image/helpInline.gif';
      
        $smarty->assign('MOD', $mod_strings);
        $smarty->assign('THEME', $theme);
        $smarty->assign('RECORD_ID', $recordId);
        $smarty->assign('LISTVIEWLINK', $listViewLink);
        $smarty->assign('HELP_LINE_IMAGE_PATH', $helpLineImagePath);
       
        parent::display(); 
		$smarty->display('custom/modules/Administration/tpl/loginsecurityconfig.tpl');

        displayLoginSecurityTMCEForTemplates('templateEditor');  
	}//end of function
}//end of class