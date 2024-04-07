<?php 
    session_start();
    include '../control/control.php';
    $con = new control();
    
    if( !isset($_SESSION['username'])){
        header('location: ../index.php');
    } else if( isset($_SESSION['username']) && isset($_SESSION['role'])){
        
        if( $_SESSION['role'] == 1){
            if( isset($_GET['iddh'])){
                $idbill = $_GET['iddh'];
            } else {
                header('location: quanlydonhang.php');
            }
            $kq1 = $con -> getStatusBill($idbill);
            $statusbill = mysqli_fetch_assoc($kq1);
            $trangthai = null;
            $kqs = $con -> getdetailBill($idbill);
            if( isset($_POST['xacnhan'])){
                $trangthai = 1;
                $con -> SuccessBill($idbill,$trangthai);        
                header('location: #');
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/cart.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../style/qldh.css">
    
</head>
<body>
<header>
        <div class="container-header">
            <a href="../index.php"><img id="logo" src="../images/logo.png" alt="#"></a>
            <ul id="nav-left">
                <li><a href="../index.php">Trang chủ</a></li>
                <li><a href="add-product.php">Thêm sản phẩm</a></li>
                <li><a href="qlsp.php">Danh sách sản phẩm</a></li>
                <li><a href="quanlydonhang.php">Quản lý đơn hàng</a></li>               
            </ul>
            <div class="nav-right">
            <div class="nav-right">
                <a href="../Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                <a class="log-in" href="../control/logout.php">Log out</a>
            </div>
            </div>
        </div>
</header>
    <div id="content">
        <div class="content-section-debill">
            <div class=""> <h1> Mã đơn hàng: <?php echo $idbill ?></h1> </div>
            <div class="inforbill">
                <div class="cart-thead">
                    <div>SẢN PHẨM</div>
                    <div style="width: 500px;"></div>
                    <div>SỐ LƯỢNG</div>
                    <div>GIÁ</div>
                    <div>THÀNH TIỀN</div>
                </div>
                <?php 
                    while( $kq = mysqli_fetch_array($kqs)){ 
                ?>
                        <div class="box-inf">
                            <div> <img src="../images/<?php echo $kq['hinhsp'] ?>" alt="" style="width:200px"></div>
                            <div class="infor-bill" style="width:350px;"> <?php echo $kq['tensp']?> </div> 
                            <div class="infor-bill"> <?php echo $kq['soluong']?> </div>
                            <div class="infor-bill"> <?php echo $kq['giasp']?> </div>
                            <div class="infor-bill"> <?php echo $kq['dongia']?> </div>
                        </div>
                        
                <?php 
                    }
                ?>
            </div>

            <div>
                <?php 
                    if( $statusbill['trangthai'] == 0){
                        echo '
                            <form action="" method="POST">
                                <button type="submit" name="xacnhan" class="btn-submit" style="font-size: 18px;margin-top: 24px ;">Xác nhận</button>
                            </form>
                        ';
                    } 
                    
                ?>
            </div>
            <div class="btn-list">
                <a href="quanlydonhang.php">Danh sách đơn</a>
            </div>
        </div>

    </div>
    
</body>
</html>

<?php 
    } else {
            header('location: ../index.php');
        }
    } else {
        header('location: ../index.php');
    }
?>