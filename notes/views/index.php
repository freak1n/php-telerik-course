<?php 
include 'inc/functions.php';

$pages = ['index', 'users', 'account'];
$default_page = 'index';

$page = in_array($_GET['p'], $pages) ? $_GET['p'] : $default_page;

include $page;

$connection = mysqli_connect('localhost', 'root', '', 'books');
if ( ! $connection)
{
	echo 'Connection is not valid';
}

$connection->set_charset('UTF8');

$q = $connection->query('SELECT * FROM books');

$data = array();

while ($row = $q->fetch_assoc())
{
	$data['books'][] = $row;
}

$data['title'] = 'Views';
$data['content'] = 'templates/index_public.php';
$data['header'] = 'templates/header_public.php';
render($data, 'templates/layouts/left_layout.php');