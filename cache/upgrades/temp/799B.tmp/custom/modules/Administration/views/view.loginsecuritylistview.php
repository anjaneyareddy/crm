<?php

require_once('custom/LoginSecurity/LoginSecurityFunction.php');
require_once('include/MVC/View/SugarView.php');
class Viewloginsecuritylistview extends SugarView {
	public function __construct() {
		parent::init();
	}//end of function

	public function display() {
        global $theme, $current_user, $mod_strings;
        
        $fieldNames = array('*');
        $whereCondition = array('deleted'=>0);
        $orderBy = array('date_modified'=>'DESC');
        $getLoginSecurityData = getLoginSecurityRecord('kiyo_ip_blocking', $fieldNames, $whereCondition, $orderBy);
        $getLoginSecurityDataResult = $GLOBALS['db']->query($getLoginSecurityData);

        $dateFormat = $current_user->getPreference('datef');

        $loginSecurityData = array();  
        if(!empty($getLoginSecurityDataResult)){
            while($getLoginSecurityDataRow=$GLOBALS['db']->fetchByAssoc($getLoginSecurityDataResult)){
                $loginSecurityData[] = array(
                    "id" => $getLoginSecurityDataRow['id'],
                    "blockingType" => $getLoginSecurityDataRow['ip_blocking_type'],
                    "usersIpBlocking" => $getLoginSecurityDataRow['users_type_ip_blocking'],
                    "status" => $getLoginSecurityDataRow['status'],
                    "dateEntered" => date($dateFormat.' '.'H:i', strtotime($getLoginSecurityDataRow['date_entered'])),
                    "dateModified" => date($dateFormat.' '.'H:i', strtotime($getLoginSecurityDataRow['date_modified']))
                );
            }
        }//end of function

        $editViewURL = "index.php?module=Administration&action=loginsecurityconfig";
        $adminViewURL = "index.php?module=Administration&action=index";

       

        $smarty = new Sugar_Smarty();
        $smarty->assign('MOD', $mod_strings);
        $smarty->assign('THEME', $theme);
        $smarty->assign('LOGIN_SECURITY_DATA', $loginSecurityData);
        $smarty->assign('EDIT_VIEW_URL', $editViewURL);
        $smarty->assign('ADMINISTRATION_VIEW', $adminViewURL);
        
        parent::display();
		$smarty->display('custom/modules/Administration/tpl/loginsecuritylistview.tpl');
	}//end of function
}//end of class