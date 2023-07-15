<?php
$manifest = array(
  'acceptable_sugar_flavors' => array(
	  'CE',
  ),
  'acceptable_sugar_versions' =>  array (
      'regex_matches' => array (
        '6.5.*',
      ),
  ),
  'readme' => '',
	'key' => 'kiyo_',
	'author' => 'Kiyo Solutions',
  'description' => 'CRM Administrators can login as any regular user without prompting for their password',
  'is_uninstallable' => true,
  'name' => 'Sudo Login',
  'published_date' => '17-06-2023',
  'type' => 'module',
  'version' => '1.0',
  'dependencies' => array(),
);

$installdefs = array(
  'id' => 'kiyo_SudoLogin',
  'beans' =>
  array (
      array (
        'module' => 'SudoLoginAddon',
        'class' => 'SudoLoginAddon',
        'path' => 'modules/SudoLoginAddon/SudoLoginAddon.php',
        'tab' => false,
      ),
  ),
  'copy' => 
  array(
      array (
        'from' => '<basepath>/license',
        'to' => 'modules/SudoLoginAddon',
      ),
      array(
        'from' => '<basepath>/custom/Extension/modules/Users/Ext/ActionViewMap/',
        'to' => 'custom/Extension/modules/Users/Ext/ActionViewMap/',
      ),
      array(
        'from' => '<basepath>/custom/Extension/modules/Users/Ext/Language/',
        'to' => 'custom/Extension/modules/Users/Ext/Language/',
      ),
  	  array(
  		  'from' => '<basepath>/custom/modules/Users/views/',
  		  'to' => 'custom/modules/Users/views/',
      ),
      array(
        'from' => '<basepath>/custom/Extension/modules/Home/',
        'to' => 'custom/Extension/modules/Home/',
      ),
      array(
        'from' => '<basepath>/custom/modules/Home/',
        'to' => 'custom/modules/Home/',
      ),
      array(
        'from' => '<basepath>/custom/Extension/modules/Users/Ext/Menus/',
        'to' => 'custom/Extension/modules/Users/Ext/Menus/',
      ),
  ),
  'mkdir' => 
  array(
    'custom/modules/Home/',
    'custom/modules/Users/',
    'custom/modules/Users/views/',
    'custom/Extension/',
    'custom/Extension/modules/',
    'custom/Extension/modules/Users/',
    'custom/Extension/modules/Users/Ext/',
    'custom/Extension/modules/Users/Ext/ActionViewMap/',
    'custom/Extension/modules/Users/Ext/Language/',
  ),
  'administration' => 
	array(
		array(
			'from'=>'<basepath>/license_admin/menu/SudoLoginAddon_admin.php',
			'to' => 'modules/Administration/SudoLoginAddon_admin.php',
		),
	),
	'action_view_map' =>
	array (
		array(
			'from'=> '<basepath>/license_admin/actionviewmap/SudoLoginAddon_actionviewmap.php',
			'to_module'=> 'SudoLoginAddon',
		),
  ),
  'language' =>
  array (
    array(
        'from'=> '<basepath>/license_admin/language/en_us.SudoLoginAddon.php',
        'to_module'=> 'Administration',
        'language'=>'en_us'
    ),
    array(
      'from'=> '<basepath>/license_admin/language/fr_FR.SudoLoginAddon.php',
      'to_module'=> 'Administration',
      'language'=>'fr_FR'
    ),
  ),
);
