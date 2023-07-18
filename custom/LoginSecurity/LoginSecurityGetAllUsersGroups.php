<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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