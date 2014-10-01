<?php
	ob_start();
	require_once('phptag.php');
	$content = ob_get_contents();
	ob_clean();
	var_dump($content);