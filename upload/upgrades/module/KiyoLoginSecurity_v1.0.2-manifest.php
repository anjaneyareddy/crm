<?php
$manifest = array(
    0 =>
    array(
        'acceptable_sugar_versions' =>
        array(
            0 => '',
        ),
    ),
    1 =>
    array(
        'acceptable_sugar_flavors' =>
        array(
            0 => 'CE',
            1 => 'PRO',
            2 => 'ENT',
        ),
    ),
    'readme' => '',
    'key' => '',
    'author' => 'Kiyo Solutions PVT. LTD',
    'description' => 'Login Security Plugin',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'Login Security',
    'published_date' => '2023-07-16 18:35:10',
    'type' => 'module',
    'version' => 'v1.0.2',
    'remove_tables' => 'prompt',
);
$installdefs = array(
    'id' => 'LoginSecurity',
    'beans' => //remove this bean or replace with your own module name.
    array(
        array(
            'module' => 'KiyoLoginSecurity',
            'class' => 'KiyoLoginSecurity',
            'path' => 'modules/KiyoLoginSecurity/KiyoLoginSecurity.php',
            'tab' => false,
        ),
    ),
    'post_install' => array(0 =>  '<basepath>/scripts/post_install.php',),
    'post_execute' => array(0 =>  '<basepath>/scripts/post_execute.php',),
    'post_uninstall' => array(0 =>  '<basepath>/scripts/post_uninstall.php',),
    'pre_execute' => array(0 =>  '<basepath>/scripts/pre_execute.php',),
    'copy' => array(
        0 => array(
            'from' => '<basepath>/custom/Extension/application/Ext/EntryPointRegistry/LoginSecurityEntryPoint.php',
            'to' => 'custom/Extension/application/Ext/EntryPointRegistry/LoginSecurityEntryPoint.php',
        ),
        1 => array(
            'from' => '<basepath>/custom/Extension/modules/Administration/Ext/ActionViewMap/LoginSecurityAction_View_Map.ext.php',
            'to' => 'custom/Extension/modules/Administration/Ext/ActionViewMap/LoginSecurityAction_View_Map.ext.php',
        ),
        2 => array(
            'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Administration/LoginSecurityAdministration.ext.php',
            'to' => 'custom/Extension/modules/Administration/Ext/Administration/LoginSecurityAdministration.ext.php',
        ),

        3 => array(
            'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/LoginSecurity.en_us.lang.php',
            'to' => 'custom/Extension/modules/Administration/Ext/Language/LoginSecurity.en_us.lang.php',
        ),

        4 => array(
            'from' => '<basepath>/custom/Extension/modules/Users/Ext/Language/LoginSecurityPage.en_us.lang.php',
            'to' => 'custom/Extension/modules/Users/Ext/Language/LoginSecurityPage.en_us.lang.php',
        ),
         
        24 => array(
            'from' => '<basepath>/custom/modules/Administration/css/LoginSecurityConfig.css',
            'to' => 'custom/modules/Administration/css/LoginSecurityConfig.css',
        ),
        25 => array(
            'from' => '<basepath>/custom/modules/Administration/css/LoginSecurityListView.css',
            'to' => 'custom/modules/Administration/css/LoginSecurityListView.css',
        ),
        26 => array(
            'from' => '<basepath>/custom/modules/Administration/image/helpInline.gif',
            'to' => 'custom/modules/Administration/image/helpInline.gif',
        ),
        27 => array(
            'from' => '<basepath>/custom/modules/Administration/js/LoginSecurityConfig.js',
            'to' => 'custom/modules/Administration/js/LoginSecurityConfig.js',
        ),
        28 => array(
            'from' => '<basepath>/custom/modules/Administration/js/LoginSecurityListView.js',
            'to' => 'custom/modules/Administration/js/LoginSecurityListView.js',
        ),
        29 => array(
            'from' => '<basepath>/custom/modules/Administration/tpl/loginsecurityconfig.tpl',
            'to' => 'custom/modules/Administration/tpl/loginsecurityconfig.tpl',
        ),
        30 => array(
            'from' => '<basepath>/custom/modules/Administration/tpl/loginsecuritylistview.tpl',
            'to' => 'custom/modules/Administration/tpl/loginsecuritylistview.tpl',
        ),
        31 => array(
            'from' => '<basepath>/custom/modules/Administration/views/view.loginsecurityconfig.php',
            'to' => 'custom/modules/Administration/views/view.loginsecurityconfig.php',
        ),
        32 => array(
            'from' => '<basepath>/custom/modules/Administration/views/view.loginsecuritylistview.php',
            'to' => 'custom/modules/Administration/views/view.loginsecuritylistview.php',
        ),
        33 => array(
            'from' => '<basepath>/custom/modules/Users/Login.php',
            'to' => 'custom/modules/Users/Login.php',
        ),
       
        35 => array(
            'from' => '<basepath>/custom/themes/Kiyo/css/LoginSecurityPage.css',
            'to' => 'custom/themes/Kiyo/css/LoginSecurityPage.css',
        ),
        36 => array(
            'from' => '<basepath>/custom/themes/Kiyo/js/LoginSecurity.js',
            'to' => 'custom/themes/Kiyo/js/LoginSecurity.js',
        ),
        37 => array(
            'from' => '<basepath>/custom/themes/Kiyo/tpls/loginsecuritypage.tpl',
            'to' => 'custom/themes/Kiyo/tpls/loginsecuritypage.tpl',
        ),
        38 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityAddDetails.php',
            'to' => 'custom/LoginSecurity/LoginSecurityAddDetails.php',
        ),
        39 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityAddOTPEntryDetails.php',
            'to' => 'custom/LoginSecurity/LoginSecurityAddOTPEntryDetails.php',
        ),
        40 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityCheckLoginStatus.php',
            'to' => 'custom/LoginSecurity/LoginSecurityCheckLoginStatus.php',
        ),
        41 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityDeleteRecords.php',
            'to' => 'custom/LoginSecurity/LoginSecurityDeleteRecords.php',
        ),
        42 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityFunction.php',
            'to' => 'custom/LoginSecurity/LoginSecurityFunction.php',
        ),
        43 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityGetAllUsersGroups.php',
            'to' => 'custom/LoginSecurity/LoginSecurityGetAllUsersGroups.php',
        ),
        44 => array(
            'from' => '<basepath>/custom/LoginSecurity/LoginSecurityUpdateStatus.php',
            'to' => 'custom/LoginSecurity/LoginSecurityUpdateStatus.php',
        ),
        45 => array(
            'from' => '<basepath>/modules/KiyoLoginSecurity/',
            'to' => 'modules/KiyoLoginSecurity/',
        ),
        46 => array(
            'from' => '<basepath>/modules/KiyoLoginSecurity/',
            'to' => 'modules/KiyoLoginSecurity/',
        ),
        47 => array(
            'from' => '<basepath>/images/LoginSecurity.png',
            'to' => 'themes/Kiyo/images/LoginSecurity.png',
        ),
        48 => array(
            'from' => '<basepath>/images/LoginSecurity.svg',
            'to' => 'themes/Kiyo/images/LoginSecurity.svg',
        ),
        49 => array(
            'from' => '<basepath>/custom/include/LoginSecurity/LoginSecurity.php',
            'to' => 'custom/include/LoginSecurity/LoginSecurity.php',
        ),
        50 => array(
            'from' => '<basepath>/custom/include/LoginSecurity/css/LoginSecurityIcon.css',
            'to' => 'custom/include/LoginSecurity/css/LoginSecurityIcon.css',
        ),
        51 => array(
            'from' => '<basepath>/custom/Extension/application/Ext/LogicHooks/LoginSecurityLogicHook.php',
            'to' => 'custom/Extension/application/Ext/LogicHooks/LoginSecurityLogicHook.php',
        ),
    ),
);
