<?php isset($_POST['sign-up']) OR die('Cannot direct access');
session_start();

require_once ('../includes/vars.php');
require_once ('../includes/user_functions.php');
$post = array_map('trim', $_POST);

// Validation
if (mb_strlen($post['username']) < 5)  
{
	header('Location: ../sign_up.php?error=1');
	exit;
}

if (check_user_exist($post['username']))
{
	header('Location: ../sign_up.php?error=4');
	exit;
}

if (mb_strlen($post['password']) < 5) 
{
	header('Location: ../sign_up.php?error=2');
	exit;
}

if ($post['password'] != $post['re-password'])
{
	header('Location: ../sign_up.php?error=3');
	exit;
}

// Registration
if (register_user($post['username'], $post['password']))
{
	header('Location: ../index.php');
}
