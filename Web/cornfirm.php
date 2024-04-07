<?php 
    session_start();
    include '../control/control.php';
    $con = new control(); 
        
    if( !isset($_SESSION['username']) && !isset($_SESSION['giohang'])){
        header('location: ../index.php');
        $showcart = 0;
    } else if( isset($_SESSION['giohang'])){
        if( isset($_SESSION['username']) ){
            $showcart = 1;
            $username = $_SESSION['username'];
            $account = $con -> getAccountbyUser($username);
            $infaccount = mysqli_fetch_array($account);
        } else if( !isset($_SESSION['username']) ){
            $showcart = 2;
        }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận - SWEET DREAM</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/cart.css">
        <link rel="stylesheet" href="../style/detail-product.css">
        

    </head>
    <body>
    <div id="head">
            <?php include '../header.php'?>
        </div>

        <div id="content">
            <div class="content-section-cart">
                <div class="form-infor">
                    <form action="bill.php" method="post">
                        <div class="infor-oder">
                            <h2 style="font-size: 32px;">THÔNG TIN NHẬN HÀNG</h2>
                            <div>Bạn đã có tài khoản: <a style="color:blue" href="login.php">Đăng nhập</a> </div>
                            <input type="hidden" name="idkh" value="<?php echo $infaccount['iddkhach']?>" class="form-input" >
    
                            <div class="box-input">
                                <input type="text" required name="ten" placeholder="<?php if( $showcart == 1){ echo $infaccount['Ten'];} else { echo 'Họ và tên';} ?>" class="form-input" value="<?php if( $showcart == 1){ echo $infaccount['Ten'];} ?>">
                            </div>
                            <div class="box-input">
                                <input type="text" required name="diachi" placeholder="<?php if( $showcart == 1){ echo $infaccount['diachi'];} else {echo 'Địa chỉ nhận hàng';} ?>" class="form-input" value="<?php if( $showcart == 1){ echo $infaccount['diachi'];} ?>">
                            </div>
                            <div class="box-input">
                                <input type="text" required name="sdt" placeholder="<?php if( $showcart == 1){ echo $infaccount['sdt'];}else {echo 'Số điện thoại';} ?>" class="form-input" value="<?php if( $showcart == 1){ echo $infaccount['sdt'];} ?>">
                            </div>
                            <?php 
                                if( $showcart == 1 ){
                            ?>
                            <div class="box-input">
                                <input type="text" required name="email" placeholder="<?php if( $showcart == 1){ echo $infaccount['email'];} else {echo 'Email';} ?>" class="form-input" value="<?php if( $showcart == 1){ echo $infaccount['email'];} ?>">
                            </div>
                            <?php 
                                }
                            ?>
                            <?php 
                                if( $showcart == 2 ){
                                    echo 'Nhập tài khoản để xem đơn hàng';
                            ?>
                                <div class="box-input">
                                    <input type="text" required name="email" placeholder="<?php if( $showcart == 1){ echo $infaccount['email'];} else {echo 'Email';} ?>" class="form-input" value="<?php if( $showcart == 1){ echo $infaccount['email'];} ?>">
                                </div>
                                <div class="box-input">
                                    <input type="password" required name="pass" placeholder="Mật khẩu" class="form-input" >
                                </div>
                            <?php 
                                }
                            ?>
                            <div class="delete-cart">
                                <input type="submit" value="Xác nhận đơn hàng" name="xacnhan">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="oder">
                    <?php 
                        if( $showcart == 1 ){
                            showdonhang();  
                        } else if($showcart == 2) {
                            showdonhang();  
                        }
                    ?>
                </div>
            
            </div>
        </div>s
    </body>
    </html>
<?php 
    }
?>
