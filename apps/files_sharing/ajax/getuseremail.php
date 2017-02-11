<?php

OCP\JSON::checkAppEnabled('files_sharing');
OCP\JSON::checkLoggedIn();

$user = $_GET['uid_shared_with'];

$query = OCP\DB::prepare("SELECT email FROM *PREFIX*users WHERE uid = ?");
$email = $query->execute(array($user))->fetchAll();

OCP\JSON::success(array('data' => $email[0]));
	
?>
