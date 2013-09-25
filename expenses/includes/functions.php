<?php  
function get_expense_by_id($expense_id)
{
	$file_data = file('data.txt');
	foreach ($file_data as $line) 
	{
		$columns = explode('!', $line);
		if (trim($columns[3]) == $expense_id)
		{

			$expense = array(
				'id' => trim($columns[3]),
				'product' => $columns[0],
				'price' => number_format($columns[1], 2),
				'group' => $columns[2],
				'date' => trim(date("d F Y", (int)$columns[3])),
			);

			return $expense;
		}
	}
}

function update_expense($expense_id, $data) 
{
	$file_data = file('data.txt');
	foreach ($file_data as $key => $line) 
	{
		$columns = explode('!', $line);
		if (trim($columns[3]) == $expense_id)
		{
          	$file_data[$key] = $data;
          	file_put_contents('data.txt', $file_data);
			return TRUE;
		}
	}	
}
