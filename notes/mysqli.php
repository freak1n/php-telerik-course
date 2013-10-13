<?php 

$con = mysqli_connect('localhost', 'root', 'root', 'php-course');

if ($conn) 
{
	echo "error reporting";
}

mysqli_set_charset($con, 'utf8');


mysqli_query($con, 'SET NAMES UTF8');

$q = mysqli_query($con, "SELECT * FROM users"); 

while ($row = mysqli_fetch_assoc($q))
{
	var_dump($row);
}

mysqli_real_escape_string($con, $_GET['username']);
$hacked_query = "SELECT * FROM users where username='' AND pass='' OR 1=1 --''";


// Prepared statment
$stmt = mysqli_prepare($con, 'SELECT * FROM users WHERE username=? AND pass = ?');
if ( ! $stmt)
{
	echo 'error';
}

mysqli_stmt_bind_param($stmt, 'ss', $_GET['username'], $_GET['password']); 
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $result); // $result is new variable
mysqli_stmt_fetch($stmt);

while ($row = mysqli_stmt_fetch($stmt))
{

}

$rows = mysqli_stmt_result_metadata($stmt);
while ($field = mysqli_fetch_field($rows))
{
	$fields[] = &$row[$field->name];
}

call_user_func_array($stmt, 'bind_result', $fields);

