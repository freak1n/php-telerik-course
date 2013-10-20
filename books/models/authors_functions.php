<?php

require_once 'db_config.php';

function create_new_author($author = array())
{
	global $connection;
	mysqli_real_escape_string($connection, $author['author_name']);
	$stmt = $connection->prepare('INSERT INTO authors (author_name) VALUES (?)');
	$stmt->bind_param('s', $author['author_name']);
	$stmt->execute();

	return TRUE;
}

function is_author_exists($author_name)
{
	global $connection;
	mysqli_real_escape_string($connection, $author_name);
	$stmt = $connection->prepare('SELECT * FROM authors WHERE author_name=? LIMIT 1');
	$stmt->bind_param('s', $author_name);
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
	$authors = array();
	while ($row = $result->fetch_assoc())
	{
		$authors[$row['author_id']] = $row['author_name'];
	}		
	return $authors;
}