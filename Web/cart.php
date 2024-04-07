<?php 
    session_start(); 
    include '../db/connect.php';
    include '../control/control.php';
    // $sizeCart = null;
    if(!isset($_SESSION['giohang'])){
        $_SESSION['giohang'] = []; 
    }

    if(!isset($_SESSION['sizecart'])){
        $_SESSION['sizecart'] = 0;
    }

    // Xóa tất cả trong giỏ hàng 
    if( isset($_GET['deletecart']) && ($_GET['deletecart'] == 1)){
        unset( $_SESSION['giohang']);
        $_SESSION['sizecart'] = 0;
    }

    // Xóa sản phẩm trong giỏ hàng
    if( isset($_GET['delproduct'])  && ($_GET['delproduct']>= 0)){
        for( $i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++ ){
            if( $_SESSION['giohang'][$i][4] == $_GET['idpr'] ){
                $_SESSION['sizecart'] = $_SESSION['sizecart'] - $_SESSION['giohang'][$i][2];
                break;
            }
        }
        array_splice($_SESSION['giohang'],$_GET['delproduct'],1);
        
    }

    if( isset($_POST['muangay']) && $_POST['muangay']) {
        $tensp = $_POST['tensp'];
        $giasp = $_POST['giasp'];
        $soluong = $_POST['soluong'];
        $hinhanh = $_POST['hinhanh'];
        $idsanpham = $_POST['idsp'];
        // kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
        $danhdau = 0; 
        for( $i = 0 ; $i < sizeof($_SESSION['giohang']); $i++) {
            if( $_SESSION['giohang'][$i][0] == $tensp ){
                $danhdau = 1;
                $soluongthem = $soluong + $_SESSION['giohang'][$i][2];
                $_SESSION['sizecart'] += $soluong;
                $_SESSION['giohang'][$i][2] = $soluongthem ;
                break;
            }
        }

        if( $danhdau == 0){
            //Thêm sản phẩm vào giỏ hàng
            $sp = [$tensp,$giasp,$soluong,$hinhanh,$idsanpham];
            $_SESSION['giohang'][] = $sp;
            $_SESSION['sizecart'] += $sp[2];
        }  
    }    

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/cart.css">
    

</head>
<body>
<div id="head">
            <?php include '../header.php'?>
        </div>
    <div id="content">
        <?php 
            if(!isset($_SESSION['giohang'])  || sizeof($_SESSION['giohang']) == 0 ){
                echo '
                    <div style="text-align: center;margin-top:40px;">
                        <div>GIỎ HÀNG TRỐNG</div>
                        <div> <a href="product.php">Tiếp tục mua sắm </a> </div>
                    </div>
                ';
            } else {
        ?>
            <div class="content-section-cart">
                <form action="cornfirm.php" method="post">
                    <div class="cart mt-48">
                        <h2 style="font-size: 32px;">GIỎ HÀNG</h2>
                        <div class="cart-thead">
                            <div>SẢN PHẨM</div>
                            <div style="width: 0px;"></div>
                            <div>SỐ LƯỢNG</div>
                            <div>GIÁ</div>
                            <div>THÀNH TIỀN</div>
                        </div>
                        <div>
                            <?php showGiohang(); ?>
                        </div>
                    </div>
                    <div class="delete-cart">
                        <input type="submit" value="Đồng ý đặt hàng" name="dongydathang" style="
                        width: 132px;
                        height: 28px;
                        font-family: inherit;
                        font-size: inherit;
                        background-color: #fefcfd;
                        box-shadow: 1px 1px;">

                    </div>
                </form>
                <div class="delete-cart">
                    <a href="cart.php?deletecart=1" style="width: 51px; height: 25px; background-color: #fefcfd; box-shadow: 1px 1px;"><button>XÓA</button></a>
                    <a href="product.php" style="width: 51px; height: 25px; background-color: #fefcfd; box-shadow: 1px 1px;"><button>Tiếp tục mua sắm</button></a>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
    
</body>
</html>