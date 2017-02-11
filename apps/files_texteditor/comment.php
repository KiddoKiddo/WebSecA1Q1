<?php
/*

Added by Thy: This class is to handle comments
Referenced by: savecomment.php, deletecomment.php, loadcomments.php

*/
require_once(OC::$APPSROOT . '/apps/files_sharing/lib_share.php');

class OC_Comment {

	public static function saveComment( $user, $source, $line, $comment ){
		error_log('THY comment.php SAVE "'.$user.'" - "'.$source.'" - "'.$line.'" - "'.$comment.'"');
		
		$source = OC_Share::cleanPath($source);
		$query = OCP\DB::prepare("INSERT INTO oc_comments (source, uid, line, comment) values (?,?,?,?)");
 		$query->execute(array($source, $user, $line, $comment));
 		
 		$last_id_query = OCP\DB::prepare('SELECT LAST_INSERT_ID() as last_id');
 		$res = $last_id_query->execute()->fetchAll();
 		return $res[0]["last_id"];
	}
	public static function deleteComment( $comment_id ){
		$query = OCP\DB::prepare("DELETE from *PREFIX*comments WHERE comment_id = ? ");
		$query->execute(array($comment_id));
	}
	public static function loadComments( $source ){
		$query = OCP\DB::prepare("SELECT * FROM *PREFIX*comments WHERE source = ? ");
		$result = $query->execute(array($source))->fetchAll();
		return $result;
	}
}
?>
