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

	public static function urlencode_and_rawurlencode($url)
	{
		var_dump(urlencode($url));
		var_dump(rawurlencode($url));
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