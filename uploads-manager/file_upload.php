

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
	File: <input type="file" name="photo" /><br />
	<input type="submit" />
</form>

<?php 
	if (count($_FILES) > 0) 
	{
		if (strpos($_FILES['photo']['name'], '../') === TRUE OR strpos($_FILES['photo']['name'], './') === TRUE) 
		{
			die('Error');
		}

		$location_to_upload = 'uploads' . DIRECTORY_SEPARATOR . $_SESSION['current_user'] . DIRECTORY_SEPARATOR . $_FILES['photo']['name'];
		if (move_uploaded_file($_FILES['photo']['tmp_name'], $location_to_upload)) 
		{
			echo 'File is uploaded successful<br />';
		}
		else
		{
			echo 'Error<br />';
		}
	}
 ?>
 
<?php require_once('includes/footer.php'); ?>