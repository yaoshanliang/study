<?php
	$URL = "http://ids.com/api/get_token";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_URL, $URL);
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
	// ob_start();

	$output = curl_exec($ch);
	// ob_end_clean();
	curl_close($ch);
	$data = json_decode($output);
	$URL = "http://ids.com/api";
	$post_data = array(
		"request_type" => "login",
		"data" => array('username' => "1329517386@qq.com",
						"password" => "123456",
						'url' => '10.10.65.153'),
		'_token' => $data->token
		);

	$ch = curl_init($URL);
	$headers = array(
		"X-CSRF-TOKEN: $data->token"
	);
	curl_setopt( $ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers );
	curl_setopt ($ch, CURLOPT_REFERER, "http://www.163.com/ ");
	curl_setopt($ch, CURLOPT_URL, $URL);
	// curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
	// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
	// ob_start();

	$output = curl_exec($ch);
	// ob_end_clean();
	curl_close($ch);
	print_r($output);
