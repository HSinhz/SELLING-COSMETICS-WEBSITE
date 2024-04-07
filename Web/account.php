<?php 
    session_start();
    if( !isset($_SESSION['username'])){
        header('location: ../index.php');
    } else {
        include '../control/control.php';
        $con = new control();
        $username = $_SESSION['username'];
        $account = $con -> getAccountbyUser($username);
        $infaccount = mysqli_fetch_array($account);      
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TÀI KHOẢN - SWEET DREAM</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/account.css">
        <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
        
    </head>
    <body>
        <div id="head">
            <?php include '../header.php'?>
        </div>
        <div id="content">
            <div class="content-section width-800">
                
                <div class="box-infor ">
                    <h1>THÔNG TIN TÀI KHOẢN</h1>
                    <div class="sub-box">
                        <div class="left-box">
                            <p class="detail">Họ Tên</p>
                            <p class="detail">Số điện thoại</p>
                            <p class="detail">Địa chỉ</p>
                            <p class="detail">Email</p>
                            <p class="detail">Mật khẩu</p>
                        </div>
                        <div class="right-box">
                            <p class="detail"><a href="updateaccount.php?type=1"><?php echo $infaccount['Ten']?> </a></p>
                            <p class="detail"><a href="updateaccount.php?type=2"><?php echo $infaccount['sdt']?> </a></p>
                            <p class="detail"><a href="updateaccount.php?type=3"><?php echo $infaccount['diachi']?> </a></p>
                            <p class="detail"><?php echo $infaccount['email']?></p>
                            <p class="detail"><a href="updateaccount.php?type=4"><?php echo '***********'?> </a></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


    </body>
    </html>
<?php  
    }
?>