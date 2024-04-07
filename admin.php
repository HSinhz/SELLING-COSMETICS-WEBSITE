<?php
    session_start();
    include 'db/connect.php';

    $sql = "SELECT * FROM account ";

    if( isset($_SESSION['username']) == false ){
        header('location: login.php');
    } else {
        if( isset( $_SESSION['role']) == true ) {
            $role = $_SESSION['role'];
            if( $role == 0 ){
                echo "Bạn không đủ quyền truy cập" . '<a href="index.php">Bấm vào đây để vào trang chủ</a>';
                exit();
            }   
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ - SWEET DREAM</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">

</head>
<body>
<header>
        <div class="container-header">
            <img id="logo" src="images/logo.png" alt="#">
            <ul id="nav-left">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="Admin/add-product.php">Thêm sản phẩm</a></li>
                <li><a href="Admin/qlsp.php">Danh sách sản phẩm</a></li>
                <li><a href="Admin/quanlydonhang.php">Quản lý đơn hàng</a></li>               
            </ul>
            <div class="nav-right">
                <a href="Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                <a href="control/logout.php"class="log-in" href="">Log out</a>
            </div>
        </div>
</header>
</body>
</html>