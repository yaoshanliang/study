<?php

/**
 * script for setting password and other infomation in project oa
 * @package
 * @author iat <iat.net.cn@gmail.com>
 * @time 20141007
 */

$beginid = 347;
$endid = 693;
$db_host = "10.10.65.152";
$db_name = "oa_test";
$db_user = "root";
$db_password = "sklcc";
$dsn = "mysql:host=$db_host; dbname=$db_name";
try {
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->beginTransaction();
    $sql = "SELECT * FROM `oa_user` WHERE `id` between :beginid and :endid ";
    $sth = $dbh->prepare($sql);
    $sth -> bindParam(':beginid', $beginid);
    $sth -> bindParam(':endid', $endid);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    print_r(count($result));

    //update password
    //$sql = "UPDATE `oa_user` SET `password` = :password where `id` = :id";
    //$sql = "UPDATE `oa_user` SET `account` = :account where `id` = :id";
    //$sql = "delete from oa_usergroup where `group` = 'teacher'";
    //$sql = "insert into oa_usergroup(`account`, `group`) values(:account,:group)";
    $sql = "insert into oa_ts_relations(`tea_ID`, `stu_ID`) values(:tea_ID, :stu_ID)";
    $sth = $dbh->prepare($sql);
    foreach ($result as $key => $value)
    {
        $stu_ID = $value->account;
        //$group = $value->role_id;
        $tea_ID = 'yangzhe';
        $id = $value->id;
        $sth->bindParam(':stu_ID', $stu_ID);
        $sth->bindParam(':tea_ID', $tea_ID);
        if($sth->execute())
            echo 'Update ', $value->account, ' success', "\n";
        else
            print_r($sth->errorInfo());
    }
    $dbh->commit();
    $dbh = NULL;
}catch(PDOException  $e) {
    $dbh->rollBack();
    echo $e->getMessage();
}