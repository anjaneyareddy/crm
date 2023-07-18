<?php

global $db;
$db->dropTableName('kiyo_ip_blocking');
$db->dropTableName('kiyo_otp_based');
$db->dropTableName('kiyo_login_otp_entry');


$sqlLoginSecurity = "DELETE from config where name = 'login-security'";
$result = $GLOBALS['db']->query($sqlLoginSecurity);

$sqlLicenseKey = "DELETE from config where name = 'lic_login-security'";
$result2 = $GLOBALS['db']->query($sqlLicenseKey);