<?php 
session_start();
$_SESSION['is_logged'] = FALSE;
$_SESSION['current_user'] = '';
header('Location: ../index.php');