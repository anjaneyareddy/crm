<?php
	class ViewSudologin_disconnect extends SugarView {
		public function display() {
			if(!empty($_SESSION['sudologin_user']) && is_admin($_SESSION['sudologin_user'])) {
				$GLOBALS['log']->debug("[SudoLogin] ".$_SESSION['sudologin_user']->user_name." is logging out from ".$GLOBALS['current_user']->user_name);
		
				$GLOBALS['current_user'] = $_SESSION['sudologin_user']; // Session saved information back to current_user
				$_SESSION['authenticated_user_id'] = $GLOBALS['current_user']->id; // Setting back the right user id in session as well
				unset($_SESSION['sudologin_user']); // destroy the session temp variable used
			
				header('Location: index.php?module=Home&action=index'); // Redirect to Homepage
			}
			else {
				header('Location: index.php?module=Home&action=index'); // Do nothing as we are not admin or no record, just redirect on home page
			}
			exit;
		}
	}
	