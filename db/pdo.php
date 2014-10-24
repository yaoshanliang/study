<?php
/**
 * Created by PhpStorm.
 * User: iat
 * Date: 10/4/14
 * Time: 10:37 PM
 */
$db_type = 'mysql';
$db_host = "10.10.65.152";
$db_name = "oa_test";
$db_user = "root";
$db_password = "sklcc";
$dsn = "$db_type:host=$db_host;dbname=$db_name";
try
{
    $conn = new PDO($dsn, $db_user, $db_password);
    $conn->beginTransaction();

    //$sql = "SELECT * FROM `user` WHERE name = :name";
    //$sql = "SELECT * FROM `oa_user` WHERE account = :name";
    //$sql = "UPDATE oa_user set `id` = '152' where `id` = 152";
    $sql = "delete from oa_user where id between 1093 and 1224;";
    $stmt = $conn->prepare($sql);
    //if($stmt->execute() == 0)
    //if($stmt->execute() == '')
    //if(!$stmt->execute())
    if($stmt->execute() == false)
       echo "update failed";
    else
        print_r($stmt->errorInfo());
    //var_dump($result);
    //$stmt->execute(array(':name' => $name));
    $conn->commit();

    $dbh = NULL;
}catch(PDOException  $e)
{
    $conn->rollBack();
    echo $e->getMessage();
}