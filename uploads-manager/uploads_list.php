
<?php 
	session_start();

	if (isset($_SESSION['is_logged']) AND ! $_SESSION['is_logged']) 
	{
		header('Location: index.php');
		exit;
	}

?>
<a href="processes/logout.php">Logout</a>