<?php
$data['uid'] = '3503685241';
// $data['title'] = urlencode('标题');
$data['title'] = '标题';
// $data['content'] = urlencode('内容');
$data['content'] = '内容';
$data['object'] = '1000';
$data['oid'] = '1000';
$data['biz_id'] = 100160;
$data['source'] = 1851339808;
$key ='591aff82dcf2eb63dbff7b21cafd8dde';
$data['sign'] = generate_sign($data, $data['source'], $key);
$url = 'http://i.api.card.weibo.com/review/longblogproxy.json';
$params = array(
	'http' => array(
		'method'  => 'POST',
		'header'  => "Content-type:application/x-www-form-urlencoded",
		'content' => http_build_query($data),
	)
);
var_dump(file_get_contents($url, false, stream_context_create($params)));
function generate_sign(array $params, $source, $key){
	if(empty($source) || empty($key)) {
		return false;
	}
	$params['source'] = $source;
	ksort($params);
	reset($params);
	$para_filter = array();
	foreach($params as $k=>$v) {
		if($k == "sign" || empty($v)) {//sign
			continue;
		}
		$para_filter[$k] = $params[$k];
	}
	$pairs = array();
	foreach ($para_filter as $k=>$v) {
		$pairs[] = "$k=$v";
	}
	$sign_data = implode('&', $pairs); $sign = md5($sign_data.$key);
	return $sign;
}

