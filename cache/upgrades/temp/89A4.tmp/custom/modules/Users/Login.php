<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('custom/LoginSecurity/LoginSecurityFunction.php');
/** @var AuthenticationController $authController */
$authController->authController->pre_login();

global $current_language, $mod_strings, $app_strings, $app_list_strings, $app_language, $sugar_config;

if (isset($_REQUEST['login_language'])) {
    $lang = $_REQUEST['login_language'];
    $_REQUEST['ck_login_language_20'] = $lang;
    $current_language = $lang;
    $_SESSION['authenticated_user_language'] = $lang;
    $mod_strings = return_module_language($lang, 'Users');
    $app_strings = return_application_language($lang);
}
$sugar_smarty = new Sugar_Smarty();
echo '<link rel="stylesheet" type="text/css" media="all" href="' . getJSPath('modules/Users/login.css') . '">';
echo '<script type="text/javascript" src="' . getJSPath('modules/Users/login.js') . '"></script>';

// Get the login page image
$login_image = is_file('custom/include/images/sugar_md.png') ?
    '<IMG src="custom/include/images/sugar_md.png" alt="Sugar" width="340" height="25">' :
    '<IMG src="include/images/sugar_md_open.png" alt="Sugar" width="340" height="25" style="margin: 5px 0;">';

$login_image_url = SugarThemeRegistry::current()->getImageURL('company_logo.png');
$login_image = '<IMG src="' . $login_image_url . '" alt="KiyoCRM" style="margin: 5px 0;">';

$sugar_smarty->assign('LOGIN_IMAGE', $login_image);

// See if any messages were passed along to display to the user.
if (isset($_COOKIE['loginErrorMessage'])) {
    if (!isset($_REQUEST['loginErrorMessage'])) {
        $_REQUEST['loginErrorMessage'] = $_COOKIE['loginErrorMessage'];
    }
    SugarApplication::setCookie('loginErrorMessage', '', time() - 42000);
}
if (isset($_REQUEST['loginErrorMessage'])) {
    if (isset($mod_strings[$_REQUEST['loginErrorMessage']])) {
        $sugar_smarty->assign('LOGIN_ERROR_MESSAGE', $mod_strings[$_REQUEST['loginErrorMessage']]);
    } else {
        if (isset($app_strings[$_REQUEST['loginErrorMessage']])) {
            $sugar_smarty->assign('LOGIN_ERROR_MESSAGE', $app_strings[$_REQUEST['loginErrorMessage']]);
        }
    }
}

$lvars = $GLOBALS['app']->getLoginVars();
$sugar_smarty->assign('LOGIN_VARS', $lvars);
foreach ((array)$lvars as $k => $v) {
    $sugar_smarty->assign(strtoupper($k), $v);
}

// Retrieve username from the session if possible.
if (isset($_SESSION['login_user_name'])) {
    if (isset($_REQUEST['default_user_name'])) {
        $login_user_name = $_REQUEST['default_user_name'];
    } else {
        $login_user_name = $_SESSION['login_user_name'];
    }
} else {
    if (isset($_REQUEST['default_user_name'])) {
        $login_user_name = $_REQUEST['default_user_name'];
    } elseif (isset($_REQUEST['ck_login_id_20'])) {
        $login_user_name = get_user_name($_REQUEST['ck_login_id_20']);
    } else {
        $login_user_name = $sugar_config['default_user_name'];
    }
    $_SESSION['login_user_name'] = $login_user_name;
}
$sugar_smarty->assign('LOGIN_USER_NAME', $login_user_name);

if (isset($GLOBALS['app_strings']["\x4c\x4f\x47\x49\x4e\x5f\x4c\x4f\x47\x4f\x5f\x45\x52\x52\x4f\x52"])) {
    $mod_strings['VLD_ERROR'] =
        $GLOBALS['app_strings']["\x4c\x4f\x47\x49\x4e\x5f\x4c\x4f\x47\x4f\x5f\x45\x52\x52\x4f\x52"];
}

// Retrieve password from the session if possible.
if (isset($_SESSION['login_password'])) {
    $login_password = $_SESSION['login_password'];
} else {
    $login_password = $sugar_config['default_password'];
    $_SESSION['login_password'] = $login_password;
}
$sugar_smarty->assign('LOGIN_PASSWORD', $login_password);

if (isset($_SESSION['login_error'])) {
    $sugar_smarty->assign('LOGIN_ERROR', $_SESSION['login_error']);
}
if (isset($_SESSION['waiting_error'])) {
    $sugar_smarty->assign('WAITING_ERROR', $_SESSION['waiting_error']);
}

if (isset($_REQUEST['ck_login_language_20'])) {
    $display_language = $_REQUEST['ck_login_language_20'];
} else {
    $display_language = $sugar_config['default_language'];
}

if (empty($GLOBALS['sugar_config']['passwordsetting']['forgotpasswordON'])) {
    $sugar_smarty->assign('DISPLAY_FORGOT_PASSWORD_FEATURE', 'none');
}

$the_languages = get_languages();
if (count($the_languages) > 1) {
    $sugar_smarty->assign('SELECT_LANGUAGE', get_select_options_with_id($the_languages, $display_language));
}
$the_themes = SugarThemeRegistry::availableThemes();
if (!empty($logindisplay)) {
    $sugar_smarty->assign('LOGIN_DISPLAY', $logindisplay);
}

$fieldNames = array('*');
$whereData = array('status' => 'Active', 'deleted' => 0);
$ipBlockingQuery = getLoginSecurityRecord('kiyo_ip_blocking', $fieldNames, $whereData, $orderBy=array());      
$ipBlockingRow = $GLOBALS['db']->fetchOne($ipBlockingQuery);
$sugar_smarty->assign('IP_BLOCKING_DATA', $ipBlockingRow);
$sugar_smarty->assign('MOD', $mod_strings);

if(!empty($ipBlockingRow)){
    $sugar_smarty->display('custom/themes/Kiyo/tpls/loginsecuritypage.tpl');
}else{
    if (file_exists('custom/themes/' . SugarThemeRegistry::current() . '/login.tpl')) {
        $sugar_smarty->display('custom/themes/' . SugarThemeRegistry::current() . '/login.tpl');
    }elseif (file_exists('custom/modules/Users/login.tpl')) {
        $sugar_smarty->display('custom/modules/Users/login.tpl');
    }elseif (file_exists('themes/' . SugarThemeRegistry::current() . '/tpls/login.tpl')) {
        $sugar_smarty->display('themes/' . SugarThemeRegistry::current() . '/tpls/login.tpl');
    }elseif (file_exists('modules/Users/login.tpl')) {
        $sugar_smarty->display('modules/Users/login.tpl');
    }else{
        echo "<span class='error'>" . $mod_strings['LBL_MISSING_TEMPLATE'] . '</span>';
        $GLOBALS['log']->fatal('login.tpl not found');
        throw new RuntimeException('login.tpl not found');
    }
}//end of function 
