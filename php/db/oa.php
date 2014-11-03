<?php

/**
 * script for setting password and other infomation in project oa
 * @package 
 * @author iat <iat.net.cn@gmail.com>
 * @time 20141007
 */

$beginid = 145;
$endid = 147;
$db_host = "10.10.65.152";
$db_name = "oa";
$db_user = "root";
$db_password = "sklcc";
$dsn = "mysql:host=$db_host; dbname=$db_name"; 
try {
	$dbh = new PDO($dsn, $db_user, $db_password);
	$sql = "SELECT * FROM `oa_user` WHERE `id` between :beginid and :endid ";
	$sth = $dbh->prepare($sql);
	$sth -> bindParam(':beginid', $beginid);
	$sth -> bindParam(':endid', $endid);
	if(!$sth -> execute()) print_r($sth->errorInfo());
	$result = $sth->fetchAll(PDO::FETCH_CLASS);
	print_r($result);

	//update password
	/*$sql = "UPDATE `oa_user` SET `password` = :password where `id` = :id";
	$sth = $dbh->prepare($sql);
	foreach ($result as $key => $value)
	{
		$password = md5($value->account);
		$id = $value->id;
		$sth->bindParam(':password', $password);
		$sth->bindParam(':id', $id);
		if($sth->execute())
			echo 'Update ', $value->account, ' success', "\n";
		else
			print_r($sth->errorInfo());
	}*/
	
	$dbh = NULL;
}catch(PDOException  $e) {
	echo $e->getMessage();
}