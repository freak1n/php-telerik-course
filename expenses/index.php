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
				<td></td>
				<td></td>
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
				<tr data-id="<?= trim($columns[3]);?>">
					<td><?= $columns[0] ?></td>
					<td class="price-cell"><span><?= number_format($columns[1], 2) ?></span> $</td>
					<td><?= $groups[trim($columns[2])] ?></td>	
					<td><?= trim(date("d F Y", (int)$columns[3])) ?></td>
					<td><a href="form.php?expense_id=<?= $columns[3] ?>" >Update</a></td>
					<td><a href="#" class="delete-btn">Delete</a></td>
				</tr>
		<?php 
			endforeach;
		endif
		?>
		</tbody>
		<tfoot>
			<tr>
				<td>-----</td>
				<td id="total-price-cell"><span><?= number_format($total_price, 2); ?></span> $</td>
				<td>-----</td>
				<td>-----</td>
				<td>-----</td>
				<td>-----</td>
			</tr>
		</tfoot>
	</table>
<?php require_once 'includes/footer.php'; ?>	