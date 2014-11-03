<?php
	$URL = "ids1.suda.edu.cn/amserver/UI/Login?goto=http://myauth.suda.edu.cn/default.aspx?app=www";
	//$URL = "xk.suda.edu.cn";
	//$URL = "http://xk.suda.edu.cn/CheckCode.aspx";
	//$URL = "http://localhost:8080/project_test/index.php?c=public&a=login";
	$post_data = array(
		"IDToken0" => "",
		"IDToken1" => "1227403052",
		"IDToken2" => "6dbfe7a892d450c519e687f885788213",
		"DButton" => "Submit",
		"goto" => "aHR0cDovL215YXV0aC5zdWRhLmVkdS5jbi9kZWZhdWx0LmFzcHg/YXBwPXd3dw==",
		"encode" => "true",
		"inputCode" => "",
		"gx_charset" => "UTF-8");
	$filename = "a.txt";
	//$cookie_jar = tempnam('.', 'cookie');
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_URL, $URL);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);//保存到文件
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	//ob_start();  

	$output = curl_exec($ch);
	print_r($output);
	file_put_contents($filename, $output);
	
	$info = curl_getinfo($ch);
	print_r($info);
	//ob_end_clean(); 
	curl_close($ch);

	/*include ('Valite.php');

$valite = new Valite();
$valite->setImage('a.gif');
$valite->getHec();
$ert = $valite->run();
//$ert = "1234";
print_r($ert);
echo '<br><img src="a.gif><br>';

*/
?>
<!--<iframe src="http://www.staggeringbeauty.com/" style="border: 1px inset #ddd" width="498" height="598"></iframe>-->