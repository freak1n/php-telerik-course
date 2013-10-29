<?php
	if ( ! isset($_GET['author_id']))
	{
		header('Location: index.php');
		exit;
	}

	$page_title = 'Books';
	$author_id = $_GET['author_id'];
	require_once 'includes/header.php';
	require_once 'models/books_functions.php';
	require_once 'models/authors_functions.php';
?>
	<a href="index.php">Книги</a><br />
	 <?php
	 	$current_author_name = get_author_name_by_id($author_id);
	 	if ($current_author_name == '')
	 	{
	 		exit('Избрали сте невалиден автор');
	 	}
	  ?>
	<p>Избран автор: <?= $current_author_name ?></p>
<?php
	$books = get_all_books_by_author_id($author_id);
?>
<table>
	<thead>
		<tr>
			<td>Книга</td>
			<td>Автори</td>
		</tr>
	</thead>
	<tbody>
		<?php if ( ! empty($books)): ?>
			<?php foreach ($books as $book_id => $book_info) : ?>
				<tr>
					<td><a href="book.php?book_id=<?= $book_id ?>"><?= $book_info['name'] ?></a></td>
					<td>
						<?php foreach ($book_info['authors'] as $author_id => $author_name) : ?>
						<a href="books.php?author_id=<?= $author_id ?>"><?= $author_name ?></a> |
						<?php endforeach ?>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else : ?>
				<tr>
					<td colspan="2">Няма ваведени книги за този автор</td>
				</tr>
		<?php endif ?>
	</tbody>
</table>
<?php require_once 'includes/footer.php'; ?>