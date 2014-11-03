<?php
/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-31
 * @File: change_name.php
 * @Function: change teachers' realname
 */

$beginid = 1225;
$endid = 1386;
$db_host = "10.10.65.48";
$db_name = "oa_test";
$db_user = "iat";
$db_password = "ysl88842412";
$dsn = "mysql:host=$db_host; dbname=$db_name";
try {
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->beginTransaction();
    $dbh->query('set names utf8');

    $sql = "SELECT * FROM `oa_user` WHERE `realname` =:realname";
    $sth = $dbh->prepare($sql);
    $realname = '周晓方';//第一个手动匹配的导师
    $sth -> bindParam(':realname', $realname);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll();
    //print_r($result);
    $account = $result[0]['account'];

    $sql = "SELECT * FROM `oa_ts_relations` WHERE `tea_ID` ='$account' and `deleted` = '0'";
    $sth = $dbh->prepare($sql);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    //print_r(count($result));

    $sql = "SELECT * FROM `oa_user` WHERE `realname` =:realname";
    $sth = $dbh->prepare($sql);
    $realname = '刘冠峰';//接下来的团队导师
    $sth -> bindParam(':realname', $realname);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $insert_teacher = $sth->fetchAll();
    //print_r($insert_teacher);
    $insert_tea_ID = $insert_teacher[0]['account'];

    $sql = "INSERT into `oa_ts_relations`(`tea_ID`, `stu_ID`) values('$insert_tea_ID', :stu_ID)";
    $sth = $dbh->prepare($sql);
    foreach ($result as $key => $value)
    {

        $stu_ID = $value->stu_ID;
        $sth->bindParam(':stu_ID', $stu_ID);
        if($sth->execute())
            echo $key, ':', 'Insert ', $realname, '->', $value->stu_ID, ' success', "\n";
        else
            print_r($sth->errorInfo());
    }
    $dbh->commit();
    $dbh = NULL;
}catch(PDOException  $e) {
    $dbh->rollBack();
    echo $e->getMessage();
}