<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//At bottom of post_install - redirect to license validation page 
function post_install() {
    //install table for user management
    global $sugar_version;
    require_once("modules/Administration/QuickRepairAndRebuild.php"); 
    $repairRebuild = new RepairAndClear(); 
    $repairRebuild ->repairAndClearAll(array('clearAll'), array(translate('LBL_ALL_MODULES')), FALSE, TRUE);

     
}//end of function
?>