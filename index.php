<?php
function &add(){
	$a = 1;
	$b = 2;
	$b++;
	return $b;
}
$c = add();
var_dump($c);
$d = &add();
var_dump($d);
$d = 5;
$e = add();
var_dump($e);
 ?>
