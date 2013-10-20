<?php 

$connection = mysqli_connect('localhost', 'root', '', 'books');
if ( ! $connection) 
{
	echo 'Connection is not valid';
}

mysqli_query($connection, 'SET NAMES UTF8');