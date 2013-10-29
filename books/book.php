<?php
	if ( ! isset($_GET['book_id']))
	{
		header('Location: index.php');
		exit;
	}

	require_once 'models/books_functions.php';
	require_once 'models/comments_functions.php';
	$book_id = $_GET['book_id'];

	if ( ! $book = get_book_info_by_id($_GET['book_id']))
	{
		echo "Невалидна книга";
		exit;
	}

	$page_title = $book['book_title'];
	require_once 'includes/header.php';
?>

<a href="index.php">Към всички книги</a>
<h2>Избрана книга: <?= $book['book_title'] ?></h2>
<div>
	<strong>Автори:</strong>
	<br />
	<?php foreach ($book['authors'] as $author_id => $author_name): ?>
	<a href="books.php?author_id=<?=$author_id ?>"><?= $author_name ?></a><br />
	<?php endforeach ?>
</div>

<?php $comments = get_comments_by_book_id($book['id']); ?>
<div>
	<h3>Коментари:</h3>
	<?php if (count($comments) > 0): ?>
		<?php foreach ($comments as $key): ?>
			<div class="comment-container">
				<strong><?= $key['username'] ?> написа:</strong>
				<div><?= $key['content'] ?></div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
	<p>Никой не е писал коментари за тази книга</p>
	<?php endif ?>
</div>

<textarea placeholder="Добави коментар" rows="3" cols="20"></textarea>
<?php require_once 'includes/footer.php'; ?>