<?php 
	$page_title = 'List'; 
	require_once 'includes/header.php';
?>
	<a href="form.php">Add new product</a>
	<table>
		<thead>
			<tr>
				<td>Product</td>
				<td>Price</td>
				<td>Group</td>
			</tr>
		</thead>

		<?php 
			if (file_exists('data.txt')) 
			{
				$result = file('data.txt');
				$total_price = 0;
				foreach ($result as $line) :	
					$columns = explode('!', $line);
					$total_price += $columns[1];
		?>
					<tr>
						<td><?= $columns[0] ?></td>
						<td><?= number_format($columns[1], 2) ?> $</td>
						<td><?= $groups[trim($columns[2])] ?></td>
					</tr>
		<?php 
				endforeach;
			}
		?>
		<tr>
			<td>-----</td>
			<td><?= $total_price; ?> $</td>
			<td>-----</td>
		</tr>
	</table>
<?php require_once 'includes/footer.php'; ?>	