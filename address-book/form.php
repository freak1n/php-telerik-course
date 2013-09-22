<?php 
	mb_internal_encoding('UTF-8');
	$page_title = 'Add new contact'; 
	require_once 'includes/header.php';

	if ($_POST)
	{
		// normalize
		$name = trim($_POST['name']);
		$name = str_replace('!', '', $name);
		$tel = trim($_POST['tel']);
		$tel = str_replace('!', '', $tel);
		$selected_group = (int)$_POST['group'];

		// validation
		$error = FALSE;
		if (mb_strlen($name) < 4) 
		{
			echo '<p>Name must contains 4 symbols or more</p>';			
			$error = TRUE;
		}

		if (mb_strlen($tel) < 6 OR mb_strlen($tel) > 12) 
		{
			echo '<p>Invalid telephone</p>';
			$error = TRUE;
		}

		if ( ! array_key_exists($selected_group, $groups))
		{
			echo '<p>Invalid group</p>';
			$error = TRUE;
		}

		if ( ! $error) 
		{
			$result = $name . '!' . $tel . '!' . $selected_group . "\n";
			if (file_put_contents('data.txt', $result, FILE_APPEND))
			{
				echo 'The contact was saved successful';
			}
		}
	}
?>
	<a href="index.php">To the list</a>
	<form action='' method='POST'>
		Name: <input type="text" name="name" /><br />
		Tel: <input type="text" name="tel" /><br />
		Group: 
		<select name="group">
			<?php foreach ($groups as $id => $group) : ?>
				<option value="<?= $id ?>"><?= $group; ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Add" /><br />
	</form>
<?php require_once 'includes/footer.php'; ?>