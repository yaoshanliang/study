<?php

/*
 * Copyright (C) 2015 SINA Corporation
 *
 *
 *
 * This script is firstly created at 2015-11-18.
 *
 * To see more infomation,
 *    visit our official website http://finance.sina.com.cn/.
 */

$detailArr = array(
    "wbpay_finance_strike.txt",
    "wbpay_finance_fill.txt",
    "wbpay_finance_pay.txt",
    "wbpay_finance_order.txt",
);

$logArr = array(
    "wbpay_finance_rsync.log",
    "wbpay_finance_php_error"
);

function alertmail($user, $msg, $title = "STP微博支付订阅产品对账邮件") {
    $curlPost = array(
        'user' => $user,
        'msg' => $msg,
        'title' => $title,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://172.16.11.90/sendmail/mail.php");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);
	var_dump($data);
    curl_close($ch);
}

$date = date("Y-m-d");

$str = <<<CONTENT
Hi all,
        以下是本次对账({$date})的日志及详情邮件，请注意查收！

谢谢！
-------
CONTENT;

foreach($logArr as $log) {
    $content = file_get_contents($log);
    if(false === $content) {
        continue;
    }
    $str .= "\n{$log}\n{$content}\n---\n";
}

foreach($detailArr as $log) {
    $content = file_get_contents($log);
    if(false === $content) {
        continue;
    }
    $str .= "\n{$log}\n{$content}\n---\n";
}
echo $str;

alertmail("shixi_shanliang", $str);
