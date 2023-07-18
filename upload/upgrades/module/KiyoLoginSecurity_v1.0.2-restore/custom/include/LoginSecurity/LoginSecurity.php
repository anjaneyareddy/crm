<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class LoginSecurity{
	function LoginSecurityGetData($event, $arguments){
		if($GLOBALS['app']->controller->module  == "Administration" || $GLOBALS['app']->controller->action == 'index'){
	        global $suitecrm_version;
			if (version_compare($suitecrm_version, '7.10.2', '>=')){
	    		echo '<link rel="stylesheet" type="text/css" href="custom/include/LoginSecurity/css/LoginSecurityIcon.css">';
	      	}
		}
	}//end of function
}//end of class