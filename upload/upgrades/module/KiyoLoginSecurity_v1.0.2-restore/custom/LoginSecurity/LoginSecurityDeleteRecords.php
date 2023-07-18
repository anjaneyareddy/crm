<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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