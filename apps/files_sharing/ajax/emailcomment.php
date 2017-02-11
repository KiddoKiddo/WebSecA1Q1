<?php
OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('files_sharing');

$user = OCP\USER::getUser();

$file = $_POST['file'];

$type = (strpos($file, '.') === false) ? 'folder' : 'file';
$uid_shared_with = $_POST['uid_shared_with'];
$toaddress = $_POST['toaddress'];
$link = $_POST['link'];

$subject = '['.$user.'] invite ['.$uid_shared_with.'] to comment on ['.$file.']';

$text = '['.$user.'] invite ['.$uid_shared_with.'] to comment on ['.$file.'].<br><br>It is available for viewing here: '.$link.'<br><br>';

$fromaddress = OCP\Config::getUserValue($user, 'settings', 'email', 'sharing-noreply@'.OCP\Util::getServerHost());
OCP\Util::sendMail($_POST['toaddress'], $toaddress, $subject, $text, $fromaddress, $user);

?>
