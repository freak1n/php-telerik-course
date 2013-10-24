<?php

require_once 'db_config.php';

function create_new_author($author = array())
{
	global $connection;
	$stmt = $connection->prepare('INSERT INTO authors (author_name) VALUES (?)');
	$stmt->bind_param('s', $connection->real_escape_string($author['author_name']));
	$stmt->execute();

	if ($connection->error)
	{
		return 'Database error';
	}
	return $connection->insert_id;
}

function is_author_exists($author_name)
{
	global $connection;
	$stmt = $connection->prepare('SELECT * FROM authors WHERE author_name=? LIMIT 1');
	$stmt->bind_param('s', $connection->real_escape_string($author_name));
	$stmt->execute();

	return (bool)$stmt->fetch();
}

function get_author_name_by_id($id)
{
	global $connection;
	$connection->real_escape_string($id);
	$query = "SELECT author_name FROM authors WHERE author_id = $id LIMIT 1";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();

	return $row['author_name'];
}

function get_all_authors()
{
	global $connection;
	$query = "SELECT *
			FROM authors";
	$result = $connection->query($query);
	if ($connection->error)
		return FALSE;

	$authors = array();
	while ($row = $result->fetch_assoc())
	{
		$authors[$row['author_id']] = $row['author_name'];
	}
	return $authors;
}