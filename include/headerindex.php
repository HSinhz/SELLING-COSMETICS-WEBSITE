<?php 
    session_start();
    // include 'funcion/control.php';
    // echo $_SESSION['Ten'];
?>

<header>
        <div class="container-header">
            <a href="index.php"><img id="logo" src="images/logo.png" alt="#"></a>
            <ul id="nav-left">
                <li><a class="text-dark text-decoration-none" href="#">Trang chủ</a></li>
                <li><a class="text-dark text-decoration-none" href="include/About.php">Giới thiệu</a></li>
                <li><a class="text-dark text-decoration-none" href="Web/hot-product.php">Nổi bật</a></li>
                <li><a class="text-dark text-decoration-none" href="Web/product.php">Sản phẩm</a></li>
                <?php 
                    if( isset($_SESSION['giohang'])){
                        if( isset($_SESSION['sizecart'])){
                                echo '
                                    <li><a class="text-dark text-decoration-none" href="Web/cart.php">Giỏ hàng ('.$_SESSION['sizecart'].') </a></li>
                                ';
                        }
                    } else {
                        echo '
                            <li><a class="text-dark text-decoration-none" href="Web/cart.php">Giỏ hàng (0) </a></li>
                        ';
                    }
                ?>
                <?php 
                    if( isset($_SESSION['username'])) {
                        if(isset($_SESSION['role']) ){
                            $role = $_SESSION['role'];
                            if( $role == 1) 
                            echo '
                                <li><a class="text-dark text-decoration-none" href="admin.php">Quản lý</a></li>
                            ';
                        }
                    }
                ?>
            </ul>
            <?php 
                if(isset($_SESSION['username']) && isset($_SESSION['Ten'])){
                    echo '
                    <div class="nav-right">
                        <a class="text-dark text-decoration-none" href="Web/account.php" style="padding: 20px">'.$_SESSION['Ten'].'</a>
                        <a class="text-dark text-decoration-none" href="control/logout.php" >Log out</a>
                    </div>
                    ';
                } else {
                    echo '
                        <div class="nav-right">
                            <a class="text-dark text-decoration-none" href="include/sign-in.php" style="padding: 20px">Sign in</a>
                            <a class="text-dark text-decoration-none" href="include/login.php">Log in</a>
                        </div>
                    ';
                }
            ?>
        </div>
</header>