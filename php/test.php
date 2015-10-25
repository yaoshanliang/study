<?php
$j = 1;
for($i = 2; $i <= 2148; $i++) {
	if($i % 7 == 1) {
		echo rand($j, $i), ',';
		$j = $i;
	}
}
?>
