<!DOCTYPE html>
<html>
<head>
	<title><?= $data['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<meta charset='UTF-8'>
</head>
<body>
	<div style="150px; border: 1px solid green">
		<?php  
		include $data['header'];
		?>
	</div>
	<div style="border: 1px solid blue">
		<?php  
		include $data['content'];
		?>
	</div>
</body>
</html>