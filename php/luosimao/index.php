<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-204353163b81fae07169fcbcf3981bf6');

curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => '18896581232','message' => '验证码：028261【铁壳网络】'));

$res = curl_exec( $ch );
curl_close( $ch );
//$res  = curl_error( $ch );
var_dump($res);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL , "http://sms-api.luosimao.com/v1/status.json");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-204353163b81fae07169fcbcf3981bf6');

$res =  curl_exec( $ch );
curl_close( $ch );
//$res  = curl_error( $ch );
var_dump($res);
?>
