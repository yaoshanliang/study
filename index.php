<?php
// |-----------------------------------------------------------------------------------
// | Author    iat <iat.net.cn@gmail.com>
// | Site      http://iat.net.cn
// | Copyright (c) 2013-2014
// |-----------------------------------------------------------------------------------
/**
 * hello iat
 * @package 
 * @author iat <iat.net.cn@gmail.com>
 * @time 
 */

?>

<?php
class iat
{
	/**
	 * swap two datas
	 * @param  [type] $a
	 * @param  [type] $b
	 * @return [type]
	 */
	public static function swap(&$a, &$b)
	{
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	/**
	 * sort by maopao
	 * @param  [type] $arr
	 * @return [type]
	 */
	public static function sort_by_mp(&$arr)
	{
		$n = count($arr);
		for ($i = 0; $i < $n; $i++)
		{
			for ($j = 0; $j < $n -$i - 1; $j++)
			{
				if($arr[$j] < $arr[$j + 1])
				{
					self::swap($arr[$j], $arr[$j+1]);
				}
			}
		}
		var_dump($arr);
	}
	
	/**
	 * sort by jiaohuan
	 * @param  [type] $arr
	 * @return [type]
	 */
	public static function sort_by_jh($arr)
	{
		$n = count($arr);
		for ($i = 0; $i < $n; $i++) 
		{ 
			for ($j = $i + 1; $j < $n; $j++) 
			{ 
				if($arr[$i] < $arr[$j])
				{
					swap($arr[$i], $arr[$j]);
				}
			}
		}
		var_dump($arr);
	}
	
	/**
	 * sort by xuanze
	 * @param  [type] $arr
	 * @return [type]
	 */
	public static function sort_by_xz($arr)
	{
		$n = count($arr);
		for ($i = 0; $i < $n ; $i++) 
		{
			$max = $arr[$i];
			for ($j = $i + 1; $j < $n ; $j++) 
			{
				if($max < $arr[$j])
				{
					$max = $arr[$j];
				}	
			}
			$arr[$i] = $max;
		}
		var_dump($arr);
	}

	/**
	 * sort by kuaisu
	 * @param  [type] $arr
	 * @return [type]
	 */
	public static function sort_by_ks($arr)
	{
		$n = count($arr);
		if ($n <= 1) 
		{
			return $arr;
		}
		$left_arr = array();
		$right_arr = array();
		$key = $arr[0];
		for ($i = 1; $i < $n; $i++) 
		{ 
			if($key < $arr[$i])
			{
				$left_arr[] = $arr[$i];
			}
			else
			{
				$right_arr[] = $arr[$i];
			}
		}
		$left_arr = self::sort_by_ks($left_arr);
		$right_arr = self::sort_by_ks($right_arr);
		return array_merge($left_arr,array($key),$right_arr);
	}
	
	/**
	 * find by erfen
	 * @param  [type] $arr
	 * @param  [type] $low
	 * @param  [type] $high
	 * @param  [type] $key
	 * @return [type]
	 */
	public static function find_by_ef($arr, $low, $high, $key)
	{
		if($low <= $high)
		{
			$mid = ($low + $high) / 2;
			if($arr[$mid] == $key)
			{
				echo 'find', $key;
				return $mid;
			}
			else if($arr[$mid] > $key)
			{
				return self::find_by_ef($arr, $mid + 1, $high, $key);
			}
			else
			{
				return self::find_by_ef($arr, $low, $mid - 1, $key);
			}
		}
		
		die('not find');
	}

	/**
	 * compare the difference between urlencode and rawurlencode
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public static function urlencode_and_rawurlencode($url)
	{
		var_dump(urlencode($url));
		var_dump(rawurlencode($url));
	}

	/**
	 * some functions about date
	 * @return [type] [description]
	 */
	public static function echo_datetime()
	{
		echo date("Y-M-d D H:i:s", time()), '</br>';
		echo date("Y-m-d H:i:s"), '</br>';
		echo time(), '</br>';
		echo strtotime('now'), '</br>';
		echo strtotime("10 September 2000"), '</br>';
		echo strtotime("+1 day"), '</br>';
		echo strtotime("+1 week"), '</br>';
		echo strtotime("+1 week 2 days 4 hours 2 seconds"), '</br>';
		echo strtotime("next Thursday"), '</br>';
		echo strtotime("last Monday"), '</br>';

		//mktime(hour,minute,second,month,day,year,is_dst)
		echo (date("M-d-Y", mktime(0,0,0,12,36,2001))), '</br>';
		echo (date("M-d-Y", mktime(0,0,0,14,1,2001))), '</br>';
		echo (date("M-d-Y", mktime(0,0,0,1,1,2001))), '</br>';
		echo (date("M-d-Y", mktime(0,0,0,1,1,99))), '</br>';

		//echo "2014-Aug-16-Sat"
		echo date("Y-M-d-D", strtotime("16 August 2014")), '</br>';
		echo date("Y-M-d-D", mktime(0, 0, 0, 8, 16, 2014)), '</br>';

		//judge whether the time is correct
		$str = "2014-08-16 12:00:00";
		echo date('Y-m-d H:i:s', strtotime($str)) === $str;
		
	}

	public static function regex_match()
	{
		$email_regex = '/^[a-z0-9]([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i';
		$email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
		$email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.(com|cn|org))$/';
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
	
}


	$arr = array(1, 3, 2, 5, 6, 3, 3, 1, 4, 5);
	iat::sort_by_mp($arr);
	iat::sort_by_jh($arr);
	iat::sort_by_xz($arr);
	var_dump(iat::sort_by_ks($arr));
	iat::find_by_ef($arr, 0, count($arr), 6);

	$url = "http://姚善良 姚善良";
	iat::urlencode_and_rawurlencode($url);

	iat::echo_datetime();

	iat::regex_match();