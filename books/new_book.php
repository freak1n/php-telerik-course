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

		if (mb_strlen($new_book_name) < 3)  
		{
			$post_error['book_name'] = 'Името на книгата трябва да е поне 3 символа';
		}
		else if (empty($new_book_authors))
		{
			$post_error['authors'] = 'Трябва да изберете автори на книгата';
		}
		else
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
	
	<?php $all_authors = get_all_authors(); ?>
	<select name="authors[]" style="height: 200px" multiple>
		<?php foreach ($all_authors as $author_id => $author_name) : ?>
			<option value="<?= $author_id ?>"><?= $author_name ?></option>
		<?php endforeach ?>	
	</select>
	<br />
	<?= isset($post_error['authors']) ? $post_error['authors'] : '' ?>
	<br />
	<input type="submit" name="submit_new_book" value="Добави" />
</form>


<?php require_once 'includes/footer.php'; ?>