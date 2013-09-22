<?php 
	$page_title = 'List'; 
	require_once 'includes/header.php';
?>
	<a href="form.php">Add new expense</a><br />
	Filter by: 
	<select id="filter-by-dd">
		<option value='-1'>All</option>
		<?php foreach ($groups as $id => $group) : ?>
			<option value="<?= $id ?>"><?= $group; ?></option>
		<?php endforeach ?>
	</select>
	<table id="expenses-table">
		<thead>
			<tr>
				<td>Product</td>
				<td>Price</td>
				<td>Group</td>
				<td>Date</td>
			</tr>
		</thead>
		<tbody>
		<?php
		// Getting expenses for file
		if (file_exists('data.txt')) :
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
					<td><?= date("d F Y", (int)$columns[3]) ?></td>
				</tr>
		<?php 
			endforeach;
		endif
		?>
		</tbody>
		<tfoot>
			<tr>
				<td>-----</td>
				<td id="total-price-cell"><?= number_format($total_price, 2); ?> $</td>
				<td>-----</td>
				<td>-----</td>
			</tr>
		</tfoot>
	</table>
<?php require_once 'includes/footer.php'; ?>	