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
	$arr = array(1, 3, 2, 5, 6, 3, 3, 1, 4, 5);
	function swap(&$a, &$b)
	{
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	function sort_by_mp(&$arr)
	{
		$n = count($arr);
		for ($i = 0; $i < $n; $i++)
		{
			for ($j = 0; $j < $n -$i - 1; $j++)
			{
				if($arr[$j] < $arr[$j + 1])
				{
					swap($arr[$j], $arr[$j+1]);
				}
			}
		}
		var_dump($arr);
	}
	
	function sort_by_jh($arr)
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
	
	function sort_by_xz($arr)
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

	function sort_by_ks($arr)
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
		$left_arr = sort_by_ks($left_arr);
		$right_arr = sort_by_ks($right_arr);
		return array_merge($left_arr,array($key),$right_arr);
	}
	
	sort_by_mp($arr);
	sort_by_jh($arr);
	sort_by_xz($arr);
	var_dump(sort_by_ks($arr));
	
	
