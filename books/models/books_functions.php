<?php
require_once 'db_config.php';

function get_all_books()
{
	global $connection;
	$query = "SELECT *
			FROM books
			LEFT JOIN books_authors ON books.book_id = books_authors.book_id
			LEFT JOIN authors ON books_authors.author_id = authors.author_id";
	$result = $connection->query($query);

	$books = array();
	while ($row = $result->fetch_assoc())
	{
		$books[$row['book_title']]['authors'][$row['author_id']] =  $row['author_name'];
	}

	return $books;
}

function create_new_book($book_name, $authors = array())
{
	global $connection;
	$stmt_insert_book = $connection->prepare('INSERT INTO books (book_title) VALUES (?)');
	$stmt_insert_book->bind_param('s', $book_name);
	$stmt_insert_book->execute();

	$added_book_id = $connection->insert_id;

	$join_table_values = array();

	foreach ($authors as $author_id)
	{
		$join_table_values[] = "($added_book_id, $author_id)";
	}

	$join_table_values_str = implode($join_table_values, ', ');

	$query = "INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES $join_table_values_str";
	$connection->query($query);

	return true;
}

function get_all_books_by_author_id($author_id)
{
	global $connection;
	$connection->real_escape_string($author_id);
	$query = "SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
			FROM books
			INNER JOIN books_authors ON books.book_id = books_authors.book_id
			INNER JOIN authors ON books_authors.author_id = authors.author_id
			WHERE books_authors.book_id IN (
           		SELECT books_authors.book_id
           		FROM books_authors
           		WHERE books_authors.author_id = $author_id)";

	$result = $connection->query($query);
	$books = array();
	while ($row = $result->fetch_assoc())
	{
		$books[$row['book_title']]['authors'][$row['author_id']] =  $row['author_name'];
	}

	return $books;
}