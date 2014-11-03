<?php
/*// 创建一对cURL资源
$ch1 = curl_init();
$ch2 = curl_init();

// 设置URL和相应的选项
curl_setopt($ch1, CURLOPT_URL, "http://www.w3cschool.cc/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_URL, "http://www.php.net/");
curl_setopt($ch2, CURLOPT_HEADER, 0);

// 创建批处理cURL句柄
$mh = curl_multi_init();

// 增加2个句柄
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);

$running=null;
// 执行批处理句柄
do {
    curl_multi_exec($mh,$running);
} while($running > 0);

// 关闭全部句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);

*/
// 创建两个cURL资源
$ch1 = curl_init();
$ch2 = curl_init();
// 指定URL和适当的参数
curl_setopt($ch1, CURLOPT_URL, "http://lxr.php.net/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_URL, "http://www.php.net/");
curl_setopt($ch2, CURLOPT_HEADER, 0);
// 创建cURL批处理句柄
$mh = curl_multi_init();
// 加上前面两个资源句柄
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);
// 预定义一个状态变量
$active = null;
// 执行批处理
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}
// 关闭各个句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);
/*这个示例中有两个主要循环。第一个 do-while 循环重复调用 curl_multi_exec() 。这个函数是无隔断（non-blocking）的，但会尽可能少地执行。它返回一个状态值，只要这个值等于常量 CURLM_CALL_MULTI_PERFORM ，就代表还有一些刻不容缓的工作要做（例如，把对应URL的http头信息发送出去）。也就是说，我们需要不断调用该函数，直到返回值发生改变。

而接下来的 while 循环，只在 $active 变量为 true 时继续。这一变量之前作为第二个参数传给了 curl_multi_exec() ，代表只要批处理句柄中是否还有活动连接。接着，我们调用 curl_multi_select() ，在活动连接（例如接受服务器响应）出现之前，它都是被“屏蔽”的。这个函数成功执行后，我们又会进入另一个 do-while 循环，继续下一条URL。
*/
?>
