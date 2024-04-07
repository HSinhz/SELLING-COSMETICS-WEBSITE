<?php 
    include '../db/connect.php';
    include '../control/control.php';

    $idsp = $_GET['idsp'];

    deleteProduct($idsp);
?>