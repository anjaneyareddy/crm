<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * This file is part of package Login Security.
 * 
 * Author : Variance InfoTech PVT LTD (http://www.varianceinfotech.com)
 * All rights (c) 2022 by Variance InfoTech PVT LTD
 *
 * This Version of Login Security is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of Variance InfoTech PVT LTD
 * 
 * You can contact via email at info@varianceinfotech.com
 * 
 ********************************************************************************/
require_once('custom/LoginSecurity/LoginSecurityFunction.php');
class LoginSecurityCheckLoginStatus{
    public function __construct(){
        $this->checkLoginStatus();
    }//end of function 
    
    public function checkLoginStatus(){
    	global $current_user, $timedate;
    	
        //current time
        $datetime = new datetime();
        $timedates = new TimeDate();
        $formattedDate = $timedates->asUser($datetime, $current_user);
    	$currentDate = date('Y-m-d H:i:s', strtotime($formattedDate));//Current Date

    	$userName = $_REQUEST['userName'];
    	$otp = $_REQUEST['otp'];
		
		$fieldNames = array('*');
		$whereCondition = array('user_name' => $userName, 'otp' => $otp, 'deleted' => 0);
		$otpEntryQuery = getLoginSecurityRecord('kiyo_login_otp_entry', $fieldNames, $whereCondition, $orderBy=array()); //insert record
		
		$otpEntryRow = $GLOBALS['db']->fetchOne($otpEntryQuery);

		$flag = 0;
		if(!empty($otpEntryRow)){
			$date = date("Y-m-d H:i:s", strtotime($otpEntryRow['date_entered']."+2 min"));
			if (($currentDate >= $otpEntryRow['date_entered']) && ($currentDate <= $date)){
				$flag = 1;	

				$otp = $userName.'otp';
				$otpBasedQuery = "SELECT * FROM kiyo_ip_blocking INNER JOIN kiyo_otp_based ON kiyo_ip_blocking.id = kiyo_otp_based.ip_blocking_id WHERE kiyo_ip_blocking.status = 'Active' AND kiyo_otp_based.enable_otp_based = 1";
				$otpBasedRow = $GLOBALS['db']->fetchOne($otpBasedQuery);
				if(!empty($otpBasedRow)){
					if(isset($otpBasedRow['sms_trigger'])){
						if($otpBasedRow['sms_trigger'] == "Days"){
							if($otpBasedRow['resend_otp'] == "30 Days"){
								setcookie($otp, $otpEntryRow['otp'], time() + (86400 * 30));
							}else if($otpBasedRow['resend_otp'] == "60 Days"){
								setcookie($otp, $otpEntryRow['otp'], time() + (86400 * 60));
							}else if($otpBasedRow['resend_otp'] == "180 Days"){
								setcookie($otp, $otpEntryRow['otp'], time() + (86400 * 180));
							} 
						}else if($otpBasedRow['sms_trigger'] == "Week"){
							setcookie($otp, $otpEntryRow['otp'], time() + (86400 * 7));
						}else if($otpBasedRow['sms_trigger'] == "Month"){
							setcookie($otp, $otpEntryRow['otp'], time() + (86400 * 30));
						}else if($otpBasedRow['sms_trigger'] == "Minutes"){
							if($otpBasedRow['resend_otp_minutes'] == "2 Minutes"){
								setcookie($otp, $otpEntryRow['otp'], time() + (60 * 2));
							}else if($otpBasedRow['resend_otp_minutes'] == "5 Minutes"){
								setcookie($otp, $otpEntryRow['otp'], time() + (60 * 5));
							}else if($otpBasedRow['resend_otp_minutes'] == "10 Minutes"){
								setcookie($otp, $otpEntryRow['otp'], time() + (60 * 10));
							}else if($otpBasedRow['resend_otp_minutes'] == "15 Minutes"){
								setcookie($otp, $otpEntryRow['otp'], time() + (60 * 15));
							} 
						}//end of if
					}//end of if
				}
			}
		}else{
			$flag = 2;
		}
				
		$otpEntryData = array('status'=>$flag);
    	echo json_encode($otpEntryData);
    }//end of function 
}//end of class
new LoginSecurityCheckLoginStatus();