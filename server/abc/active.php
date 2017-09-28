<?php

include('../inc/db.php');

$db = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', "dbuser", "password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if(isset($_POST['HWID']))
    $hwid = $_POST['hwid'];
else {
    header('Location: ../index.php');
    exit();
}

// active bot count
$date = date('c');
$d=date('c',time()-1800);


if(strpos('bot')) {
    $query = "REPLACE INTO `bots` (time) VALUES ('$date') WHERE hwid=:hwid";
    $qdata = [":hwid" => $hwid];
    $result = DB::query($query, $qdata);
}

if(strpos('panel')) {

    $result = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id FROM bots WHERE `time` > '$d'"); 
    $result->execute();
    $result = $db->prepare("SELECT FOUND_ROWS()"); 
    $result->execute();
    $row_count = $result->fetchColumn();
    $total = $row_count;

    echo $total;

}



?>