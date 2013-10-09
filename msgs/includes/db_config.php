<?php 

$connection = mysqli_connect('localhost', 'root', 'root', 'php_course');
if ( ! $connection) 
{
	echo 'Connection is not valid';
}

mysqli_query($connection, 'SET NAMES UTF8');