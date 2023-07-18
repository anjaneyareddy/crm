<?php

if(!isset($hook_array) || !is_array($hook_array)) {
    $hook_array = array();
}
if(!isset($hook_array['after_ui_frame']) || !is_array($hook_array['after_ui_frame'])) {
    $hook_array['after_ui_frame'] = array();
}
$hook_array['after_ui_frame'][] = array(
	1, //Hook version
	'LoginSecurity',  //Label
	'custom/include/LoginSecurity/LoginSecurity.php', //Include file
	'LoginSecurity', //Class
	'LoginSecurityGetData' //Method
);
