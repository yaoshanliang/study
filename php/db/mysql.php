<?php
	$host = "10.10.65.153";
	$user = "root";
	$password = "sklcc";
	$db = "sl";

	try{
		$con = mysql_connect($host, $user, $password);
		mysql_select_db($db, $con);
		$sql = "select `base_num` from sl_base limit 1";//记住：如果有数据库前缀的话一定要加上

		//mysql_fetch_array
		$query = mysql_query($sql);
		while($row = mysql_fetch_array($query))
		{
			var_dump($row);
		}

		//mysql_fetch_row
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query))
		{
			var_dump($row);
		}

		//mysql_fetch_assoc
		$query = mysql_query($sql);
		while($row = mysql_fetch_assoc($query))
		{
			var_dump($row);
		}

		//mysql_fetch_object
		$query = mysql_query($sql);
		while($row = mysql_fetch_object($query))
		{
			var_dump($row);
		}
		mysql_close($con);
	}
	catch(exception $e)
	{
		var_dump($e);
	}
?>
