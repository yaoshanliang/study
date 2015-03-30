<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://voice-api.luosimao.com/v1/verify.json");

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-57f401c0be24e8f137b6a098e25f1a9f');

curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => '18896581232','code' => '1234'));

$res = curl_exec( $ch );
curl_close( $ch );
//$res  = curl_error( $ch );
var_dump($res);
?>
