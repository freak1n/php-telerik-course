<?php
function render($data, $name) 
{
	if (file_exists($name))
	{
		include $name;
	}
}