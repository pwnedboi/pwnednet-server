<?php

$uri = $_SERVER['REQUEST_URI'];

if(strpos($uri, "install")) {

    if(isset($_POST['init'])) {

        if($_POST == "true") {

            echo "continue";

        }

    }

}

?>