<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "bookmarked";

    $conn = mysqli_connect($host,$user,$pass,$dbname);
   
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>