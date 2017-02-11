<?php

require_once(OC::$APPSROOT . '/apps/files_texteditor/comment.php');
require_once(OC::$APPSROOT . '/apps/files_sharing/lib_share.php');

OCP\User::checkLoggedIn();
$user = OCP\USER::getUser();

$dir = isset($_POST['dir']) ? $_POST['dir'] : '';
$filename = isset($_POST['filename']) ? $_POST['filename'] : '';
$comment_id = isset( $_POST['comment_id'] )? $_POST['comment_id'] : '';

$path = $dir.'/'.$filename;
$source = '/'.$user.'/files'.$path;

error_log('THY deletecomment.php $path: "'.$path.'"');

// Check permission to delete comment
if(strpos($dir, 'Shared') !== false){
	$permission_comment = OC_Share::getPermissionsComment($source);
	if($permission_comment == 0) {
		OCP\JSON::error(array('message' => 'You are not allow to delete comments on this file.'));
		exit();
	}
	// Source is not source, but target
	$source = OC_Share::getSource($source);
}

error_log('THY deletecomment.php $path: "'.$source.'"');

OC_Comment::deleteComment($comment_id);
OCP\JSON::success(array('OK' => true));
exit();
?>
