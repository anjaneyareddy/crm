<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("custom/LoginSecurity/LoginSecurityFunction.php");
class LoginSecurityUpdateStatus{
    public function __construct(){
        $this->updateLoginSecurityStatus();
    } 
    public function updateLoginSecurityStatus(){
        $dateModified = date("Y-m-d H:i:s");

        if(isset($_REQUEST['id']) && isset($_REQUEST['enableLoginSecurity'])){
            $fieldNames = array('status'=>"'".$_REQUEST['enableLoginSecurity']."'", 'date_modified'=>"'".$dateModified."'");
            $whereCondition = array('id'=>$_REQUEST['id']);
            $updateLoginSecurityStatus = updateLoginSecurityRecord("kiyo_ip_blocking", $fieldNames, $whereCondition, $operator = '=');

            if($_REQUEST['enableLoginSecurity'] == "Active"){
                $fieldNames = array('status'=>"'Inactive'");
                $where = array('id'=>$_REQUEST['id']);
                $updateLoginSecurityStatus = updateLoginSecurityRecord("kiyo_ip_blocking", $fieldNames, $where, $operator = '!=');
            }  
        }else if(isset($_REQUEST['recordId']) && isset($_REQUEST['enableLoginSecurity'])){
            $recordIds = explode(',', $_REQUEST['recordId']);
            foreach($recordIds as $id){
                $fieldNames = array('status'=>"'".$_REQUEST['enableLoginSecurity']."'", 'date_modified'=>"'".$dateModified."'");
                $whereCondition = array('id'=>$id);
                $updateLoginSecurityStatus = updateLoginSecurityRecord("kiyo_ip_blocking", $fieldNames, $whereCondition, $operator = '=');

                if($_REQUEST['enableLoginSecurity'] == "Active"){
                    $fieldNames = array('status'=>"'Inactive'");
                    $where = array('id'=>$id);
                    $updateLoginSecurityStatus = updateLoginSecurityRecord("kiyo_ip_blocking", $fieldNames, $where, $operator = '!=');
                }
            } 
        }
        if(!empty($updateLoginSecurityStatus)){
            echo 1;
        }else{
            echo 0;
        }
    }
}//end of class
new LoginSecurityUpdateStatus();
?>
