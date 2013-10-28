<?php

$connection = mysqli_connect('localhost', 'root', '', 'books');
if ( ! $connection)
{
	echo 'Connection is not valid';
}

$connection->set_charset('UTF8');
// mysqli_query($connection, 'SET NAMES UTF8');