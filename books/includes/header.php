<?php session_start(); ?>
<?php date_default_timezone_set('Europe/Sofia'); ?>
<?php require_once 'includes/vars.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Books - <?= $page_title ?></title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<meta charset='UTF-8'>
</head>
<body>
<?php if (isset($_SESSION['logged_in']) AND $_SESSION['logged_in']): ?>
<div>
	В момента сте влезли като <strong><?= $_SESSION['username'] ?></strong>
	<a href="./processes/logout.php"  style="color: #8A211B">Изход</a>
</div>
<?php endif ?>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="./app.js"></script>