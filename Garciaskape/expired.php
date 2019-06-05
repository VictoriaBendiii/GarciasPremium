<?php
function isLoginSessionExpired() {
	$login_session_duration = 600; // 10 MINUTES DURATION
	$current_time = time();
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION['login_user'])){
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
			return true;
		}
	}
	return false;
}
?>
