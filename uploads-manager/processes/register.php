<?php isset($_POST['sign-up']) OR die('Cannot direct access');
session_start();

require_once ('../includes/vars.php');
require_once ('../includes/functions.php');
$post = array_map('trim', $_POST);

// Validation
if (mb_strlen($post['username']) < 4)  
{
	header('Location: ../sign_up.php?error=1');
	exit;
}

if(check_user_exist($post['username']))
{
	header('Location: ../sign_up.php?error=4');
	exit;
}

if (mb_strlen($post['password']) < 4) 
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
$new_user = $post['username'] . '!' . sha1($user_salt . $post['password'] . $user_salt) . "\n";
if (file_put_contents('../users.txt', $new_user, FILE_APPEND)) 
{
	$_SESSION['is_logged'] = TRUE;
	header('Location: ../uploads_list.php');
	exit;
}

