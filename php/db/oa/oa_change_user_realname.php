<?php
/**
 * @Author: iat <iat.net.cn@gmail.com>
 * @Date: 2014-10-31
 * @File: change_name.php
 * @Function: change teachers' realname
 */

$beginid = 1392;
$endid = 4224;
$db_host = "10.10.64.29";
$db_name = "oa";
$db_user = "iat";
$db_password = "ysl88842412";
$dsn = "mysql:host=$db_host; dbname=$db_name";
try {
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->beginTransaction();
    $dbh->query('set names utf8');
    $sql = "SELECT * FROM `oa_user` WHERE `id` between :beginid and :endid ";
    $sth = $dbh->prepare($sql);
    $sth -> bindParam(':beginid', $beginid);
    $sth -> bindParam(':endid', $endid);
    if(!$sth -> execute()) print_r($sth->errorInfo());
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    print_r(count($result));

    $sql = "UPDATE `oa_user` SET `realname` = :realname where `id` = :id";
    $sth = $dbh->prepare($sql);
    foreach ($result as $key => $value)
    {
        $realname = str_replace(' ', '', $value->realname);
        //var_dump($value->realname);echo "=>";var_dump($realname);
        $id = $value->id;
        $sth->bindParam(':realname', $realname);
        $sth->bindParam(':id', $id);
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