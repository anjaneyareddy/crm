<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('custom/LoginSecurity/LoginSecurityFunction.php');
class LoginSecurityAddDetails{
    public function __construct(){
        $this->addLoginSecurityDetails();
    }//end of function 
    
    public function addLoginSecurityDetails(){
    	global $current_user, $timedate;
    	
        //current time
        $datetime = new datetime();
        $timedates = new TimeDate();
        $formattedDate = $timedates->asUser($datetime, $current_user);
    	if(isset($_REQUEST['formData'])){
            parse_str($_REQUEST['formData'], $formData); //form data

            $currentDate = date('Y-m-d H:i', strtotime($formattedDate));//Current Date
        	if(isset($_REQUEST['groupUsersData']) && !empty($_REQUEST['groupUsersData'])){
        		$groupUsersList = json_encode($_REQUEST['groupUsersData']);
        	}else{
        		$groupUsersList = '';
        	}//end of if
         
        	if($formData['blockingType'] == "Specific Ip"){
		    	if($formData['ipBlockingUserType'] == "All Users"){
		    		$allowIpAddress = $formData['allowAllUsersSecificIp'];
		    		$denyIpAddress = $formData['denyAllUsersSecificIp'];	
		    	}else if($formData['ipBlockingUserType'] == "Specific Group or User"){
		    		$allowIpAddress = $formData['allowSelUsersSecificIp'];
		    		$denyIpAddress = $formData['denySelUsersSecificIp'];	
		    	}
		    }else if($formData['blockingType'] == "All Range"){
		    	if($formData['ipBlockingUserType'] == "All Users"){
					$allowAllUsersFromSpecificIp = $formData['allowAllUsersFromSpecificIp'];
					$allowAllUsersToSpecificIp = $formData['allowAllUsersToSpecificIp'];
					$allowIpAddress = $allowAllUsersFromSpecificIp.'-'.$allowAllUsersToSpecificIp;

					$denyAllUsersFromSpecificIp = $formData['denyAllUsersFromSpecificIp'];
					$denyAllUsersToSpecificIp = $formData['denyAllUsersToSpecificIp'];
					$denyIpAddress = $denyAllUsersFromSpecificIp.'-'.$denyAllUsersToSpecificIp;
				}else if($formData['ipBlockingUserType'] == "Specific Group or User"){
					$allowSelUsersFromSpecificIp = $formData['allowSelUsersFromSpecificIp'];
					$allowSelUsersToSpecificIp = $formData['allowSelUsersToSpecificIp'];
					$allowIpAddress = $allowSelUsersFromSpecificIp.'-'.$allowSelUsersToSpecificIp;

					$denySelUsersFromSpecificIp = $formData['denySelUsersFromSpecificIp'];
					$denySelUsersToSpecificIp = $formData['denySelUsersToSpecificIp'];
					$denyIpAddress = $denySelUsersFromSpecificIp.'-'.$denySelUsersToSpecificIp;
				}
		    }else if($formData['blockingType'] == "Comma Separated"){
		    	if($formData['ipBlockingUserType'] == "All Users"){
			    	$allowIpAddress = $formData['addIpAllowAllUser'];
			    	$denyIpAddress = $formData['addIpDenyAllUser'];
			    }else if($formData['ipBlockingUserType'] == "Specific Group or User"){
			    	$allowIpAddress = $formData['addIpAllowSelUser'];
			    	$denyIpAddress = $formData['addIpDenySelUser'];
			   	}
		    }//end of if
		    	
	    	$ipBlockingData = array(
                'ip_blocking_type' => "'".$formData['blockingType']."'",
                'users_type_ip_blocking' => "'".$formData['ipBlockingUserType']."'",
                'users' => "'".$groupUsersList."'",
                'allow_ip_addresses' => "'".$allowIpAddress."'",
                'deny_ip_addresses' => "'".$denyIpAddress."'",
                'status' => "'".$formData['status']."'",
                'date_modified' => "'".$currentDate."'"
            );

            $otpBasedData = array(
                'enable_otp_based' => "'".$formData['enableOTPLoginSecurity']."'",
                'otp_type' => "'".$formData['otpType']."'",
                'email_subject' => "'".$formData['emailSubject']."'",
                'body' => "'".html_entity_decode($_REQUEST['body'])."'",
                'sms_trigger' => "'".$formData['smsTrigger']."'",
	            'resend_otp' => "'".$formData['days']."'",
	            'resend_otp_minutes' => "'".$formData['minutes']."'",
                'date_modified' => "'".$currentDate."'",
            );
            
			$ipBlockingId = create_guid(); //id
	    	if($formData['status'] == 'Active'){
            	$fields = array('status'=>"'Inactive'");
           		$whereData = array('id'=>$ipBlockingId);
            	$upadateLoginSecurityStatus = updateLoginSecurityRecord('kiyo_ip_blocking', $fields, $whereData, $operator = '!='); //update record
       		}//end of if

	    	if($_REQUEST['recordId'] == ""){
		    	$ipBlockingData['id'] = "'".$ipBlockingId."'";
		    	$ipBlockingData['date_entered'] = "'".$currentDate."'";
			
				//insert record
		    	$ipBlockingAddConfigDataResult = insertLoginSecurityRecord('kiyo_ip_blocking', $ipBlockingData); //insert record

		    	$otpBasedId = create_guid();
				//insert record
				$otpBasedData['id'] = "'".$otpBasedId."'";
				$otpBasedData['ip_blocking_id'] = "'".$ipBlockingId."'";
				$otpBasedData['date_entered'] = "'".$currentDate."'";
		    	$otpBasedAddConfigDataResult = insertLoginSecurityRecord('kiyo_otp_based', $otpBasedData);
	    	}else{
	    		$ipBlockingId = $_REQUEST['recordId'];
	    		$whereData = array('id'=>$ipBlockingId);
				//update record
		    	$ipBlockingUpdateConfigDataResult = updateLoginSecurityRecord('kiyo_ip_blocking', $ipBlockingData, $whereData, $operator = '=');

		    	$whereData = array('ip_blocking_id'=>$_REQUEST['recordId']);

				//update record
		    	$otpBasedUpdateConfigDataResult = updateLoginSecurityRecord('kiyo_otp_based', $otpBasedData, $whereData, $operator = '=');
		    	
	    	}

		    if(isset($ipBlockingAddConfigDataResult) && isset($otpBasedAddConfigDataResult)){
		    	$loginSecurityConfigRes = array('configStatus'=>1);
		    }else if(isset($ipBlockingUpdateConfigDataResult) && isset($otpBasedUpdateConfigDataResult)){
		    	$loginSecurityConfigRes = array('configStatus'=>2);
		    }
	    }//end of if
	    
    	echo json_encode($loginSecurityConfigRes);
    }//end of function
}//end of class
new LoginSecurityAddDetails();