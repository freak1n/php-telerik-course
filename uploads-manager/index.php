<?php 
	session_start();
	var_dump($_SESSION);
	if (isset($_SESSION['is_logged']) AND $_SESSION['is_logged']) 
	{
		header('Location: uploads_list.php');
		exit;
	}

	$page_title = 'Sign In'; 
	require_once 'includes/header.php';
	if (isset($_GET['error'])) 
	{		
		$error_code = (int)$_GET['error'];
		echo $login_errors[$error_code];
	}
?>
	<form method="POST" action="processes/login.php">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		<input type="submit" name='sign-in' value="Sign In" /><br />
		<a href="sign_up.php">Sign up</a><br />
	</form>
<?php require_once 'includes/footer.php'; ?>	