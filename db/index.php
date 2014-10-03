<?php 
	
	$beginid = 1;
	$endid = 2;
	$db_host = "10.10.65.152";
	$db_name = "oa";
	$db_user = "root";
	$db_password = "sklcc";
	$dsn = "mysql:host=$db_host;dbname=$db_name"; 
	try
	{
		$dbh = new PDO($dsn, $db_user, $db_password); 
		$sql = "SELECT * FROM `oa_user` WHERE `id` between :beginid and :endid";
		$sth = $dbh->prepare($sql); 
		$sth -> bindValue(':beginid', $beginid);
		//$sth -> bindParam(':beginid', $beginid);
		$sth -> bindParam(':endid', $endid);
		$sth -> execute();
		//$sth->execute(array(':beginid' => $beginid, ':endid' => $endid)); 
		$result = $sth->fetchAll(PDO::FETCH_OBJ); 
		//echo $result->account ; 
		foreach ($result as $key => $value) {
			print_r($value->account);
		}
		//print_r($result);
		$sql = "UPDATE `oa_user` SET `password` = :password where `id` = :id";
		$dbh = NULL; 
	}catch(PDOException  $e)
	{
		echo $e->getMessage();
	}

	//exit();
?> 