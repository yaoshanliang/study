<?php
	ob_start();
	include('phpta{g}.php');
	$content = ob_get_contents();
	ob_clean();
	var_dump($content);

