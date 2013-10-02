<?php 
	session_start();

	if (isset($_SESSION['is_logged']) AND $_SESSION['is_logged']) 
	{
		header('Location: uploads_list.php');
		exit;
	}
	
	$page_title = 'Sign Up'; 
	require_once 'includes/header.php';
	if (isset($_GET['error'])) 
	{		
		$error_code = (int)$_GET['error'];
		echo $register_errors[$error_code];
	}
?>
	<form method="POST" action="processes/register.php">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		Re-type password: <input type="password" name="re-password" /><br />
		<input type="submit" name='sign-up' value="Sign up" /><br />
		<a href="index.php">Back to Sign in page.</a><br />
	</form>
<?php require_once 'includes/footer.php'; ?>	