<?php

$func = $_POST['func'];

if ($func == 'newgame') {
	$scores = array(
		0 => array(0,0),
		1 => array(0,0),
		2 => array(0,0),
		3 => array(0,0),
		4 => array(0,0),
		5 => array(0,0),
		6 => array(0,0),
		7 => array(0,0),
		8 => array(0,0),
		9 => array(0,0)
	);
	print_r($scores);
}

if ($func == 'score') {
	echo $_POST['value'];
}

?>