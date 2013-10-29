<?php
	$page_title = 'Home';
	require_once 'includes/header.php';
	require_once 'models/books_functions.php';
	require_once 'includes/user_actions.php'
?>
	<a href="new_book.php">Нова книга</a> |
	<a href="new_author.php">Нов автор</a>
<?php
	$books = get_all_books();
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
					<td colspan="2">Все още няма въведени книги</td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
<?php require_once 'includes/footer.php'; ?>