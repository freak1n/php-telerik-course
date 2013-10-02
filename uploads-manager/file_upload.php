

<?php 
	session_start();

	if (isset($_SESSION['is_logged']) AND ! $_SESSION['is_logged']) 
	{
		header('Location: index.php');
		exit;
	}

	$page_title = 'Uploads form'; 
	require_once 'includes/header.php';
	$user_files = scandir('uploads/' . $_SESSION['current_user']);
?>

<a href="processes/logout.php">Logout</a><br />
<a href="uploads_list.php">Back to files</a><br />
<form method='POST' enctype="multipart/form-data">
	File: <input type="file" name="File" /><br />
	<input type="submit" />
</form>

<?php 
	if ($_POST) {
		
		if (count($_FILES) > 0) 
		{
			if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads' . DIRECTORY_SEPARATOR . $_SESSION['current_user'] . DIRECTORY_SEPARATOR . $_FILES['file']['name'])) 
			{
				echo 'File is uploaded successful<br />';
			}
			else
			{
				echo 'Error<br />';
			}
		}
	}
 ?>
 
<?php require_once('includes/footer.php'); ?>