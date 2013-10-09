<?php 
$connection = mysqli_connect('localhost', 'root', '', 'php-course');
if ( ! $connection) 
{
	echo 'Connection is not valid';
}

mysqli_query($connection, 'SET NAMES UTF8');

// GET
$q = mysqli_query($connection, 'SELECT * FROM first_table');

if (!$q) 
{
	echo 'Error in database';
	echo mysqli_error($connection);
}
/*while ($row = $q->fetch_object()) 
{
	var_dump($row);
}*/

// INSERT
$input = mysqli_real_escape_string($connection, 'Peter');
$q = mysqli_query($connection,"INSERT INTO first_table (username) VALUES ('Peter')");
if ($q) 
{
	echo 'okey';
}
else
{
	echo mysqli_error($connection);
}

