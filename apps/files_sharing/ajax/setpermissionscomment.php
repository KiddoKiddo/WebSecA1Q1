<?php
require_once(OC::$APPSROOT . '/apps/files_sharing/lib_share.php');

OCP\JSON::checkAppEnabled('files_sharing');
OCP\JSON::checkLoggedIn();

$source = '/'.OCP\USER::getUser().'/files'.$_POST['source'];
$uid_shared_with = $_POST['uid_shared_with'];
$permissions_comment = $_POST['permissions_comment'];

error_log('THY setpermissionscomment.php "'.$source.'" - "'.$uid_shared_with.'" - "'.$permissions_comment.'"');
OC_Share::setPermissionsComment($source, $uid_shared_with, $permissions_comment);

OCP\JSON::success();

?>
