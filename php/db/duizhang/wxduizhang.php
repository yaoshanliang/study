<?php
$file = fopen('2015.11.25.csv','r');
$count = 0;
while ($line = fgetcsv($file)) {
	if($count++ == 0) continue;
	//交易时间|公众账号ID|商户号|特约商户号|设备号|微信订单号|商户订单号|用户标识|交易类型|交易状态|付款银行|货币种类|总金额|企业红包金额|微信退款单号|商户退款单号|退款金额|企业红包退款金额|退款类型|退款状态|商品名称|商户数据包|手续费|费率
	list($v['pay_time'], $v['uid'], $a, $a, $a, $v['trade_id'], $v['order_id'], $a, $a, $v['status'], $a, $a, $v['total_payments'], $a, $v['re_order_id'], $v['re_trade_id'], $v['re_total_payments'], $a, $a, $v['re_status'], $a, $a, $a, $a) = $line;
	foreach($v as &$value) {
		$value = substr($value, 1, strlen($value) - 1);
	}
	$result[] = $v;
}
// var_dump($result);exit;
fclose($file);

//充值订单 wbpay_wxfinance_fill
//业务订单号 微博订单号 用户UID 充值金额 充值时间 支付渠道 (支付宝/银行/…) 订单状态(1:正常；-1：退款) 原微博订单号(如果订单状态是－1的情况下才有值，否则为 空) 退款 充值类型(直充)
$fileName = 'wbpay_wxfinance_fill_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	if($result['status'] == 'REFUND') {
		$str =<<<STR
{$v['order_id']}\t{$v['trade_id']}\t{$v['uid']}\t{$v['total_payments']}\t{$v['pay_time']}\t微信\t-1\t{$v['trade_id']}\t-{$v['re_total_payments']}\t直充\r\n
STR;
	} else {
		$str =<<<STR
{$v['order_id']}\t{$v['trade_id']}\t{$v['uid']}\t{$v['total_payments']}\t{$v['pay_time']}\t微信\t1\t \t \t直充\r\n
STR;
	}
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_wxfinance_fill.txt $fileName";
shell_exec($shell);

//正常消耗订单  wbpay_wxfinance_order
// 一级产品类型 二级产品类型 项目ID 用户uid 理财师id 理财师名称 订单号 订单提交时间 微博付款流水号 付款时间 订单金额 订单退款截止日期 订单状态 是否分成 充 值类型(直充) 服务开始时间 服务结束时间
$fileName = 'wbpay_wxfinance_order_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	$lastRefundDate = date("Y-m-d", strtotime("+7 days", strtotime($v["pay_time"])));
	$str =<<<STR
理财师\t模拟交易\t \t{$v['uid']}\t \t \t{$v['order_id']}\t{$v['pay_time']}\t{$v['trade_id']}\t{$v['pay_time']}\t{$v['total_payments']}\t{$lastRefundDate}\tTRADE_SUCCESS\t否\t直充\t{$v['start_date']}\t{$v['end_date']}\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_wxfinance_order.txt $fileName";
shell_exec($shell);

//退款消耗订 单 wbpay_wxfinance_strike
//一级产品类型 二级产品类型 项目ID 用户uid 理财师id 理财师名称 退款订单号 退款订单提交时间 退款微博付款流水号 退款付款时间 退款订单金额 订单状态 是否分成 被退订单号 充值类型(直 充) 服务开始时间 服务结束时间
$fileName = 'wbpay_wxfinance_strike_' . date("YmdHis");
$file = fopen($fileName, 'w+');
foreach($result as $v) {
	if($v['status'] != 'REFUND') {
		return ;
	}
	$lastRefundDate = date("Y-m-d", strtotime("+7 days", strtotime($v["pay_time"])));
	$str =<<<STR
理财师\t模拟交易\t \t{$v['uid']}\t \t \t{$v['order_id']}\t{$v['pay_time']}\t{$v['trade_id']}\t{$v['pay_time']}\t{$v['total_payments']}\t{$v['status']}\t否\t{$v['order_id']}\t直充\t{$v['start_date']}\t{$v['end_date']}\r\n
STR;
fwrite($file, $str);
}
fclose($file);
$shell = "iconv -f utf-8 -t gbk -o wbpay_wxfinance_strike.txt $fileName";
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
