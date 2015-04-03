<?php
	$db_host = "10.10.65.153";
	$db_name = "oa";
	$db_user = "root";
	$db_password = "sklcc";
	$dsn = "mysql:host=$db_host;dbname=$db_name";
	$beginid = 1;
	$endid = 3;
	try
	{
		$dbh = new PDO($dsn, $db_user, $db_password);
		$sql = "SELECT `account` FROM `oa_user` WHERE `id` between :beginid and :endid ";
		$sth = $dbh->prepare($sql);

		//bindvalue
		$sth->bindValue(':beginid', $beginid);
		$sth->bindvalue(':endid', $endid);
		if(!$sth -> execute()) print_r($sth->errorInfo());
        if(!$result = $sth->fetchAll()) print_r($sth->errorInfo());
        var_dump($result);

		//bindParam
		$sth->bindParam(':beginid', $beginid);
		$sth->bindParam(':endid', $endid);
		if(!$sth -> execute()) print_r($sth->errorInfo());
        if(!$result = $sth->fetchAll()) print_r($sth->errorInfo());
        var_dump($result);

		//execute
		$sth->execute(array(':beginid' => $beginid, ':endid' => $endid));
        if(!$result = $sth->fetchAll(PDO::FETCH_NUM)) print_r($sth->errorInfo());
        var_dump($result);

		$sth->execute(array(':beginid' => $beginid, ':endid' => $endid));
        if(!$result = $sth->fetchAll(PDO::FETCH_ASSOC)) print_r($sth->errorInfo());
		var_dump($result);

		$sth->execute(array(':beginid' => $beginid, ':endid' => $endid));
        if(!$result = $sth->fetchAll(PDO::FETCH_BOTH)) print_r($sth->errorInfo());
		var_dump($result);

		$sth->execute(array(':beginid' => $beginid, ':endid' => $endid));
        if(!$result = $sth->fetchAll(PDO::FETCH_CLASS)) print_r($sth->errorInfo());
        var_dump($result);

        $dbh = NULL;
	}catch(PDOException  $e)
	{
		echo $e->getMessage();
	}

