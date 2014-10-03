<?php
/* http://example.com/upload.php:
<?php var_dump($_FILES); ?>
*/

// // 创建一个 cURL 句柄
// $ch = curl_init('http://example.com/upload.php');

// // 创建一个 CURLFile 对象
// //curl_file_create()在PHP>=5.5.0才行
// $cfile = curl_file_create('cats.jpg','image/jpeg','test_name');

// // 设置 POST 数据
// $data = array('test_file' => $cfile);
// curl_setopt($ch, CURLOPT_POST,1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// // 执行句柄
// curl_exec($ch);



/* http://localhost/upload.php:
print_r($_POST);
print_r($_FILES);
*/

$ch = curl_init();

$data = array('name' => 'Foo', 'file' => '@/home/user/test.png');

curl_setopt($ch, CURLOPT_URL, 'http://localhost/upload.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

curl_exec($ch);
?>
?>