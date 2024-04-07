<?php 
    include '../db/connect.php';
    include '../db/connect_link.php';

    class checkAccount extends connect_link {

        function checkAccount($username,$password){
            $sql = "SELECT * FROM khachhang WHERE email = '".$username."' AND password = '".$password."' ";
            return $this->link->query($sql); 
        }

        function getAccountbyUser($user_name){
            $sql = "SELECT * FROM khachhang WHERE email = '$user_name'";
            return $this->link->query($sql); 
        }
    }
?>