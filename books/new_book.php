<?php
	$page_title = 'Нова книга';
	require_once 'includes/header.php';
	require_once 'models/books_functions.php';
	require_once 'models/authors_functions.php';
?>
<a href="index.php">Книги</a><br />

<?php
	if (isset($_POST['submit_new_book']))
	{
		$new_book_name = trim($_POST['book_name']);
		$new_book_authors = isset($_POST['authors']) ? $_POST['authors'] : array();
		$post_error = [];

		if (mb_strlen($new_book_name) < 3)
		{
			$post_error['book_name'] = 'Името на книгата трябва да е поне 3 символа';
		}

		if (empty($new_book_authors))
		{
			$post_error['authors']['empty_msg'] = 'Трябва да изберете автори на книгата';
		}
		else if ( ! is_author_ids_exist($new_book_authors))
		{
			$post_error['authors']['invalid_ids'] = 'Невалидни автори';
		}

		if (count($post_error) <= 0)
		{
			if (create_new_book($new_book_name, $new_book_authors))
			{
				echo "Успешно добавена книга <strong>" . $new_book_name . "</strong>";
			}
		}

	}
?>
<form method="POST" action="">
	Книга:
	<input type="text" name="book_name" />
	<?= isset($post_error['book_name']) ? $post_error['book_name'] : '' ?><br />

	<!-- Get all authors and puts in select -->
	<?php
		$all_authors = get_all_authors();
		if ($all_authors === FALSE)
		{
			echo 'Грешка';
			header('Location: 500.php');
		}
	?>
	<br />
	Изберете автори на книгата: <br />
	<select name="authors[]" style="height: 200px" multiple>
		<?php foreach ($all_authors as $author_id => $author_name) : ?>
			<option value="<?= $author_id ?>"><?= $author_name ?></option>
		<?php endforeach ?>
	</select>
	<br />
	<?php if (isset($post_error['authors'])) : ?>
		<?php foreach ($post_error['authors'] as $key => $msg) {
			echo $msg . '<br />';
		} ?>
	<?php endif ?>
	<br />
	<input type="submit" name="submit_new_book" value="Добави" />
</form>


<?php require_once 'includes/footer.php'; ?>