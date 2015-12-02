<?php
$result[0]['uid'] = '1405703790';
$result[0]['order_id'] = '150701379048246533228';
$result[0]['trade_id'] = '8011054706702';
$result[0]['total_payments'] = 2020;
$result[0]['create_time'] = '2015-07-01 09:03:00';
$result[0]['end_date'] = '2015-09-26';
$result[0]['dd_time'] = '2015-07-01 08:59:00';


$result[1]['uid'] = '5320585803';
$result[1]['order_id'] = '15070158031270537387';
$result[1]['trade_id'] = '8007554747244';
$result[1]['total_payments'] = 1588;
$result[1]['create_time'] = '2015-07-01 18:54:00';
$result[1]['end_date'] = '2015-09-30';
$result[1]['dd_time'] = '2015-07-01 18:52:00';

$result[2]['uid'] = '5599086879';
$result[2]['order_id'] = '15070168791036338198';
$result[2]['trade_id'] = '8028754705935';
$result[2]['total_payments'] = 1588;
$result[2]['create_time'] = '2015-07-01 08:50:00';
$result[2]['end_date'] = '2015-09-30';
$result[2]['dd_time'] = '2015-07-01 08:46:00';

$result[3]['uid'] = '1843427365';
$result[3]['order_id'] = '15070873651036335940';
$result[3]['trade_id'] = '8003755223582';
$result[3]['total_payments'] = 1588;
$result[3]['create_time'] = '2015-07-08 09:23:00';
$result[3]['end_date'] = '2015-10-07';
$result[3]['dd_time'] = '2015-07-08 09:22:00';

$result[4]['uid'] = '1263034157';
$result[4]['order_id'] = '150717415748414031633';
$result[4]['trade_id'] = '8030155957139';
$result[4]['total_payments'] = 2020;
$result[4]['create_time'] = '2015-07-17 09:55:00';
$result[4]['end_date'] = '2015-09-26';
$result[4]['dd_time'] = '2015-07-17 09:54:00';

$result[5]['uid'] = '2265697022';
$result[5]['order_id'] = '15082770221571216917';
$result[5]['trade_id'] = '8025460449003';
$result[5]['total_payments'] = 698;
$result[5]['create_time'] = '2015-08-27 22:09:40';
$result[5]['end_date'] = '2015-09-26';
$result[5]['dd_time'] = '2015-08-27 22:08:10';

$result[6]['uid'] = '1136177925';
$result[6]['order_id'] = '15082779251036314697';
$result[6]['trade_id'] = '8026160425531';
$result[6]['total_payments'] = 698;
$result[6]['create_time'] = '2015-08-27 17:55:44';
$result[6]['end_date'] = '2015-09-26';
$result[6]['dd_time'] = '2015-08-27 17:54:29';

$result[7]['uid'] = '1060449255';
$result[7]['order_id'] = '15082792551270515430';
$result[7]['trade_id'] = '8048760381143';
$result[7]['total_payments'] = 698;
$result[7]['create_time'] = '2015-08-27 09:29:44';
$result[7]['end_date'] = '2015-09-26';
$result[7]['dd_time'] = '2015-08-27 09:28:12';

$result[8]['uid'] = '2896863031';
$result[8]['order_id'] = '15082830311036318538';
$result[8]['trade_id'] = '8031160535057';
$result[8]['total_payments'] = 698;
$result[8]['create_time'] = '2015-08-28 15:27:13';
$result[8]['end_date'] = '2015-09-27';
$result[8]['dd_time'] = '2015-08-28 15:20:43';

//充值订单 wbpay_finance_fill
//业务订单号 微博订单号 用户UID 充值金额 充值时间 支付渠道 (支付宝/银行/…) 订单状态(1:正常；-1：退款) 原微博订单号(如果订单状态是－1的情况下才有值，否则为 空) 退款 充值类型(直充)
$fileName = 'wbpay_finance_fill_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	$str =<<<STR
{$v['order_id']}\t{$v['trade_id']}\t{$v['uid']}\t0\t{$v['create_time']}\t支付宝\t-1\t{$v['order_id']}\t-{$v['total_payments']}\t直充\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_finance_fill.txt $fileName";
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

//退款订单
//一级产品类型\t二级产品类型\t项目ID\t用户UID\t理财师ID\t理财师名称\t订单号\t订单提交时间\t微博付款流水号\t付款时间\t订单金额\t订单状态\t是否分成\t被退订单号\t充值类型(直充)\t服务开始时间\t服务结束时间\r\n

$fileName = 'wbpay_finance_strike_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	$v['start_date'] = substr($v['dd_time'], 0, 10);
	$str =<<<STR
理财师\t模拟交易\t \t{$v['uid']}\t \t \t{$v['order_id']}\t{$v['dd_time']}\t{$v['trade_id']}\t{$v['create_time']}\t{$v['total_payments']}\tTRADE_SUCCESS\t否\t{$v['order_id']}\t直充\t{$v['start_date']}\t{$v['end_date']}\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_finance_strike.txt $fileName";
shell_exec($shell);