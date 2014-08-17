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
		$email = array('iat.net.cn@gmail.com', 
						'1329517386@qq.com', 
						'1227403052@suda.edu.cn', 
						'yaoshanliang@foxmail.com', 
						'iat-net-cn@gmail.com',
						'iat..net.cn@gmail.com',
						'iat-.net.cn@gmail.com',
						'-iat.net.cn@gmail.com');
		foreach ($email as $key => $value) 
		{
			echo $value, '=>';
			if(preg_match($email_regex, $value) == 1)
			{
				echo 'is correct', '</br>';
			}
			else
			{
				echo "is incorrect", '</br>';
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