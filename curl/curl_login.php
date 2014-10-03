<?php
	$URL = "http://dxpx.suda.edu.cn/loginActionForsuda.action?gonghao=1227401054&secret=6c4c0a0b27c631d12b1ccf55ff679cf5&time=1400136532";
	$post_data = array(
		"gonghao" => "1227401054",
		"secrect" => "6c4c0a0b27c631d12b1ccf55ff679cf5",
		"time" => "1400136532");
	//$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; .NET CLR 1.1.4322)";

	$filename = "a.txt";
	$cookie_file  = tempnam('./cookie', 'cookie');
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_URL, $URL);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt( $ch, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // 模拟用户使用的浏览器
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file );//保存到文件
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file );
	curl_setopt($ch, CURLOPT_HEADER, 1);
	@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
    curl_setopt($ch, CURLOPT_MAXREDIRS, 2 ); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
	/*curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);*/
	//ob_start();  

	$output = curl_exec($ch);
	print_r($output);
	/*file_put_contents($filename, $output);
	
	$info = curl_getinfo($ch);
	//print_r($info);
	//ob_end_clean(); 
	curl_close($ch);
	$URL = "http://192.168.1.100:8888/365days/11";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_URL, $URL);
	//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file );//保存到文件
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file );
	$output = curl_exec($ch);
	print_r($output);*/
	curl_close($ch);