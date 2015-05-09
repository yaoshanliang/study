<?php
	$path = str_replace('\\', '/',__FILE__);
	echo $path, "\n";
	function extname_1($path)
	{
		return substr(strrchr($path, '.'), 1);
	}

	function extname_2($path)
	{
		return substr($path, strrpos($path, '.') + 1);
	}

	function extname_3($path)
	{
		$arr = explode('.', $path);
		return $arr[count($arr) - 1];
	}

	function extname_4($path)
	{
		preg_match_all('/[\w\/\:\-]+\.([\w]+)$/', $path, $out);
		return $out[1][0];
	}

	function extname_5($path)
	{
		return preg_replace('/^[^\.]+\.([\w]+)$/', '${1}', basename($path));
	}

	function extname_6($path)
	{
		return end(explode('.', $path));
	}

	function extname_7($path)
	{
		$info = pathinfo($path);
		return $info['extension'];
	}

	function extname_8($path)
	{
		return pathinfo($path, PATHINFO_EXTENSION);
	}

	print_r(extname_1($path));
	print_r(extname_2($path));
	print_r(extname_3($path));
	print_r(extname_4($path));
	print_r(extname_5($path));
	print_r(extname_6($path));
	print_r(extname_7($path));
	print_r(extname_8($path));
