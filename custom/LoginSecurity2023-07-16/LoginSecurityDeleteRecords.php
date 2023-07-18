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
class LoginSecurityDeleteRecords{
    public function __construct(){
        $this->deleteLoginSecurityConfig();
    } 
    public function deleteLoginSecurityConfig(){
        if(isset($_POST['delId'])){
            $delId = explode(',',$_POST['delId']);
            foreach($delId as $id){
                //Update Ip Blocking Deleted = 1 
                $fieldData = array('deleted' => 1);
                $whereCondition = array('id' => $id);
                $updateLoginSecurityResult = updateLoginSecurityRecord('kiyo_ip_blocking', $fieldData, $whereCondition, $operator = '=');

                //Update OTP Based Deleted = 1 
                $whereData = array('ip_blocking_id' => $id);
                $updateLoginSecurityResult = updateLoginSecurityRecord('kiyo_otp_based', $fieldData, $whereData, $operator = '=');

            }//end of foreach

            if(!empty($updateLoginSecurityResult)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }//end of function   
}//end of class
new LoginSecurityDeleteRecords();
?>