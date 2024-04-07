<?php 
    session_start();
    include '../db/connect.php';
    include '../control/control.php';
    
    if( isset($_POST['login'])){
        $email = $_POST['username'];
        $pass = $_POST['password'];
        $_SESSION['email'] = $email;
        $sql = "SELECT * FROM khachhangngoai WHERE email = '".$email."' AND pass = '".$pass."' ";
        $querry = mysqli_query($conn , $sql);
        $checkaccount = mysqli_num_rows($querry);
        if($checkaccount == 1){
            header('location: xemdonhang.php');
        }
    } else {
        $checkaccount = 0;
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem đơn hàng - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    
</head>
<body>
    <div id="head">
        <?php include '../header.php'?>
    </div>
    <div id="content">
        <div class="content-section">
            <?php 
                if( !isset($_SESSION['username'])){
            ?>
                <div class="form-login">
                    <h1>NHẬP TÀI KHOẢN ĐỂ XEM ĐƠN HÀNG</h1>
                    <form action="" method="post">
                        <div class="box-input">
                            <input type="text" required name="username" placeholder="Email" class="form-input">
                        </div>
                        <div class="box-input">
                            <input type="password" required name="password" placeholder="Password" class="form-input">
                        </div>
                        <div class="box-input">
                            <button type="submit" name="login" class="btn-submit">LOGIN</button>
                        </div>
                    </form>
                </div>
            <?php 
                } else if( isset($_SESSION['username']) ){
                    header('location: xemdonhang.php');
                }
            ?>
        </div>
    </div>
</body>
</html>