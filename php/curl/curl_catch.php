<?php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://iat.net.cn");
	curl_exec($ch);
	curl_close($ch);
?>