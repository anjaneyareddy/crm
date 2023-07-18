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
class LoginSecurityGetAllUsersGroups{
    public function __construct(){
        $this->getAllUsersGroups();
    } 
    
    public function getAllUsersGroups(){
        $activeUsers = User :: getActiveUsers();
        foreach ($activeUsers as $userId => $userName) {
            $securityGroupUserList[] = array('id' => $userId , 'value' => $userName , 'type' => 'User');
        }//end of foreach

        $securityGroups = get_bean_select_array(true, 'SecurityGroup', 'name', '', 'name', true);
        foreach ($securityGroups as $groupId => $groupName) {
            if($groupId != ''){
                $securityGroupUserList[] = array('id' => $groupId, 'value' => $groupName , 'type' => 'Group');
            }//end of if
        }//end of foreach
        
        echo json_encode($securityGroupUserList);
    }//end of function   
}//end of class
new LoginSecurityGetAllUsersGroups();
?>