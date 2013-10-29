<?php
require_once 'db_config.php';

function get_all_books()
{
	global $connection;
	$query = "SELECT *
			FROM books
			INNER JOIN books_authors ON books.book_id = books_authors.book_id
			INNER JOIN authors ON books_authors.author_id = authors.author_id";
	$result = $connection->query($query);

	$books = array();
	while ($row = $result->fetch_assoc())
	{
		// $books[$row['book_title']]['authors'][$row['author_id']] =  $row['author_name'];
		$books[$row['book_id']]['name'] = $row['book_title'];
		$books[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
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
	$author_id = $connection->real_escape_string($author_id);
	$query = "SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
			FROM books
			INNER JOIN books_authors ON books.book_id = books_authors.book_id
			INNER JOIN authors ON books_authors.author_id = authors.author_id
			WHERE books_authors.book_id IN (
           		SELECT books_authors.book_id
           		FROM books_authors
           		WHERE books_authors.author_id = $author_id)";

/*	$query = "SELECT * FROM books_authors as ba
			INNER JOIN books as b ON ba.book_id = b.book_id
			INNER JOIN books_authors as bba ON bba.book_id = ba.book_id
			INNER JOIN authors as a ON ba.author_id = a.author_id
			WHERE ba.author_id = $author_id";
*/
	$result = $connection->query($query);
	$books = array();
	while ($row = $result->fetch_assoc())
	{
		$books[$row['book_id']]['name'] = $row['book_title'];
		$books[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
	}

	return $books;
}

function get_book_info_by_id($id)
{
	if ( ! is_numeric($id))
	{
		return false;
	}

	global $connection;

	$book_id = trim($id);

	$query = "SELECT books.book_id, books.book_title, authors.author_id, authors.author_name FROM books
			LEFT JOIN books_authors ON books_authors.book_id = books.book_id
			LEFT JOIN authors ON books_authors.author_id = authors.author_id
			WHERE books.book_id = $book_id";

	$result = $connection->query($query);

	$book = array();

	while ($row = $result->fetch_assoc())
	{
		$book['id'] = $row['book_id'];
		$book['book_title'] = $row['book_title'];
		$book['authors'][$row['author_id']] = $row['author_name'];
	}

	return $book;
}