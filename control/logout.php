<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['Ten']);
    unset($_SESSION['role']);
    header('location: ../include/login.php')
?>