<?php isset($_POST['sign-in']) OR die('Cannot direct access');

session_start();

require_once ('../includes/functions.php');
$post = array_map('trim', $_POST);

if (check_user_credentials($post))
{
	header('Location: ../uploads_list.php');
	$_SESSION['is_logged'] = TRUE;
	exit;
}
else
{
	header('Location: ../index.php?error=1');
	exit;	
}

