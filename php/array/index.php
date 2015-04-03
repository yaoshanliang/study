<?php
$items = array('a','b','c');

foreach($items as &$item){
    $item .= '4';
}

foreach($items as $item){
	echo $item;
}
?>
