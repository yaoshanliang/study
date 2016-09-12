<?php
require_once('pinyin.php');
header('Content-type:text/json');
// header("Content-type:text/html;charset=utf-8");
$beginid = 145;
$endid = 147;
$db_host = "192.168.1.50";
$db_name = "test";
$db_user = "root";
$db_password = "welcome1";
$dsn = "mysql:host=$db_host; dbname=$db_name;";
try {
	$dbh = new PDO($dsn, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
    $sql = "SELECT * FROM `ep_areas` where parent_id = 0";
	$sth = $dbh->prepare($sql);
	if(!$sth -> execute()) print_r($sth->errorInfo());
	$result = $sth->fetchAll(PDO::FETCH_CLASS);

	foreach ($result as $key => $value)
	{
        if (in_array($value->area_name, ['北京市', '天津市', '上海市', '重庆市'])) {
            $json[$value->area_name] = $value->area_name;
        } else {
            $sql = "SELECT * FROM `ep_areas` where `parent_id` = $value->area_id";
            $sth = $dbh->prepare($sql);
            if($sth->execute()) {
                $cities = $sth->fetchAll(PDO::FETCH_CLASS);
                foreach ($cities as $k => $v) {
                    $json[$v->area_name] = $value->area_name.$v->area_name;
                }
            } else {
                print_r($sth->errorInfo());
            }
        }
	}

    ksort($json);
    foreach($json as $k => $v) {
        $firstCharacter = substr(CUtf8_PY::encode($k), 0, 1);
        $cities[$firstCharacter][] = ['name' => $k, 'fullname' => $v];
    }
    ksort($cities);
    foreach ($cities as $k => $v) {
        $tmp['index'] = $k;
        $tmp['lists'] = $v;
        $data[] = $tmp;

    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

	$dbh = NULL;
}catch(PDOException  $e) {
	echo $e->getMessage();
}
