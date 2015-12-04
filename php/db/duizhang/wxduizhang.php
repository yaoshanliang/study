<?php
$db_type = 'mysql';
$db_host = "172.16.6.243";
$db_port = "3333";
$db_name = "test";
$db_user = "biz";
$db_password = "erqrtx0tgfght";

$dsn = "$db_type:host=$db_host;port=$db_port;dbname=$db_name";
$conn = new PDO($dsn, $db_user, $db_password);
$sql = "SELECT * FROM `iat`";
$stmt = $conn->prepare($sql);
if(!$stmt -> execute()) print_r($stmt->errorInfo());
if(!$result = $stmt->fetchAll()) print_r($stmt->errorInfo());

//充值订单 wbpay_finance_fill
//业务订单号 微博订单号 用户UID 充值金额 充值时间 支付渠道 (支付宝/银行/…) 订单状态(1:正常；-1：退款) 原微博订单号(如果订单状态是－1的情况下才有值，否则为 空) 退款 充值类型(直充)
$fileName = 'wbpay_finance_fill_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	$str =<<<STR
{$v['order_id']}\t{$v['trade_id']}\t{$v['uid']}\t{$v['total_payments']}\t{$v['create_time']}\t银行\t1\t \t \t直充\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_finance_fill.txt $fileName";
shell_exec($shell);

//正常消耗订单  wbpay_finance_order
// 一级产品类型 二级产品类型 项目ID 用户uid 理财师id 理财师名称 订单号 订单提交时间 微博付款流水号 付款时间 订单金额 订单退款截止日期 订单状态 是否分成 充 值类型(直充) 服务开始时间 服务结束时间
$fileName = 'wbpay_finance_order_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	$lastRefundDate = date("Y-m-d", strtotime("+7 days", strtotime($v["create_time"])));
	$str =<<<STR
理财师\t模拟交易\t \t{$v['uid']}\t{$v['sid']}\t \t{$v['order_id']}\t{$v['create_time']}\t{$v['trade_id']}\t{$v['create_time']}\t{$v['total_payments']}\t{$lastRefundDate}\tTRADE_SUCCESS\t否\t直充\t{$v['start_date']}\t{$v['end_date']}\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_finance_order.txt $fileName";
shell_exec($shell);

//收入确认订单 wbpay_finance_pay
//订单号 收入确认月份 收入确认时间
$fileName = 'wbpay_finance_pay_' . date("YmdHis");
$file = fopen($fileName, 'w+');
$month = date('Y-m');
$day = date('Y-m-d');
foreach($result as $v) {
	$str =<<<STR
{$v['order_id']}\t2015-03\t{$day}\r\n
STR;
fwrite($file, $str);
}
// echo $str;
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_finance_pay.txt $fileName";
shell_exec($shell);
