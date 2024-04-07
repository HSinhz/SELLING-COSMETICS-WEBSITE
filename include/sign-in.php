<?php 
    include '../db/connect.php';
    include '../control/control.php';
    
    
    $con = new control();
    $checkemail = 3; // checkmail = 2: Tên đăng nhập chưa lớn hơn 5 kí tự
                     // checkmail = 1: Tên đăng nhập đã tồn tại
    $checkpassword = 3; // checkpass = 1: Mật khẩu chưa lớn hơn 8 ksi tự
    
    $ticke = 0; // ticke = 1: đã đủ điều kiện để tạo tài khoản mới
                // ticke = 0: Chưa đủ điều kiện 

    $tickp = 0;// tickp = 1: đã đủ điều kiện để tạo tài khoản mới
               // tickp = 0: Chưa đủ điều kiện
    if( isset($_POST['username'])){
        $user_name = $_POST['username'];
        $result = $con ->getAccountbyUser($user_name);
        // echo mysqli_num_rows($result);
        if( strlen($user_name) > 5 ){
            if( mysqli_num_rows($result) == 0){ // kiểm tra xem tên đăng nhập đã tồn tại hay chưa
                $ticke = 1;
            } else {
                $checkemail = 1;
                $ticke =0;
            }
        } else {
            $checkemail = 2;  
            $ticke = 0;
        }

        // if( mysqli_num_rows($result) > 0){
        //     $checkemail = 1;
        //     $tick =0;
        // } else {
        //     $tick = 1;
        // }

        if( isset($_POST['password'])){
            $password = $_POST['password'];
            if( strlen($password) > 8 ){
                $tickp = 1;

            }  else {
                $checkpassword = 1; 
                $tickp =0;
            }
        } 

    }
    if( $ticke == 1 && $tickp == 1 ){
        echo '<script>alert("Đăng kí thành công");</script>';
    } 
    if( $ticke == 1 && $tickp == 1 ){
        $ten = $_POST['fullname'];
        $sdt = $_POST['phone-number'];
        $diachi = $_POST['address'];
        $_SESSION['username'] = $user_name;
        $con -> taoAccount($ten,$user_name,$password,$sdt,$diachi);
        header('location: login.php');
    } 

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    
</head>
<body>
<header>
        <div class="container-header">
            <img id="logo" src="../images/logo.png" alt="#">
            <ul id="nav-left">
                <li><a href="../index.php">Trang chủ</a></li>
                <li><a href="">Giới thiệu</a></li>
                <li><a href="../Web/product.php">Sản phẩm</a></li>
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
                            <a class="sign-in" href="#">Sign in</a>
                            <a class="log-in" href="login.php">Log in</a>
                        </div>
                    ';
                }
            ?>
        </div>
</header> 
    <div id="content">
        <div class="content-section width-800">
            <div class="form-login">
                <h1>Đăng kí tài khoản</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-input">
                        <input type="text" required name="fullname" placeholder="Họ và Tên"  class="form-input width-100per"> 
                    </div>
                    <div class="box-input">
                        <input type="text" required name="address" placeholder="Địa chỉ"  class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <input type="text" required name="phone-number" placeholder="Số điện thoại" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <input type="text"  name="username" placeholder="Email" id="name_user" class="form-input width-100per">
                        <div style="color: red;">
                            <?php 
                                if( $checkemail == 2 ){
                                    echo '<p style ="color: red;">Tên đăng nhập phải nhiều hơn 5 kí tự </p>';
                                } else if( $checkemail == 1) {
                                     echo '<p style ="color: red;"> Tên đăng nhập đã tồn tại. Vui lòng nhập lại </p>';
                                }
                            ?>
                        </div>
                       
                    </div>
                    <div class="box-input">
                        <input type="password" required name="password" placeholder="Mật khẩu" id="password" class="form-input width-100per">   
                        <?php 
                           if( $checkpassword == 1){
                                echo '<p style ="color: red;">Mật khẩu phải dài hơn 8 kí tự</p>';   
                           }
                        ?>
                    </div>
                    <div class="box-input">
                        <button type="submit" class="btn-submit" style="font-size: 18px" >Đăng kí</button>
                    </div>
                </form>

            </div>       
        </div>
    </div>
</body>
</html>