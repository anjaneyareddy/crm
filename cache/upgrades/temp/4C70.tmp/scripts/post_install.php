<?php
function post_install(){ 
	// Redirect to licence validation
	global $sugar_version;
	if(preg_match( "/^6.*/", $sugar_version)) {
		// Quick Repair for labels, Ext, ...
		require_once("modules/Administration/QuickRepairAndRebuild.php");
		$autoexecute = true; //execute the SQL automatically
		$show_output = false; //output to the screen
		$rac = new RepairAndClear();
		$rac->repairAndClearAll(array('clearAll'),array(translate('LBL_ALL_MODULES')),$autoexecute,$show_output);
	} 

	// Clear the cache for controller / Action View / users module (else man will have to wait 300 seconds to let the cache refresh !)
	sugar_cache_clear("CONTROLLER_action_view_map_Users");


	global $sugar_version;
	 
}