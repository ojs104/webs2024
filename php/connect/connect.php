<?php
    $host = "localhost";
    $user = "ojs104";
    $pw = "dchs9577!!";
    $db = "ojs104";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf-8");

    // if(mysqli_connect_errno()){
    //     echo "DATABASE Connect False";
    // } else {
    //     echo "DATABASE Connect True";
    // }

?>