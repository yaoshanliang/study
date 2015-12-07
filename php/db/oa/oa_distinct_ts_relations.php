<?php
/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-31
 * @File: change_name.php
 * @Function: change teachers' realname
 */

$beginid = 1225;
$endid = 1386;
$db_host = "10.10.64.29";
$db_name = "oa_jyxy";
$db_user = "iat";
$db_password = "ysl88842412";
$dsn = "mysql:host=$db_host; dbname=$db_name";
try {
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->beginTransaction();
    $dbh->query('set names utf8');

    $sql = "SELECT * FROM `oa_ts_relations` WHERE  `deleted`='0'";
    $sth = $dbh->prepare($sql);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    print_r(count($result));

    $sql = "SELECT * FROM `oa_ts_relations` WHERE `tea_ID` =:tea_ID and `stu_ID`=:stu_ID and `deleted` = '0'";
    $sth = $dbh->prepare($sql);

    $sql = "update `oa_ts_relations` set `deleted`='1' WHERE `id` =:id ";
    $sth_to_distinct = $dbh->prepare($sql);
    foreach ($result as $key => $value)
    {

        $tea_ID = $value->tea_ID;
        $stu_ID = $value->stu_ID;
        $sth->bindParam(':tea_ID', $tea_ID);
        $sth->bindParam(':stu_ID', $stu_ID);
        if($sth->execute())
        {
            $result_to_distinct = $sth->fetchAll(PDO::FETCH_CLASS);
            //print_r(count($result));
            //echo count($result);
            if(count($result_to_distinct) == 2)
            {
                echo $result_to_distinct[0]->id;
                echo ":";
                echo $result_to_distinct[0]->tea_ID;
                echo "->";
                echo $result_to_distinct[0]->stu_ID;
                echo "\n";
                echo $result_to_distinct[1]->id;
                echo ":";
                echo $result_to_distinct[1]->tea_ID;
                echo "->";
                echo $result_to_distinct[1]->stu_ID;
                echo "\n";
                //要删除的
                /*$sth_to_distinct->bindParam(':id', $result_to_distinct[0]->id);
                if(!$sth_to_distinct->execute())
                    echo "update", $result_to_distinct[0]->id, 'error', "\n";
                echo "update", $result_to_distinct[0]->id, 'success', "\n";*/
            }
        }
        else
            print_r($sth->errorInfo());
    }
    $dbh->commit();
    $dbh = NULL;
}catch(PDOException  $e) {
    $dbh->rollBack();
    echo $e->getMessage();
}