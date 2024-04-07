<?php 
    session_start();
    include '../control/control.php';
    $con = new control();

    if( !isset($_SESSION['username']) && isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $acc = $con ->getAccountnotLogin($email);
        $detailacc = mysqli_fetch_array($acc); 
        $idbill = $detailacc['idbill'];
        $bill = $con -> getdetailBill($idbill);

        $allbill = $con -> getBillbyID($idbill);
        $tt = mysqli_fetch_array($allbill);

    } else if( isset($_SESSION['username'])){
        $email = $_SESSION['username'];
        $acc = $con -> getAccountbyUser($email);
        $detailacc = mysqli_fetch_array($acc);
        $idbill = $detailacc['idbill'];
        $bill = $con -> getdetailBill($idbill);
        $allbill = $con -> getBillbyID($idbill);
        $tt = mysqli_fetch_array($allbill);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/cart.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../style/qldh.css">
    
</head>
<body>
    <div id="head">
        <?php include '../header.php'?>
    </div>
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
                    if( $idbill == 0 ){
                        echo '<div style="text-align: center; font-size: 20px;">Chưa có đơn hàng</div>';
                    } else {
                        while( $detailbill = mysqli_fetch_array($bill)){ 
                ?>
                        <div class="box-inf">
                            <div> <img src="../images/<?php echo $detailbill['hinhsp'] ?>" alt="" style="width:200px"></div>
                            <div class="infor-bill" style="width:350px;"> <?php echo $detailbill['tensp']?> </div> 
                            <div class="infor-bill"> <?php echo $detailbill['soluong']?> </div>
                            <div class="infor-bill"> <?php echo $detailbill['giasp']?> </div>
                            <div class="infor-bill"> <?php echo $detailbill['dongia']?> </div>
                        </div>
                        
                <?php
                        } 
                    }
                ?>

                
                    <?php 
                        if( $idbill == 0 ){

                        } else {
                            echo' <div style="text-align: center; margin-top: 24px;">Trạng thái: </div>';
                            if($tt['trangthai'] == 1)
                            { 
                                echo '<span style="color:green;">Đã gửi</span>';
                            } else {
                                echo '<span style="color:red;">Chưa gửi</span>';
                            }
                        }

                        unset($_SESSION['email'])
                    ?>
                
            </div>
        </div>
    </div>
    
</body>
</html>
