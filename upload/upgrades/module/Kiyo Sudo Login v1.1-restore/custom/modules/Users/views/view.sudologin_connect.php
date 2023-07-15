<?php
	class ViewSudologin_connect extends SugarView {
		public function display() {

			 
				if(is_admin($GLOBALS['current_user']) && !empty($_REQUEST['record'])) {
					require_once('modules/Users/User.php');
					$targetUser = BeanFactory::getBean('Users', $_REQUEST['record']);
					if($targetUser != null && !is_admin($targetUser)) {
						$GLOBALS['log']->debug("[SudoLogin] ".$GLOBALS['current_user']->user_name." is logging in as ".$targetUser->user_name);
						$_SESSION['sudologin_user'] = $GLOBALS['current_user']; // Memorize current logged in user in Session
						$GLOBALS['current_user'] = $targetUser; // Switch connected User to targetUser
						$_SESSION['authenticated_user_id'] = $targetUser->id; // Sugar/Suite is also keeping the user id in Session	
						header('Location: index.php?module=Home&action=index'); // Simple Redirect to Homepage for now
					}
					else {
						header('Location: index.php?module=Home&action=index'); // Do nothing : target is admin
					}
				}
				else {
					header('Location: index.php?module=Home&action=index'); // Do nothing as we are not admin or no record, just redirect on home page
				}
				exit;
			
		}
	}