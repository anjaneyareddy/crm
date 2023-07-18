<?php

$now = date("Y-m-d");
//EntryPoint
if(is_dir('custom/LoginSecurity')) {
    $changeLoginSecurityFolderName = 'LoginSecurity'.$now;
    rename("custom/LoginSecurity","custom/".$changeLoginSecurityFolderName);
}

//include
if(is_dir('custom/include/LoginSecurity')){
    $changeLoginSecurityFolderName = 'LoginSecurity'.$now;
    rename("custom/include/LoginSecurity","custom/include/".$changeLoginSecurityFolderName);
}

//images 
if(is_dir('custom/modules/Administration/image/')) {
    $changeLoginSecurityFolderName = 'image'.$now;
    rename("custom/modules/Administration/image","custom/modules/Administration/".$changeLoginSecurityFolderName);
}

//css
if(file_exists('custom/modules/Administration/css/LoginSecurityConfig.css')) {
    $nowLoginSecurityCSS = 'LoginSecurityConfig'.$now.'.'.'css';
    rename("custom/modules/Administration/css/LoginSecurityConfig.css","custom/modules/Administration/css/".$nowLoginSecurityCSS);
}
if(file_exists('custom/modules/Administration/css/LoginSecurityListView.css')) {
    $nowLoginSecurityCSS = 'LoginSecurityListView'.$now.'.'.'css';
    rename("custom/modules/Administration/css/LoginSecurityListView.css","custom/modules/Administration/css/".$nowLoginSecurityCSS);
}

//js
if(file_exists('custom/modules/Administration/js/LoginSecurityConfig.js')) {
    $nowLoginSecurityJs = 'LoginSecurityConfig'.$now.'.'.'js';
    rename("custom/modules/Administration/js/LoginSecurityConfig.js","custom/modules/Administration/js/".$nowLoginSecurityJs);
}
if(file_exists('custom/modules/Administration/js/LoginSecurityListView.js')) {
    $nowLoginSecurityListView = 'LoginSecurityListView'.$now.'.'.'js';
    rename("custom/modules/Administration/js/LoginSecurityListView.js","custom/modules/Administration/js/".$nowLoginSecurityListView);
}

//tpl
if(file_exists('custom/modules/Administration/tpl/loginsecurityconfig.tpl')) {
    $nowLoginSecurityTpl = 'loginsecurityconfig'.$now.'.'.'tpl';
    rename("custom/modules/Administration/tpl/loginsecurityconfig.tpl","custom/modules/Administration/tpl/".$nowLoginSecurityTpl);
}
if(file_exists('custom/modules/Administration/tpl/loginsecuritylistview.tpl')) {
    $nowLoginSecurityTpl = 'loginsecuritylistview'.$now.'.'.'tpl';
    rename("custom/modules/Administration/tpl/loginsecuritylistview.tpl","custom/modules/Administration/tpl/".$nowLoginSecurityTpl);
}

//view
if(file_exists('custom/modules/Administration/views/view.loginsecurityconfig.php')) {
    $nowLoginSecurityConfigPhp = 'view.loginsecurityconfig'.$now.'.'.'php';
    rename("custom/modules/Administration/views/view.loginsecurityconfig.php","custom/modules/Administration/views/".$nowLoginSecurityConfigPhp);
}
if(file_exists('custom/modules/Administration/views/view.loginsecuritylistview.php')) {
    $nowLoginSecurityListViewPhp = 'view.loginsecuritylistview'.$now.'.'.'php';
    rename("custom/modules/Administration/views/view.loginsecuritylistview.php","custom/modules/Administration/views/".$nowLoginSecurityListViewPhp);
}

//Users
if(file_exists('custom/modules/Users/Login.php')) {
    $nowLoginSecurityLogin = 'Login'.$now.'.'.'php';
    rename("custom/modules/Users/Login.php","custom/modules/Users/".$nowLoginSecurityLogin);
}

//custom themes files
//css
if(file_exists('custom/themes/Kiyo/css/LoginSecurityPage.css')) {
    $nowLoginSecurityCSS = 'LoginSecurityPage'.$now.'.'.'css';
    rename("custom/themes/Kiyo/css/LoginSecurityPage.css","custom/themes/Kiyo/css/".$nowLoginSecurityCSS);
}

//js
if(file_exists('custom/themes/Kiyo/js/LoginSecurity.js')) {
    $nowLoginSecurityJs = 'LoginSecurity'.$now.'.'.'js';
    rename("custom/themes/Kiyo/js/LoginSecurity.js","custom/themes/Kiyo/js/".$nowLoginSecurityJs);
}

//tpls
if(file_exists('custom/themes/Kiyo/tpls/loginsecuritypage.tpl')) {
    $nowLoginSecurityTpl = 'loginsecuritypage'.$now.'.'.'tpl';
    rename("custom/themes/Kiyo/tpls/loginsecuritypage.tpl","custom/themes/Kiyo/tpls/".$nowLoginSecurityTpl);
}

//images
if(file_exists('themes/Kiyo/images/LoginSecurity.png')) {
    $nowKiyoLoginSecurityPNG = 'LoginSecurity'.$now.'.'.'png';
    rename("themes/Kiyo/images/LoginSecurity.png","themes/Kiyo/images/".$nowKiyoLoginSecurityPNG);
}
if(file_exists('themes/Kiyo/images/LoginSecurity.svg')) {
    $nowKiyoLoginSecuritySVG = 'LoginSecurity'.$now.'.'.'svg';
    rename("themes/Kiyo/images/LoginSecurity.svg","themes/Kiyo/images/".$nowKiyoLoginSecuritySVG);
}

