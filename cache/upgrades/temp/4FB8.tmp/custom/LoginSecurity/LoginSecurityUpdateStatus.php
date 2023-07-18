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
