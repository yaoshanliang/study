<?php
	$str = "php编程";
	if (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$str)) {
		print("该字符串全部是中文");
	} else {
		print("该字符串不全部是中文");
	}
    public function regex_match()
    {
        $email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        //$email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.(com|cn|org))$/';
        $emails = array('iat.net.cn@gmail.com',
            '1329517386@qq.com',
            '1227403052@suda.edu.cn',
            'yaoshanliang@foxmail.com',
            'iat-net-cn@gmail.com',
            'iat..net.cn@gmail.com',
            'iat-.net.cn@gmail.com',
            '-iat.net.cn@gmail.abc');
        foreach ($emails as $key => $value)
        {
            echo $value, '=>';
            if(preg_match($email_regex, $value) === 1)
                //if(filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo "is incorrect", '</br>';
            }

            if(filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo "is incorrect", '</br>';
            }
        }

        $ip_regex = '/^((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))$/';
        $ips = array('192.168.0.1', '58.210.361.122');
        foreach ($ips as $key => $value)
        {
            echo $value, '=>';
            if(preg_match($ip_regex, $value) === 1)
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo 'is incorrect', '</br>';
            }

            if(filter_var($value, FILTER_VALIDATE_IP))
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo 'is incorrect', '</br>';
            }
            echo ip2long($value);
        }

        $url_regex = '/^http[s]?:\/\/'.
            '(([0-9]{1,3}\.){3}[0-9]{1,3}'. // IP形式的URL- 199.194.52.184
            '|'. // 允许IP和DOMAIN（域名）
            '([0-9a-z_!~*\'()-]+\.)*'. // 三级域验证- www.
            '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'. // 二级域验证
            '[a-z]{2,6})'.  // 顶级域验证.com or .museum
            '(:[0-9]{1,4})?'.  // 端口- :80
            '((\/\?)|'.  // 如果含有文件对文件部分进行校验
            '(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/';
        $urls = array('http://iat.net.cn', 'https://iat.net.cn', 'http://iat.abc');
        foreach ($urls as $key => $value)
        {
            echo $value, '=>';
            if(preg_match($url_regex, $value) === 1)
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo 'is incorrect', '</br>';
            }

            if(filter_var($value, FILTER_VALIDATE_URL))
            {
                echo 'is correct', '</br>';
            }
            else
            {
                echo 'is incorrect', '</br>';
            }
        }
    }
?>
