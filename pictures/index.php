<?php

$connection = mysqli_connect('localhost', 'root', '', 'php-course');
if ( ! $connection) 
{
	echo 'Connection is not valid';
}

$connection->query('SET NAMES UTF8');

$get_user_pics_query = "SELECT users.username, pictures.picture_name 
						FROM users
						INNER JOIN pictures
						WHERE users.id = pictures.user_id";

$db_result = $connection->query($get_user_pics_query);

$result = array();
while ($row = $db_result->fetch_assoc())
{
	$result[$row['username']]['pictures'][] = $row['picture_name'];
}

foreach ($result as $username => $stuffs) 
{
	$users_pictures = implode(', ', $stuffs['pictures']);
	echo $username . "'s pictures are: " . $users_pictures . '<br />'; 
}