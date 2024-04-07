<?php 
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "mypham1";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if($conn){
        mysqli_query($conn , "SET NAMES 'utf8'");
    } else {
        echo "Connect fail".mysqli_connect_error();
    }
?>