<?php

require_once(OC::$APPSROOT . '/apps/files_texteditor/comment.php');

OCP\User::checkLoggedIn();

$user = OC_User::getUser();
$filePath = '';
$line = isset( $_POST['line'] )? $_POST['line'] : '';
$comment = isset( $_POST['comment'] )? $_POST['comment'] : '';

$comment_id = OC_Comment::saveComment($user, $filePath, $line, $comment);

OCP\JSON::success(array('comment_id' => $comment_id));
exit();

?>
