<?
$url = "http://www.suda.edu.cn";
$post_data = array (
    "foo" => "bar",
    // 要上传的本地文件地址
    "upload" => "curl_muti.php"
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output = curl_exec($ch);
curl_close($ch);
echo $output;