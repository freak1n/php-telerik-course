<?php 
// Getting expenses by type
require_once '../includes/vars.php';
$response = array();

// normalize
$group_id = (int)$_GET['group_id'];

// validation
if ( ! array_key_exists($group_id, $groups) && $group_id != -1)
{
	$response = array(
		'status' => 'error',
		'msg' => 'Invalid group id',
	);

	echo json_encode($response);
	exit;
}

if ( ! file_exists('../data.txt')) 
{
	$response = array(
		'status' => 'error',
		'msg' => 'Cannot open the data file',
	);

	echo json_encode($response);
	exit;	
}
else
{
	$filtered_data = array();
	$total_price = 0;
	$file_data = file('../data.txt');
	foreach ($file_data as $line) 
	{
		$columns = explode('!', $line);
		if ($columns[2] == $group_id || $group_id == -1)
		{
			$filtered_data[] = array(
				'product' => $columns[0],
				'price' => $columns[1],
				'group' => $groups[$columns[2]],
				'date' => $columns[3],
			);
			$total_price += $columns[1];
		}
	}
	
	$response = array(
		'status' => 'ok',
		'data' => $filtered_data,
		'total_price' => $total_price, 
	);

	echo json_encode($response);
	exit;
}