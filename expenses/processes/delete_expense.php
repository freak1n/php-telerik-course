<?php (isset($_GET['expence_id']) AND isset($_GET['current_total_price'])) OR die('You must enter id of group');

$response = array();

// normalize
$expence_id = $_GET['expence_id'];
$current_total_price = (float)$_GET['current_total_price'];
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

if ($current_total_price <= 0)
{
	$response = array(
		'status' => 'error',
		'msg' => 'Invalid total price'
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
			// subtraction the price of element
			$price_of_cur_element = (float)$columns[1];
			$current_total_price -= $price_of_cur_element;

			// delete the element
			unset($file_data[$key]);
			$str_data = implode('', $file_data);
			file_put_contents('../data.txt', $str_data);
			
			$response = array(
				'status' => 'ok',
				'msg' => $str_data,
				'total_price' => number_format($current_total_price, 2),
			);

			echo json_encode($response);
			break;
			exit;			
		}	
	}
}