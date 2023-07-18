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
require_once("custom/LoginSecurity/LoginSecurityFunction.php");
class LoginSecurityAddOTPEntryDetails{
    public function __construct(){
        $this->addOTPEntryDetails();
    } 
    public function addOTPEntryDetails(){
    	require_once('include/SubPanel/SubPanel.php');
    	global $current_user, $timedate;

    	$serverHost = $_SERVER['HTTP_HOST'];  

    	if (strpos($serverHost, 'localhost') !== false) {
    		$myIp = getHostByName(getHostName());
    	}else{
    		$myIp = $_SERVER['REMOTE_ADDR'];
    	}
    
        //current time
        $datetime = new datetime();
        $timedates = new TimeDate();
        $formattedDate = $timedates->asUser($datetime, $current_user);
    	$currentDate = date('Y-m-d H:i', strtotime($formattedDate));//Current Date

    	$userName = $_REQUEST['userName'];
    	$usernamePassword = $_REQUEST['usernamePassword'];

		$fieldNames = array('*');
		$whereData = array('status' => 'Active', 'deleted' => 0);
		$ipBlockingQuery = getLoginSecurityRecord('kiyo_ip_blocking', $fieldNames, $whereData, $orderBy=array()); 
		$ipBlockingRow = $GLOBALS['db']->fetchOne($ipBlockingQuery);

		$specificGroupUsers = json_decode(html_entity_decode($ipBlockingRow['users']));
		$usersIds = array();
		if(!empty($specificGroupUsers)){
			if(isset($specificGroupUsers->groups)){
				$groupIds = $specificGroupUsers->groups;
			}else{
				$groupIds = array();
			}
			if(isset($specificGroupUsers->users)){
				$usersIds = $specificGroupUsers->users;
			}else{
				$usersIds = array();
			}
		
			$groupUsersIds = array();
			if(!empty($groupIds)){
				foreach ($groupIds as $key => $value) {
					$bean = BeanFactory::getBean('SecurityGroups', $value);
					$relatedBean = BeanFactory::newBean('Users');
		            $tableName = $relatedBean->getTableName();

					if($bean->load_relationship($tableName)){
						if(!empty($bean->$tableName->get())){
							foreach($bean->$tableName->get() as $k => $id){
								$usersIds[] = $id;
							}
						}
		            }
				}//end of for
			}
		}//end of if

		$fieldNames = array('*');
		$whereData = array('user_name' => $userName, 'deleted' => 0, 'status' => 'Active');
		$usersQuery = getLoginSecurityRecord('users', $fieldNames, $whereData, $orderBy=array()); 
		$usersRow = $GLOBALS['db']->fetchOne($usersQuery);

		if(!empty($usersRow)){
			if (empty($usersRow['user_hash'])) {
	            return false;
	        }

	        if ($usersRow['user_hash'][0] !== '$' && strlen($usersRow['user_hash']) === 32) {
	            // Legacy md5 password
	            $valid = strtolower(md5($usernamePassword)) === $usersRow['user_hash'];
	        } else {
	            $valid = password_verify(strtolower(md5($usernamePassword)), $usersRow['user_hash']);
	        }
		}else{
			$valid = 0;
		}

		$flag = 0;
		$validationMsg = '';

		if($valid == 1){
			$loginUserId = $usersRow['id'];
			if($ipBlockingRow['ip_blocking_type'] == "Specific Ip"){
				$allowIpAddresses = $ipBlockingRow['allow_ip_addresses'];
				$denyIpAddresses = $ipBlockingRow['deny_ip_addresses'];
				if($ipBlockingRow['users_type_ip_blocking'] == "All Users"){
					if($allowIpAddresses == "" && $denyIpAddresses == ""){
						$flag = 1;
					}else if($allowIpAddresses != "" && $denyIpAddresses == ""){
						if($myIp == $allowIpAddresses){
							$flag = 1;
						}
					}else if($allowIpAddresses == "" && $denyIpAddresses != ""){
						if($myIp != $denyIpAddresses){
							$flag = 1;
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}else if($allowIpAddresses != "" && $denyIpAddresses != ""){
						if(($myIp == $allowIpAddresses) && ($myIp != $denyIpAddresses)){
							$flag = 1;
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}
				}else if($ipBlockingRow['users_type_ip_blocking'] == "Specific Group or User"){
					if(in_array($loginUserId, $usersIds)){
						if($allowIpAddresses == "" && $denyIpAddresses == ""){
							$flag = 1;
						}else if($allowIpAddresses != "" && $denyIpAddresses == ""){
							if($myIp == $allowIpAddresses){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}else if($allowIpAddresses == "" && $denyIpAddresses != ""){
							if($myIp == $denyIpAddresses){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}else if($allowIpAddresses != "" && $denyIpAddresses != ""){
							if(($myIp == $allowIpAddresses) && ($myIp != $denyIpAddresses)){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}
					}else{
						$flag = 2;
					}
				}
			}else if($ipBlockingRow['ip_blocking_type'] == "All Range"){
				$allowIpAddresses = $ipBlockingRow['allow_ip_addresses'];
				$allowIpAddresses = explode('-', $allowIpAddresses);
				$denyIpAddresses = $ipBlockingRow['deny_ip_addresses'];
				$denyIpAddresses = explode('-', $denyIpAddresses);

				if($ipBlockingRow['users_type_ip_blocking'] == "All Users"){
					if(($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] != "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] != "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] != "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] != "")){
						$flag = 1;
					}else if(($allowIpAddresses[0] != "" && $allowIpAddresses[1] != "") && ($denyIpAddresses[0] == "" && $denyIpAddresses[1] == "")){
						if((($myIp >= $allowIpAddresses[0]) && ($myIp <= $allowIpAddresses[1]))){
							$flag = 1;
						}
					}else if(($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "") && ($denyIpAddresses[0] != "" && $denyIpAddresses[1] != "")){
						if((($myIp >= $denyIpAddresses[0]) && ($myIp <= $denyIpAddresses[1]))){
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}else if(($allowIpAddresses[0] != "" && $allowIpAddresses[1] != "") && ($denyIpAddresses[0] != "" && $denyIpAddresses[1] != "")){
						if((($myIp >= $allowIpAddresses[0]) && ($myIp <= $allowIpAddresses[1]))){
							$flag = 1;
						}else if((($myIp >= $denyIpAddresses[0]) && ($myIp <= $denyIpAddresses[1]))){
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}
				}else if($ipBlockingRow['users_type_ip_blocking'] == "Specific Group or User"){
					if(in_array($loginUserId, $usersIds)){
						if(($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] != "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] != "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] != "" && $denyIpAddresses[1] == "") || ($allowIpAddresses[0] == "" && $allowIpAddresses[1] == "" && $denyIpAddresses[0] == "" && $denyIpAddresses[1] != "")){
							$flag = 1;
						}else if(($allowIpAddresses[0] != "" && $allowIpAddresses[1] != "") && ($denyIpAddresses[0] == "" && $denyIpAddresses[1] == "")){
							if((($myIp >= $allowIpAddresses[0]) && ($myIp <= $allowIpAddresses[1]))){
								$flag = 1;
							}
						}else if(empty($allowIpAddresses) && !empty($denyIpAddresses)){
							if((($myIp >= $denyIpAddresses[0]) && ($myIp <= $denyIpAddresses[1]))){
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}else if(!empty($allowIpAddresses) && !empty($denyIpAddresses)){
							if((($myIp >= $allowIpAddresses[0]) && ($myIp <= $allowIpAddresses[1]))){
								$flag = 1;
							}else if((($myIp >= $denyIpAddresses[0]) && ($myIp <= $denyIpAddresses[1]))){
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}
					}else{
						$flag = 2;
					}
				}
			}else if($ipBlockingRow['ip_blocking_type'] == "Comma Separated"){
				$allowIpAddress = $ipBlockingRow['allow_ip_addresses'];
				$allowIpAddresses = explode(',', $allowIpAddress);
				$denyIpAddress = $ipBlockingRow['deny_ip_addresses'];
				$denyIpAddresses = explode(',', $denyIpAddress);
				if($ipBlockingRow['users_type_ip_blocking'] == "All Users"){
					if($allowIpAddress == "" && $denyIpAddress == ""){
						$flag = 1;
					}else if(!empty($allowIpAddresses) && empty($denyIpAddresses)){
						if(in_array($myIp, $allowIpAddresses)){
							$flag = 1;
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}else if(empty($allowIpAddresses) && !empty($denyIpAddresses)){
						if(!in_array($myIp, $denyIpAddresses)){
							$flag = 1;
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}else if(!empty($allowIpAddresses) && !empty($denyIpAddresses)){
						if(in_array($myIp, $allowIpAddresses) && !in_array($myIp, $denyIpAddresses)){
							$flag = 1;
						}else{
							$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
						}
					}
				}else if($ipBlockingRow['users_type_ip_blocking'] == "Specific Group or User"){
					if(in_array($loginUserId, $usersIds)){
						if(empty($allowIpAddresses) && empty($denyIpAddresses)){
							$flag = 1;
						}else if(!empty($allowIpAddresses) && empty($denyIpAddresses)){
							if(in_array($myIp, $allowIpAddresses)){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}	
						}else if(empty($allowIpAddresses) && !empty($denyIpAddresses)){
							if(!in_array($myIp, $denyIpAddresses)){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}else if(!empty($allowIpAddresses) && !empty($denyIpAddresses)){
							if(in_array($myIp, $allowIpAddresses) && !in_array($myIp, $denyIpAddresses)){
								$flag = 1;
							}else{
								$validationMsg = translate('LBL_DENIED_IP_ADDRESS', 'Users');
							}
						}
					}else{
						$flag = 2;
					}
				}
			}//end of function
		}else{
			$validationMsg = translate('LBL_VALID_LOGIN_CREDENTIALS', 'Users');
		}

		$otpStatus = 0;
		if($flag == 1){
			$fieldNames = array('*');
			$whereData = array('ip_blocking_id' => $ipBlockingRow['id'], 'deleted' => 0);
			$otpBasedQuery = getLoginSecurityRecord('kiyo_otp_based', $fieldNames, $whereData, $orderBy=array()); 
			$otpBasedRow = $GLOBALS['db']->fetchOne($otpBasedQuery);
			if($otpBasedRow['enable_otp_based'] == 1){
				if($otpBasedRow['otp_type'] == "Email"){
					$otp = $userName.'otp';
					if(isset($_COOKIE[$otp]) && $_COOKIE[$otp] == true){
						$otpStatus = 2;	
					}else{
						$userBean = BeanFactory::getBean('Users', $loginUserId);
						$userMail = "";
				        if(isset($userBean->email1 ) && $userBean->email1  != ""){
				            $userMail = $userBean->email1; 
				        }

						if ($userMail != '') {
							require_once('modules/Emails/Email.php');
						    require_once('include/SugarPHPMailer.php');
						    require_once('modules/EmailTemplates/EmailTemplate.php');
						    $emailObj = new Email();
						    $defaults = $emailObj->getSystemDefaultEmail();
						    $mail = new SugarPHPMailer();
						    $mail->setMailerForSystem();
						    $mail->From = $defaults['email'];
						    $mail->FromName = $defaults['name'];
						    $mail->Subject = $otpBasedRow['email_subject']; 
						    $mail->Body = html_entity_decode($otpBasedRow['body'])." ".$_REQUEST['randNum'];
						    $mail->IsHTML(true);
						    $mail->AddAttachment("");  
						    $mail->prepForOutbound();
						    $mail->AddAddress($userMail);

							if($mail->send()){
								$otpStatus = 1;
							}
						}
					}	
				}
			}
		}//end of if
		

		if($otpStatus == 1){
			$userName = $_REQUEST['userName'];

	    	$id = create_guid();
	    	$otpEntry['id'] = "'".$id."'";
	    	$otpEntry['user_id'] = "'".$loginUserId."'";
	    	$otpEntry['user_name'] = "'".$userName."'";
	    	$otpEntry['otp'] = "'".$_REQUEST['randNum']."'";
			$otpEntry['date_entered'] = "'".$currentDate."'";

			$fieldNames = array('*');
			$whereCondition = array('user_name' => $userName, 'user_id' => $loginUserId);
			$otpEntryQuery = getLoginSecurityRecord('kiyo_login_otp_entry', $fieldNames, $whereCondition, $orderBy=array()); //get record
			$otpEntryRow = $GLOBALS['db']->fetchOne($otpEntryQuery);
			if(!empty($otpEntryRow)){
				$fieldNames = array('deleted' => 1);
				$where = array('user_name' => $userName, 'user_id' => $loginUserId);
				//update record 
				$updateOtpEntryRes = updateLoginSecurityRecord('kiyo_login_otp_entry', $fieldNames, $where, $operator='=');
			}
			//insert record
			$otpEntryRes = insertLoginSecurityRecord('kiyo_login_otp_entry', $otpEntry); 
			if(isset($otpEntryRes)){
		        $loginSecurityConfigRes = array('status'=>1);
		    }
	   	}//end of if

		echo json_encode(array('ipStatus'=>$flag, 'validationMsg'=> $validationMsg, 'otpStatus'=>$otpStatus));
    }//end of function
}//end of class
new LoginSecurityAddOTPEntryDetails();
?>