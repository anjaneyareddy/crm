<?php
    if($GLOBALS['current_user']->isAdmin() && !empty($_REQUEST['record'])) {
        $targetUserToLog = BeanFactory::getBean('Users', $_REQUEST['record']);
        if (!is_admin($targetUserToLog)) {
            $module_menu[] = array(
                "index.php?module=Users&action=SudoLogin_Connect&record=".$_REQUEST['record'],
                $mod_strings['LBL_SUDOLOGIN_LOGIN_AS']. " " . $targetUserToLog->user_name,
                "user"
            );
        };
    }
