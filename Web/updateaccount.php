<?php 
    session_start();
    include '../control/control.php';
    $con = new control();
    if( isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $dtaccount = $con -> getAccountbyUser($username);
        $account = mysqli_fetch_assoc($dtaccount);
        $idkh = $account['idkhachhang'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật tài khoản - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/updateaccount.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    
</head>
<body>
<header>
            <div class="container-header">
                <a href="../index.php"><img id="logo" src="../images/logo.png" alt="#"></a>
                <ul id="nav-left">
                    <li><a href="../index.php">Trang chủ</a></li>   
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="product.php">Sản phẩm</a></li>
                    <?php 
                        if( isset($_SESSION['giohang'])){
                            if( isset($_SESSION['sizecart'])){
                                echo '
                                    <li><a href="cart.php">Giỏ hàng ('.$_SESSION['sizecart'].') </a></li>
                                ';
                            }
                        } else {
                            echo '
                                <li><a href="cart.php">Giỏ hàng (0) </a></li>
                            ';
                        }
                    ?>
                    <?php 
                        if( isset($_SESSION['username'])) {
                            if(isset($_SESSION['role']) ){
                                $role = $_SESSION['role'];
                                if( $role == 1) 
                                echo '
                                    <li><a href="../admin.php">Quản lý</a></li>
                                ';
                            }
                        }
                    ?>
                </ul>
                <?php 
                    if(isset($_SESSION['username']) ){
                        echo '
                        <div class="nav-right">
                            <a href="../control/logout.php" class="log-in">Log out</a>
                        </div>
                        ';
                    } else {
                        echo '
                            <div class="nav-right">
                                <a class="sign-in" href="../include/sign-in.php">Sign in</a>
                                <a class="log-in" href="../include/login.php">Log in</a>
                            </div>
                        ';
                    }
                ?>
            </div>
        </header>
        <div id="content">
            <div class="content-section width-300">
                <?php 
                    if(isset($_GET['type'])){
                        switch( $_GET['type']){
                            case 1:
                                {   
                                    include '../control/update/fullname.php';
                                    break;
                                } 
                            case 2:
                                {
                                    include '../control/update/sdt.php';
                                    break;
                                }
                            case 3:
                                {
                                    include '../control/update/diachi.php';
                                    break;
                                }
                            case 4:
                                {
                                    include '../control/update/matkhau.php';
                                    break;
                                }
                        }
                    }
                ?>
            </div>
        </div>

</body>
</html>