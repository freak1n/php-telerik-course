<?php  
$explain = 'EXPLAIN SELECT * FROM `first_table` WHERE 1';

// Select two tables
$sql1 = "SELECT * FROM users, pictures WHERE users.id = 1";

// With саме user ids
$sql2 = "SELECT * FROM users, pictures WHERE users.id = 1 AND pictures.user_id = users.id";

// LEFT JOIN
$left_join = "SELECT * FROM users LEFT JOIN pictures ON users.id = pictures.user_id WHERE users.id = 1";

// LEFT JOIN with AS
$left_join_as =
	"SELECT users.id AS user_id, pictures.picture_name
	FROM users
	LEFT JOIN pictures ON users.id = pictures.user_id
	WHERE users.id =1";

/*	
	LEFT JOIN
	Give me all results from left table (users) and these from right table (pictures) 
	who meet the statements (usrers.id = pictures.user_id)
	if no met the statements then will be returned null
	Where clause is for left table
*/

// INNER JOIN
$inner_join = "SELECT * FROM users INNER JOIN pictures WHERE users.id = pictures.user_id";

/*
	INNER JOIN
	returns only records wich met statements in LEFT and in RIGHT
	returns only users with pictures
*/

// RIGHT JOIN
$right_join = "SELECT * FROM users RIGHT JOIN pictures ON users.id = pictures.user_id"

/*
	RIGHT JOIN
	returns all records from right table (pictures) and if we dont
	have info for user there will be NULL.
*/

// if we dont have LEFT|RIGHT|INNER before JOIN, mysql will use INNER JOIN

// LEFT JOIN with JOIN table
$left_join_table = "SELECT * FROM `books` LEFT JOIN authors_books ON books.id = authors_books.book_id WHERE authors_books.book_id = 1";

// return the authors ids of which are authors of the book with id = 2
$authors_ids_by_book = 
	"SELECT * 
	FROM  `books` 
	LEFT JOIN authors_books ON books.id = authors_books.book_id
	WHERE authors_books.book_id =2";

// selecting the names of authors by book id
$authors_names_by_book_ids = 
	"SELECT * 
	FROM  `books` 
	LEFT JOIN authors_books ON books.id = authors_books.book_id
	LEFT JOIN authors ON authors_books.author_id = authors.id
	WHERE authors_books.book_id=2";


// Count of rows
$sql = "SELECT COUNT(*) FROM `users` WHERE 1";

// Max age of user
$sql = "SELECT MAX(age) FROM `users` WHERE 1";

// Average
$sql = "SELECT AVG(age) FROM `users` WHERE 1";