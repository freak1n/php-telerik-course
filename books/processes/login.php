<?php isset($_POST['sign-in']) OR die('Cannot direct access');

session_start();
$arr['hello'] = 50;
require_once ('../models/user_functions.php');
$post = array_map('trim', $_POST);

if (check_user_credentials($post))
{
	$_SESSION['is_logged'] = TRUE;
	$_SESSION['current_user'] = $post['username'];
	header('Location: ../messages.php');
	exit;
}
else
{
	header('Location: ../index.php?error=1');
	exit;	
}

