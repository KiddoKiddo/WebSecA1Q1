<?php

require_once(OC::$APPSROOT . '/apps/files_texteditor/comment.php');
require_once(OC::$APPSROOT . '/apps/files_sharing/lib_share.php');

OCP\User::checkLoggedIn();
$user = OCP\USER::getUser();

$dir = isset($_GET['dir']) ? $_GET['dir'] : '';
$filename = isset($_GET['filename']) ? $_GET['filename'] : '';

$path = $dir.'/'.$filename;
$source = '/'.$user.'/files'.$path;

error_log('THY getcomments.php $path: "'.$path.'"');

// Check permissions to comment for this user
$permissions_comment = 1;
$isOwner = true;
if(strpos($dir, 'Shared') !== false){
	// If it is shared file, re-check permissions to comment
	$permissions_comment = OC_Share::getPermissionsComment($source);
	// Source is not source, but target
	$source = OC_Share::getSource($source);
	// If access through 'Shared' link then not the owner
	$isOwner = false;
}
error_log('THY getcomments.php $source: "'.$source.'"');

$comments = OC_Comment::loadComments($source);
OCP\JSON::success(array('comments' => $comments, 'permissions_comment' => $permissions_comment, 'is_owner' => $isOwner));
exit();

?>
