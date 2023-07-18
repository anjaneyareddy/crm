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