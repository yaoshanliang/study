<?php
//交换两数
function swap(&$a, &$b)
{
	$temp = $a;
	$a = $b;
	$b = $temp;
}

//输出
function cout($arr)
{
	foreach($arr as $a)
	{
		echo $a . " ";
	}
	echo "\n";
}

//冒泡排序
function sort_by_mp(&$arr)
{
	$n = count($arr);
	for ($i = 0; $i < $n; $i++)
	{
		for ($j = 0; $j < $n - $i - 1; $j++)
		{
			if($arr[$j] < $arr[$j + 1])
			{
				swap($arr[$j], $arr[$j+1]);
			}
		}
	}
	return $arr;
}

//交换排序
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

//选择排序
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

//快速排序，时间复杂度O(nlogn)
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

//插入排序, 时间复杂度O(n^2)
function sort_by_cr(&$arr)
{
	$n = count($arr);
	for($i = 1; $i < $n; $i++)
	{
		$j = $i;
		$temp = $arr[$i];
		while($j > 0 && $temp < $arr[$j - 1])
		{
			$arr[$j] = $arr[$j - 1];
			$j--;
		}
		$arr[$j] = $temp;
	}
	return $arr;
}


//测试====================================================
$arr = array(1, 3, 2, 5, 6, 3, 3, 1, 4, 5);
cout($arr);
// iat::sort_by_mp($arr);
// iat::sort_by_jh($arr);
// iat::sort_by_xz($arr);
// var_dump(iat::sort_by_ks($arr));
sort_by_cr($arr);
cout($arr);
