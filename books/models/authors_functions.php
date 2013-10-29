<?php

require_once 'db_config.php';

function create_new_author($author = array())
{
	global $connection;
	$stmt = $connection->prepare('INSERT INTO authors (author_name) VALUES (?)');
	$stmt->bind_param('s', $author['author_name']);
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
	$stmt->bind_param('s', $author_name);
	$stmt->execute();

	return (bool)$stmt->fetch();
}

function is_author_ids_exist($authors_ids = array())
{
	if ( ! is_array($authors_ids))
	{
		return false;
	}
	global $connection;

	$authors_ids_values = implode($authors_ids, ', ');
	$query = "SELECT * FROM authors WHERE author_id IN (" . $authors_ids_values . ")";
	$result = $connection->query($query);
	if (count($authors_ids) > $result->num_rows)
	{
		return false;
	}
	return true;
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