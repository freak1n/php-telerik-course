<h1>Welcome!</h1>
<ul>
<?php 
	foreach ($data['books'] as $value) 
	{
		echo '<li>' . $value['book_title'] . '</li><br />'; 
	}
?>
</ul>