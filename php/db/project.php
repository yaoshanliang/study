<?php
// |-----------------------------------------------------------------------------------
// | Author    iat <iat.net.cn@gmail.com>
// | Site      http://iat.net.cn
// | Copyright (c) 2013-2014
// |-----------------------------------------------------------------------------------
/**
 * script for setting password and other infomation in project oa
 * @package
 * @author iat <iat.net.cn@gmail.com>
 * @time 20141007
 */

$beginid = 145;
$endid = 147;
$db_host = "10.10.65.152";
$db_name = "project_test";
$db_user = "root";
$db_password = "sklcc";
$dsn = "mysql:host=$db_host; dbname=$db_name";
try {
    $dbh = new PDO($dsn, $db_user, $db_password);

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
    $college_id = 27;
    $sql = "SELECT * FROM pro_project_main_info where `college_id` = :college_id and `PID` = 'KYJJ' and `TIME` = 16";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':college_id', $college_id);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll();
    foreach ($result as $v) {
        echo $v['id'], '=>', $v['stuID'], "\n";
        $sql = "UPDATE pro_attachment SET main_info_id=:id where stuID =:stuID";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':id', $v['id']);
        $sth->bindParam(':stuID', $v['stuID']);
        if(!$sth -> execute()) print_r($sth->errorInfo());
    }

    //print_r(count($result));
    //print_r($result);
    $dbh = NULL;
}catch(PDOException  $e) {
    echo $e->getMessage();
}