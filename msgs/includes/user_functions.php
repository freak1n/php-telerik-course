<?php isset($_SERVER['HTTP_REFERER']) or die('no direct access');

require_once('db_config.php'); 

function check_user_exist($user)
{
	global $connection;

	$user = trim($user);
	

	$stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE username=? LIMIT 1");

	/* bind parameters for markers */
	mysqli_stmt_bind_param($stmt, "s", $user);

	/* execute query */
    mysqli_stmt_execute($stmt);

	$is_exist = (bool)mysqli_stmt_fetch($stmt);

	/* close statement */
    mysqli_stmt_close($stmt);
    
	return $is_exist;
}

function register_user($username, $password)
{
	global $connection;
	$stmt = mysqli_prepare($connection, "INSERT INTO users (username, password) VALUES (?, ?)");

	mysqli_stmt_bind_param($stmt, "ss", $username, $password);
	
	mysqli_stmt_execute($stmt);	

	mysqli_stmt_close($stmt);

	return true;
}

function check_user_credentials($credentials = array())
{
	global $connection;
	$credentials = array_map('trim', $credentials);

	$stmt = mysqli_prepare($connection, "SELECT username FROM users WHERE username=? AND password=? LIMIT 1");

	mysqli_stmt_bind_param($stmt, "ss", $credentials['username'], $credentials['password']);

	mysqli_stmt_execute($stmt);

	$is_exist = (bool)mysqli_stmt_fetch($stmt);

	mysqli_stmt_close($stmt);

	return $is_exist;
}