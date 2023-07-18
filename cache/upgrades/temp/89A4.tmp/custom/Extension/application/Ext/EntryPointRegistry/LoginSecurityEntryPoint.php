<?php

$entry_point_registry['LoginSecurityGetAllUsersGroups'] = array(
    'file' => 'custom/LoginSecurity/LoginSecurityGetAllUsersGroups.php',
    'auth' => true
);

$entry_point_registry['LoginSecurityAddDetails'] = array(
	'file' => 'custom/LoginSecurity/LoginSecurityAddDetails.php',
    'auth' => true
);

$entry_point_registry['LoginSecurityUpdateStatus'] = array(
	'file' => 'custom/LoginSecurity/LoginSecurityUpdateStatus.php',
	'auth' => true	
);

$entry_point_registry['LoginSecurityDeleteRecords'] = array(
	'file' => 'custom/LoginSecurity/LoginSecurityDeleteRecords.php',
	'auth' => true	
);

$entry_point_registry['LoginSecurityCheckLoginStatus'] = array(
	'file' => 'custom/LoginSecurity/LoginSecurityCheckLoginStatus.php',
	'auth' => false
);

$entry_point_registry['LoginSecurityAddOTPEntryDetails'] = array(
	'file' => 'custom/LoginSecurity/LoginSecurityAddOTPEntryDetails.php',
    'auth' => false
);