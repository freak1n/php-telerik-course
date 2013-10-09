<?php 
	session_start();
	
	if (isset($_SESSION['is_logged']) AND ! $_SESSION['is_logged']) 
	{
		header('Location: index.php');
		exit;
	}

	$page_title = 'Messages'; 
	require_once 'includes/header.php';
?>	
<a href="processes/logout.php">Logout</a><br />

<?php 	
	// Get info 
	require_once 'includes/db_config.php';

	$all_messages_result = mysqli_query($connection, "SELECT * FROM messages ORDER BY created_at DESC");
?>
<a href="messages.php">Към съобщения</a>
<form method="POST" id="new-msg-form">
	<input type="text" name="msg-title" placeholder="Enter title" /><br />
	<textarea name="msg-text" rows="8" cols="40" placeholder="Enter msg text"></textarea><br />
	<input type="submit" name="submit" value="Изпрати съобщението" />
</form> 

<?php
	if ($_POST) 
	{
		// normalize
		$post = array_map('trim', $_POST);

		$error = FALSE;

		// Validation
		if (empty($post['msg-title']))
		{
			echo 'Полето за заглавие, не трябва да бъде празно ... <br />';
			$error = TRUE;
		}

		if (mb_strlen($post['msg-title']) > 50)
		{
			echo 'Заглавието не може да е повече от 50 символа ... <br />';
			$error = TRUE;
		}

		if (empty($post['msg-text']))
		{
			echo 'Полето за съобщение, не трябва да бъде празно ... <br />';
			$error = TRUE;
		}

		if (mb_strlen($post['msg-text']) > 250)
		{
			echo 'Текста на съобщението не може да е повече от 250 символа ... <br />';
			$error = TRUE;
		}

		if ( ! $error) 
		{
			$stmt = mysqli_prepare($connection, "INSERT INTO messages (title, text, username) VALUES (?, ?, ?)");

			mysqli_stmt_bind_param($stmt, "sss", $post['msg-title'], $post['msg-text'], $_SESSION['current_user']);
			
			mysqli_stmt_execute($stmt);	

			mysqli_stmt_close($stmt);

			header('Location: messages.php');
			exit;
		}
	}
?>

<?php require_once('includes/footer.php'); ?>