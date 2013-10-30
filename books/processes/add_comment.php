<?php
require_once '../models/user_functions.php';
$post = array_map('trim', $_POST);
var_dump($post);
die;
$response = array();
get_user_id_by_usermame($post['username']);


