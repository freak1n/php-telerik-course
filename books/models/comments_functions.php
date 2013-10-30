<?php

require_once 'db_config.php';

function get_comments_by_book_id($book_id)
{
	if ( ! is_numeric($book_id))
	{
		return false;
	}

	global $connection;
	$book_id = trim($connection->real_escape_string($book_id));

	$query = "SELECT comments.id AS comment_id, comments.content, comments.user_id, users.username
			FROM comments
			LEFT JOIN users ON users.id = comments.user_id
			WHERE book_id = $book_id";

	$result = $connection->query($query);

	$comments = array();
	while ($row = $result->fetch_assoc())
	{
		$comments[] = array(
			'comment_id' => $row['comment_id'],
			'content' => $row['content'],
			'user_id' => $row['user_id'],
			'username' => $row['username'],
		);
	}
	return $comments;
}

function add_comment($comment_text, $book_id, $user_id)
{

}