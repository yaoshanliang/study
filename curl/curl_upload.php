<?
$url = "http://www.suda.edu.cn";
$post_data = array (
    "foo" => "bar",
    // Ҫ�ϴ��ı����ļ���ַ
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