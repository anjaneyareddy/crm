<?php
	global $current_user;
	if(!empty($_SESSION['sudologin_user'])) {
		$module_menu[] = Array(
			"index.php?module=Users&action=SudoLogin_Disconnect",
			$mod_strings['LBL_SUDOLOGIN_LOGOUT_AS']." ".$current_user->user_name,
			"subtract"
		);
	}
	elseif (is_admin($current_user) && $_REQUEST['module']=="Home") {
		$module_menu[] = Array(
			"#UserSelection",
			$mod_strings['LBL_SUDOLOGIN_LOGIN_AS'],
			"user"
		);
	}