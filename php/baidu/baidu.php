<?php
$content = file_get_contents('http://tieba.baidu.com/f?kw=%E7%99%BE%E5%BA%A6%E4%BA%91');
$url = '/http:\/\/pan.baidu.com\/mbox\/homepage\?short=.{7}/';
preg_match_all($url, $content, $url_all);

if(!empty($url_all[0])) {
	foreach($url_all[0] as $v) {
		if($pos = strpos($v, '<')) {
			$v = substr($v, 0, $pos);
		}
		$cookie_name = substr($v, strpos($v, '=') + 1);
		if(!isset($_COOKIE[$cookie_name])) {
			setcookie($cookie_name, $v, time() + 60 * 10);
			echo $v, "\n";
		} else {
			echo '.';
		}
	}
} else {
	echo '.';
}

