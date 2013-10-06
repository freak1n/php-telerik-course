
<?php 
	session_start();
	
	if (isset($_SESSION['is_logged']) AND ! $_SESSION['is_logged']) 
	{
		header('Location: index.php');
		exit;
	}

	$page_title = 'Uploads list'; 
	require_once 'includes/header.php';
	
	$user_dir = 'uploads' . DIRECTORY_SEPARATOR . $_SESSION['current_user'];
	$user_files = scandir($user_dir);
?>

	<a href="processes/logout.php">Logout</a><br />
	<a href="file_upload.php">Upload form</a><br />
	<table>
		Your files: 
		<?php if (is_dir($user_dir) AND is_readable($user_dir)): ?>
			
		<?php foreach ($user_files as $file) : ?>
			<?php if ($file != "." AND $file != "..") : ?>
			<tr>
				<td><a href="<?= $user_dir   . DIRECTORY_SEPARATOR . $file ?>" target="_blank" download><?= $file ?></a></td>
			</tr>
	 		<?php endif ?>
	 	<?php endforeach ?>
		<?php endif ?>
	</table>

<?php require_once('includes/footer.php'); ?>
