<?php
	$page_title = 'Регистрация';
	require_once 'includes/header.php';
	require_once 'models/user_functions.php';
?>
	<?php
		if (isset($_POST['sign_up'])) {
		  	
		  	$post = array_map('trim', $_POST);

			$post_errors = array();
			
			// Validation
			if (mb_strlen($post['username']) < 3)  
			{
				$post_errors['username']['min_length'] = 'Потребителското име трябва да е поне 3 символа.';
			}

			if (check_user_exist($post['username']))
			{
				$post_errors['username']['exist'] = 'Потребителското име вече съществува.';
			}

			if (mb_strlen($post['password']) < 5) 
			{
				$post_errors['password']['min_length'] = 'Паролата трябва да е поне 5 символа.';
			}

			if ($post['password'] != $post['re-password'])
			{
				$post_errors['password']['not_match'] = 'Паролите не съвпадат';
			}

			if (count($post_errors) === 0) 
			{
				if (register_user($post['username'], $post['password'])) 
				{
					$_SESSION['logged_in'] = TRUE;
					$_SESSION['username'] = $post['username'];
					header('Location: index.php');
				}
			}
		}  
	?>
	<a href="index.php">Към книги</a>
	<h2>Регистрация</h2>
	<form method="POST" action="" style="margin-top: 30px;">
		Потребителско име: <input type="text" name="username" /><br />
		
		<!-- Username errors --> 
		<?php if (isset($post_errors['username'])) : ?>
		<?php 	foreach ($post_errors['username'] as $key => $msg) : ?>
					<span class="error-red"><?= $msg ?></span><br />
		<?php 	endforeach  ?>
		<?php endif?>
		
		Парола: <input type="password" name="password" /><br />
		Повтори паролата: <input type="password" name="re-password" /><br />
		
		<!-- Password errors --> 
		<?php if (isset($post_errors['password'])) : ?>
		<?php 	foreach ($post_errors['password'] as $key => $msg) : ?>
					<span class="error-red"><?= $msg ?></span>
		<?php 	endforeach  ?>
		<?php endif?>
		<br />
		<input type="submit" name='sign_up' value="Регистрация" /><br />	
	</form>
<?php require_once 'includes/footer.php'; ?>