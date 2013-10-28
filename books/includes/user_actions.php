<?php require_once './models/user_functions.php' ?>

<?php 
if (isset($_POST['sign_in'])) 
{
	$post = array_map('trim', $_POST);
	if ($post['username'] == '' OR $post['password'] == '')
	{
		$post_error['login'] = 'Не сте въвели всички данни';
	}
	else if (check_user_credentials($post))
	{
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['username'] = $post['username'];
		header('Location: ./index.php');
	}
	else
	{
		$post_error['login'] = 'Грешно име или парола.';
	}
}
?>

<?php if ( ! isset($_SESSION['logged_in']) OR ! $_SESSION['logged_in']): ?>
<form method="POST" action="" style="margin-bottom: 30px">
	Потребителско име: 
	<input  type="input" name="username" /><br />
	Парола: 
	<input type="input"  name="password" /><br />
	<input type="submit" name="sign_in" value="Вход" />
	<a href="./sign_up.php" style="color: #8A211B">Регистрация</a><br />
	<?= isset($post_error['login']) ? $post_error['login'] : '' ?>
</form>
<?php endif ?>
