<?php 
	
	$beginid = 145;
	$endid = 147;
	$db_host = "10.10.65.152";
	$db_name = "oa";
	$db_user = "root";
	$db_password = "sklcc";
	$dsn = "mysql:host=$db_host;dbname=$db_name"; 
	try
	{
		$dbh = new PDO($dsn, $db_user, $db_password);
		//var_dump($dbh);
		//$sql = "SELECT * FROM `oa_user` WHERE `id` between :beginid and :endid ";
        $sql = "SELECT * FROM `oa_user";
		//$stmt = $dbh->prepare("INSERT INTO `oa_user`(`account`) VALUES (:account)");

		// values to enter
		//$data = array(
  	  	//	':account' => 'valueone',
		//);
		//if ($stmt->execute($data)) echo "Inserted successfully";
//print_r($stmt->errorInfo());
		var_dump($sth = $dbh->prepare($sql));


		//$sth -> bindValue(':beginid', $beginid);
		//var_dump($sth -> bindParam(':beginid', $beginid));
		//$sth -> bindParam(':endid', $endid);
		if(!$sth -> execute()) print_r($sth->errorInfo());
		//$sth->execute(array(':beginid' => $beginid, ':endid' => $endid));
		$result = $sth->fetchAll();
        //if(!$result) print_r($sth->errorInfo());
        print_r(($result));
        //print_r($result);
		//echo $result->account ;
       // $user = array();
		//foreach ($result as $key => $value) {

			//print_r($value->account);
		//}
		//print_r($result);

		/*$sql = "UPDATE `oa_user` SET `password` = :password where `id` = :id";
		$sth = $dbh->prepare($sql);
        foreach ($result as $key => $value)
        {
            $password = md5($value->account);
            $id = $value->id;
            $sth->bindParam(':password', $password);
            $sth->bindParam(':id', $id);
            $sth->execute();
            echo 'Update ', $value->account, ' success', "</br>";
        }
        $sql = "UPDATE `oa_user` SET `password` = 1 where `account` = 1";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        echo $sth->rowCount();*/

        $dbh = NULL;
	}catch(PDOException  $e)
	{
		echo $e->getMessage();
	}

