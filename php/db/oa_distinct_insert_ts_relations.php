<?php
/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-31
 * @File: change_name.php
 * @Function: change teachers' realname
 */


$db_host = "10.10.64.29";
$db_name = "oa_jyxy";
$db_user = "iat";
$db_password = "ysl88842412";
$dsn = "mysql:host=$db_host; dbname=$db_name";

$db_name_test = "oa_test";
$dsn_test = "mysql:host=$db_host; dbname=$db_name_test";

try {
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh_test = new PDO($dsn_test, $db_user, $db_password);
    $dbh->beginTransaction();
    $dbh->query('set names utf8');
    $dbh_test->query('set names utf8');

    $sql_test = "SELECT * FROM `oa_ts_relations` WHERE  `deleted`='0'";
    $sth_test = $dbh_test->prepare($sql_test);
    if(!$sth_test -> execute()) print_r($sth_test->errorInfo());
    $result_test = $sth_test->fetchAll(PDO::FETCH_CLASS);
    print_r(count($result_test));



    $sql = "INSERT into `oa_ts_relations`(`tea_ID`, `stu_ID`, `createtime`, `updatetime`, `team`) values(:tea_ID, :stu_ID, :createtime, :updatetime, :team)";
    $sth = $dbh->prepare($sql);
    foreach ($result_test as $key => $value)
    {

        $tea_ID = $value->tea_ID;
        $stu_ID = $value->stu_ID;
        $createtime = $value->createtime;
        $updatetime = $value->updatetime;
        $team = $value->team;
        $sth->bindParam(':tea_ID', $tea_ID);
        $sth->bindParam(':stu_ID', $stu_ID);
        $sth->bindParam(':createtime', $createtime);
        $sth->bindParam(':updatetime', $updatetime);
        $sth->bindParam(':team', $team);
        if($sth->execute())
        {
            echo "insert ", ++$i, ': ';
            echo $tea_ID, '->', $stu_ID, ' ', 'success', "\n";
        }
        else
            print_r($sth->errorInfo());
    }
    $dbh->commit();
    $dbh = NULL;
    $dbh_test = NULL;
}catch(PDOException  $e) {
    $dbh->rollBack();
    echo $e->getMessage();
}