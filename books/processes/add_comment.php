<?php
require_once '../models/user_functions.php';
require_once '../models/comments_functions.php';

$post = array_map('trim', $_POST);

$response = array(
	'response_status' => 'error',
	'msg'	 => '',
);

if (mb_strlen($post['comment_text']) <= 0)
{
	$response['msg'] = 'Invalid comment text';
	echo json_encode($response);
	exit;
}

if ( ! $user_id = get_user_id_by_usermame($post['username']))
{
	$response['msg'] = 'Cannot loading user';
	echo json_encode($response);
	exit;
}

if ( ! add_new_comment($post['comment_text'], $post['book_id'], $user_id))
{
	$response['msg'] = 'Cannot add new comment';
	echo json_encode($response);
	exit;
}

$response['response_status'] = 'OK';
echo json_encode($response);





