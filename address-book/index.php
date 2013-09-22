<?php 
	$page_title = 'List'; 
	require_once 'includes/header.php';
?>
	<a href="form.php">Add new contact</a>
	<table>
		<tr>
			<td>Name</td>
			<td>Tel</td>
			<td>Group</td>
		</tr>

		<?php 
			if (file_exists('data.txt')) 
			{
				$result = file('data.txt');
				foreach ($result as $line) :	
					$columns = explode('!', $line);
		?>
					<tr>
						<td><?= $columns[0] ?></td>
						<td><?= $columns[1] ?></td>
						<td><?= $groups[trim($columns[2])] ?></td>
					</tr>
		<?php 
				endforeach;
			}
		?>		
	</table>
<?php require_once 'includes/footer.php'; ?>	