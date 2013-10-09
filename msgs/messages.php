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
	if ( ! $all_messages_result)
	{
		die('Database error');
	}
?>
<a href="new_msg.php">Add new message</a>
<table>
	<thead>
		<tr>
			<td>From</td>
			<td>Title</td>
			<td>Text</td>
			<td>Created at</td>
		</tr>
	</thead>	
	<tbody>
	<?php while ($row = $all_messages_result->fetch_assoc()) : ?>
		<tr>
			<td><?= $row['username'] ?></td>
			<td><?= $row['title'] ?></td>
			<td><?= $row['text'] ?></td>
			<td><?= $row['created_at'] ?></td>
		</tr>
	<?php endwhile ?>
	</tbody>
</table>
<?php require_once('includes/footer.php'); ?>