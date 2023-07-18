<?php 
 //WARNING: The contents of this file are auto-generated 

require_once('custom/LoginSecurity/LoginSecurityFunction.php'); 
require_once('include/MVC/Controller/SugarController.php');
global $sugar_config, $theme;
$dynamicURL = $sugar_config['site_url']; 
foreach ($admin_group_header as $key => $value) {
    $values[] = $value[0];
} //end of foreach   
if (in_array("Other", $values)) {
    $array['LoginSecurity'] = array(
        'LoginSecurity',
        $mod_strings["LBL_LOGIN_SECURITY"],
        $mod_strings["LBL_LOGIN_SECURITY_DESCRIPTION"],
        './index.php?module=Administration&action=loginsecuritylistview',
        'login-security'
    );
    $admin_group_header['Other'][3]['Administration'] = array_merge($admin_group_header['Other'][3]['Administration'], $array);
} else {
    $admin_option_defs = array();
    $admin_option_defs['Administration']['LoginSecurity'] = array(
        //Icon name. Available icons are located in ./themes/default/images
        'LoginSecurity',

        //Link name label 
        $mod_strings["LBL_LOGIN_SECURITY"],

        //Link description label
        $mod_strings["LBL_LOGIN_SECURITY_DESCRIPTION"],

        //Link URL
        './index.php?module=Administration&action=loginsecuritylistview',
        'login-security',
    );
    $admin_group_header['Other'] = array(
        //Section header label
        'Other',

        //$other_text parameter for get_form_header()
        '',

        //$show_help parameter for get_form_header()
        false,

        //Section links
        $admin_option_defs,

        //Section description label
        ''
    );
}//end of else   
