
<?php 
	session_start();

	if (isset($_SESSION['is_logged']) AND ! $_SESSION['is_logged']) 
	{
		header('Location: index.php');
		exit;
	}

	$page_title = 'Uploads list'; 
	require_once 'includes/header.php';
	$user_files = scandir('uploads' . DIRECTORY_SEPARATOR . $_SESSION['current_user']);
?>

<a href="processes/logout.php">Logout</a><br />
<a href="file_upload.php">Go to upload form</a><br />
<table>
	Your files: 
	<?php foreach ($user_files as $file) : ?>
		<?php if ($file != "." AND $file != "..") : ?>
		<tr>
			<td><?= $file ?></td>
		</tr>
 		<?php endif ?>
 	<?php endforeach ?>
</table>

<?php require_once('includes/footer.php'); ?>