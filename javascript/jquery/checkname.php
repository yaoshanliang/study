<?php
/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-11-15
 * @File: checkname.php
 * @Function: 
 */
if(isset($_POST['name']) && $_POST['name'] != '')
{
    echo preg_match("/[\x{4e00}-\x{9fa5}]+/u",$_POST['name']) ? '用户名不能包含中文' : '';
}
  