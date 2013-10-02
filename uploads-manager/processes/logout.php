<?php 
session_start();
$_SESSION['is_logged'] = FALSE;
header('Location: ../index.php');