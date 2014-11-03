<?php
/**
 * 
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-28
 * @File: index.php
 * @Function: compare file_put_contents with fwrite
 */

$filename = 'file.txt';
$content = 'hello world 123';
file_put_contents($filename, $content . PHP_EOL, FILE_APPEND);//PHP_EOL表示当前系统的换行符，FILE_APPEND表示追加

$file = fopen($filename, 'w');//r r+ W w+ a a+ X x+类型
fwrite($file, $content);
fclose($file);


/**
 * @name abd
 * @param $a
 * @param $b
 * @return int
 * @function
 */
function abd($a, $b) {

    return 21;
}

