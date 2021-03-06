<?php

require_once(OC::$APPSROOT . '/apps/files_texteditor/comment.php');
require_once(OC::$APPSROOT . '/apps/files_sharing/lib_share.php');

OCP\User::checkLoggedIn();
$user = OCP\USER::getUser();

$dir = isset($_POST['dir']) ? $_POST['dir'] : '';
$filename = isset($_POST['filename']) ? $_POST['filename'] : '';
$line = isset( $_POST['line'] )? $_POST['line'] : '';
$comment = isset( $_POST['comment'] )? $_POST['comment'] : '';

$path = $dir.'/'.$filename;
$source = '/'.$user.'/files'.$path;

error_log('THY savecomment.php $path: "'.$path.'"');

// Check permission to save comment if the file is shared
if(strpos($dir, 'Shared') !== false){
	$permission_comment = OC_Share::getPermissionsComment($source);
	if($permission_comment == 0) {
		OCP\JSON::error(array('message' => 'You are not allow to comment on this file.'));
		exit();
	}
	// Source is not source, but target
	$source = OC_Share::getSource($source);
}
error_log('THY savecomment.php $source: "'.$source.'"');

$comment_id = OC_Comment::saveComment($user, $source, $line, $comment);
OCP\JSON::success(array('comment_id' => $comment_id));
exit();
?>
