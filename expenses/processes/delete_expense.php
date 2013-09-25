<?php isset($_GET['expence_id']) OR die('You must enter id of group');

$response = array();

// normalize
$expence_id = $_GET['expence_id'];

// validation
if (mb_strlen($expence_id) < 10) 
{
	$response = array(
		'status' => 'error',
		'msg' => 'Invalid expence id.',
	);

	echo json_encode($response);
	exit;
}

if ( ! file_exists('../data.txt')) 
{
	$response = array(
		'status' => 'error',
		'msg' => 'Cannot open the data file.',
	);

	echo json_encode($response);
	exit;	
}
else
{
	$file_data = file('../data.txt');
	foreach ($file_data as $key => $line) 
	{
		$columns = explode('!', $line);
		if (trim($columns[3]) == $expence_id)
		{	
			
			unset($file_data[$key]);
			$str_data = implode('', $file_data);
			file_put_contents('../data.txt', $str_data);
			$response = array(
				'status' => 'ok',
				'msg' => $str_data,
			);

			echo json_encode($response);
			break;
			exit;			
		}	
	}
}