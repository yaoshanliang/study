<?php
	$str[1] = true;
	$str[2] = false;
	$str[3] = 1;
	$str[4] = 0;
	$str[5] = null;
	$str[6] = '';
	$str[7] = '0';
    $str[8] = 'a';

	foreach($str as $key => $value) {
		//var_dump($value);
	}

    foreach($str as $key1 => $value1) {
        echo 'str1[', $key1, ']=>';var_dump($value1);
        foreach($str as $key2 => $value2) {

            echo 'str2[', $key2, ']=>';var_dump($value2);
            echo $value1 == $value2 ? '相等' :'不相等';echo "\n";
        }
    }
	//$arr = array('name' => "dwqs",'add' => "www.ido321.com");echo $arr["name"];echo "{$arr['name']}";
	//

	$a = "1";
	$$a = "a2";
#	$$a = "aa";
#	$$$a = "aaa";
#	var_dump($a);
	var_dump($$a);
#	var_dump($1);
