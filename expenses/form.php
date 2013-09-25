<?php 
	mb_internal_encoding('UTF-8');
	$page_title = 'Add new expense'; 
	require_once 'includes/header.php';
	require_once 'includes/functions.php';

	if (isset($_GET['expense_id']))
	{
		$expense_data = get_expense_by_id($_GET['expense_id']);
		$price = explode('.', $expense_data['price']);
	}
	else
	{	
		$price = null;
		$expense_data = null;
	}
?>
	<a href="index.php">To the list</a>
	<form action='' method='POST'>
		Name: <input type="text" name="product" value="<?= $expense_data['product']; ?>" /><br />
		Price: $ <input type="number" name="price-dollars" min='0' value="<?= isset($price[0]) ? $price[0] : '' ?>"/>.<input type="number" name="price-coins" min='0' step='10' value="<?= isset($price[1]) ? $price[1] : '' ?>"  /><br />
		Category: 
		<select name="group">
			<?php foreach ($groups as $id => $group) : ?>
				<option value="<?= $id ?>" <?= $expense_data['group'] == $id ? 'selected' : '' ?> ><?= $group; ?></option>
			<?php endforeach ?>
		</select>
		<input type="hidden" />
		<input type="submit" value="<?= isset($_GET['expense_id']) ? 'Update' : 'Add' ?>" /><br />
	</form>
<?php require_once 'includes/footer.php'; ?>

<?php 
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
			$result = $product . '!' . $price . '!' . $selected_group . '!' . time() . "\n";
			if (isset($_GET['expense_id']))
			{
				if(update_expense($_GET['expense_id'], $result))
				{
					echo 'The product was updated successful';
					header('Location: index.php');
				}
			}
			else
			{
				if (file_put_contents('data.txt', $result, FILE_APPEND))
				{
					echo 'The product was added successful';
				}
			}
		}
	}
?>