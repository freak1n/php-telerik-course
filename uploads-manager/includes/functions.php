<?php
require_once 'vars.php';

function check_user_exist($user)
{
	$user = trim($user);
	$file_data = file('../users.txt');
	foreach ($file_data as $line) 
	{
		$columns = explode('!', $line);
		if ($user == $columns[0])
		{
			return TRUE;
			break;
		}
	}

	return FALSE;
}

function check_user_credentials($credentials = array())
{
	global $user_salt;
	$credentials = array_map('trim', $credentials);
	$username = trim($credentials['username']);
	$password = sha1($user_salt . $credentials['password'] . $user_salt);
	
	$file_data = file('../users.txt');
	
	foreach ($file_data as $line) 
	{
		$columns = explode('!', $line);
		
		if ($username == $columns[0])
		{
			if ($password == trim($columns[1]))
			{
				return TRUE;
				break;
			}
			else
			{
				return FALSE;
				break;
			}
		}
	}
	return FALSE;
}