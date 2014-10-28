<?php
/**
 * 
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-27
 * @File: textarea.php
 * @Function: 在textarea中输入的换行符，实际输出在html中是不起作用的，所以需要进行nl2br()函数处理
 */

print(nl2br($_POST['textarea']));