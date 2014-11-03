<?php
/**
 * 
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-27
 * @File: index.php
 * @Function: 
 */

$str = '<a href="demo.php?m=index&a=index&name=中文">测试页面</a>';
var_dump(htmlentities($str));
var_dump(htmlspecialchars($str));