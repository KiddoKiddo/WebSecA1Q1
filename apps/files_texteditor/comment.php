<?php
/*

Added by Thy: This class is to handle comments
Referenced by: savecomment.php, deletecomment.php, loadcomments.php

*/
class OC_Comment {

	public static function saveComment( $user, $file, $line, $comment ){
		error_log($user.$file.$comment);
	}
	public static function deleteComment( $comment_id ){
	
	}
	public static function loadComments( $user, $file ){

	}
}
?>
