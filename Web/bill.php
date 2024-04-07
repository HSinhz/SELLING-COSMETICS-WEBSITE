<?php 
    session_start();
    include '../db/connect.php';
    include '../control/control.php';
    if( !isset($_SESSION['username']) && !isset($_SESSION['giohang']) ){
        header('location: ../index.php');
    } else {
        $con = new control();
        $ttdh = null;   
        if(isset($_POST['xacnhan']) && ($_POST['xacnhan'])){
            if( isset($_POST['pass'])){
                $hoten = $_POST['ten'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $tongdonhang = tonggiatridonhang() ;
            } else {
                $idkh = $_POST['idkh'];
                $hoten = $_POST['ten'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                $tongdonhang = tonggiatridonhang() ;
            }
            // insert đơn hàng vào dtb;s
            $idbill = $con -> taoDonhang($hoten,$diachi,$sdt,$email,$tongdonhang); 
            if( isset($_SESSION['username'])){
                $email = $_SESSION['username'];
                $account = $con -> getAccountbyUser($email);
                $iduser = mysqli_fetch_array($account);
                $con -> updateIDBill($idbill,$email);
            }
            
            //lấy thông tin giỏ hàng từ session + id đơn hàng vừa tạo
            //insert vào bảng chi tiet don hang 
            for( $i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                $idsanpham = $_SESSION['giohang'][$i][4];
                $tensp = $_SESSION['giohang'][$i][0];
                $giasp = $_SESSION['giohang'][$i][1];
                $soluong = $_SESSION['giohang'][$i][2];
                $hinhsp = $_SESSION['giohang'][$i][3];
                $dongia = $giasp * $soluong;
                $con -> taochitietDonhang($idsanpham , $tensp, $giasp , $soluong , $hinhsp , $dongia , $idbill);
            }

            

            // show đơn hàng 
            $ttdh = '
                <div> <h1> Mã đơn hàng: '.$idbill.' </h1></div>
                <div> <h2 style="margin-top:8px"> Thông tin đơn hàng của bạn</h2> </div>
                <div style="font-size: 18px;"> 
                    <div style="margin-top:8px">Người nhận: '.$hoten.' </div>
                    <div style="margin-top:8px">Địa chỉ nhận: '.$diachi.' </div>
                    <div style="margin-top:8px">Số điện thoại: '.$sdt.' </div>
                </div>
            ';
            if( !isset($_SESSION['username'])){
                $con -> setAccountnotLogin($hoten,$diachi,$sdt,$email,$pass,$idbill);
            }
            // Tạo tài khoản cho khách hàng không đăng nhập để xem đơn hàng đã đặt


            // Cộng sản phậm nổi bật
            for( $i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                    $idsanpham = $_SESSION['giohang'][$i][4];
                    $soluong = $_SESSION['giohang'][$i][2];
                    $hot = $con ->getProductByID($idsanpham);
                    $hot_pro = mysqli_fetch_array($hot); 
                    $newhot = $hot_pro['hot'] + $soluong;
                    $con -> updateHotProduct($idsanpham,$newhot);
            }
        
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
        <link rel="stylesheet" href="../style/detail-product.css">
        

    </head>
    <body>
    <div id="head">
            <?php include '../header.php'?>
        </div>
        <div id="content">
            <div class="odersuccess">
                <?php  echo $ttdh;
                    showdonhang();
                    //unset giỏ hàng
                    $_SESSION['sizecart'] = 0;
                    unset($_SESSION['giohang']);
                ?>
            </div>
        </div>

    </body>
    </html>

<?php 
}
?>