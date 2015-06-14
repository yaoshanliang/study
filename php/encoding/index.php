<?php
	$a = array('str1' => '中文', 'str2' => 'english');
	var_dump(json_encode($a));
	var_dump(json_encode($a, JSON_UNESCAPED_UNICODE));

	$a = array('str1' => urlencode('中文'), 'str2' => 'english');
	var_dump(urldecode(json_encode($a)));
?>
