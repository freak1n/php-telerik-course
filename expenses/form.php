<?php 
	mb_internal_encoding('UTF-8');
	$page_title = 'Add new expense'; 
	require_once 'includes/header.php';
	if ($_POST)
	{
		// normalize
		$product = trim($_POST['product']);
		$product = str_replace('!', '', $product);
		
		$price_dollars = trim($_POST['price-dollars']);
		$price_dollars = str_replace('!', '', $price_dollars);
		
		$price_coins = trim($_POST['price-coins']);
		$price_coins = str_replace('!', '', $price_coins);
		
		$price = (float)($price_dollars . '.' . $price_coins);

		$selected_group = (int)$_POST['group'];

		// validation
		$error = FALSE;
		if (mb_strlen($product) < 4) 
		{
			echo '<p>Name must contains 3 symbols or more</p>';			
			$error = TRUE;
		}

		if ($price < 0) 
		{
			echo '<p>Price must bigger than 0</p>';
			$error = TRUE;
		}

		if ( ! array_key_exists($selected_group, $groups))
		{
			echo '<p>Invalid group</p>';
			$error = TRUE;
		}

		if ( ! $error) 
		{
			$result = $product . '!' . $price . '!' . $selected_group . '!' . date('d F Y') . "\n";
			if (file_put_contents('data.txt', $result, FILE_APPEND))
			{
				echo 'The contact was saved successful';
			}
		}
	}
?>
	<a href="index.php">To the list</a>
	<form action='' method='POST'>
		Name: <input type="text" name="product" /><br />
		Price: $ <input type="number" name="price-dollars" min='0'/>.<input type="number" name="price-coins" min='0' step='10' /><br />
		Category: 
		<select name="group">
			<?php foreach ($groups as $id => $group) : ?>
				<option value="<?= $id ?>"><?= $group; ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Add" /><br />
	</form>
<?php require_once 'includes/footer.php'; ?>