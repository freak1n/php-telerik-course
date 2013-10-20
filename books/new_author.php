<?php 
	$page_title = 'Нов автор'; 
	require_once 'includes/header.php';
	require_once 'models/authors_functions.php';

?>
<a href="index.php">Книги</a>

<?php 
	if (isset($_POST['submit_new_author'])) 
	{
		$new_author_name = trim($_POST['author_name']);
		if (mb_strlen($new_author_name) < 3)  
		{
			$post_error['author_name'] = 'Името на автора трябва да е поне 3 символа';
		}
		else if (is_author_exists($new_author_name))
		{
			$post_error['author_name'] = 'Този автор вече съществува';
		}
		else
		{
			create_new_author(array('author_name' => $new_author_name));
		}
	}
?>
<form method="POST" action="">
	Автор: 
	<input type="text" name="author_name" />
	<input type="submit" name="submit_new_author" value="Добави" />
	<?= isset($post_error['author_name']) ? $post_error['author_name'] : '' ?>
</form>

<?php $all_authors = get_all_authors(); ?>
<table>
	<thead>
		<tr>
			<td>Автори</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($all_authors as $author_id => $author_name) : ?>
			<tr>
				<td><a href="books.php?author_id=<?= $author_id ?>"><?= $author_name ?></a></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php require_once 'includes/footer.php'; ?>