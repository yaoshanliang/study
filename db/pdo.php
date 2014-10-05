<?php
/**
 * Created by PhpStorm.
 * User: iat
 * Date: 10/4/14
 * Time: 10:37 PM
 */
$db_type = 'mysql';
$db_host = "10.10.65.152";
$db_name = "oa";
$db_user = "root";
$db_password = "sklcc";
$dsn = "$db_type:host=$db_host;dbname=$db_name";
try
{
    $conn = new PDO($dsn, $db_user, $db_password);
    $conn->beginTransaction();
    $name = 'admin';
    $sql = "SELECT * FROM `user` WHERE name = :name";
    $sql = "SELECT * FROM `oa_user` WHERE account = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);//绑定参数
    $stmt->bindValue(':name', 'iat');//绑定变量
    $stmt->execute();
    $stmt->execute(array(':name' => $name));
    $conn->commit();
    $result = $stmt->fetchAll();
    var_dump($result);
    $dbh = NULL;
}catch(PDOException  $e)
{
    $conn->rollBack();
    echo $e->getMessage();
}