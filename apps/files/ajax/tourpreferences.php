<?php

// Check if we are a user
OCP\User::checkLoggedIn();

// Get current user
$user = OC_User::getUser();
$action = isset( $_GET['action'] )? $_GET['action'] : '';

if($action == 'get'){
	OCP\JSON::success(array('data' => OC_Preferences::getValue($user, 'tour', 'nevershow')));
	exit();
} else {
	OC_Preferences::setValue($user, 'tour', 'nevershow', 'true');
	OCP\JSON::success(array('data' => 'OK'));
	exit();
}
?>
