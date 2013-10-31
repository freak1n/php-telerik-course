<?php

require_once 'db_config.php';

function get_comments_by_book_id($book_id)
{
	if ( ! is_numeric($book_id))
	{
		return FALSE;
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

function add_new_comment($comment_text, $book_id, $user_id)
{
	if (mb_strlen($comment_text) <= 0 OR ! is_numeric($book_id) OR ! is_numeric($user_id))
	{
		return FLASE;
	}

	global $connection;
	$stmt = $connection->prepare("INSERT INTO comments (content, user_id, book_id) VALUES (?, ?, ?)");
	$stmt->bind_param('sss', $comment_text, $user_id, $book_id);
	$stmt->execute();

	if ($connection->error)
	{
		return FALSE;
	}
	return TRUE;
}