<?php 

    include '../db/connect.php';
    include '../db/connect_link.php';

    class control extends connect_link {
        function taoDonhang($ten,$diachi,$sdt,$email,$tongdonhang){
            $sql = "INSERT INTO bill(ten,diachi,sdt,email,tongtien) VALUES ('$ten','$diachi','$sdt','$email','$tongdonhang')";
            //  $this->link->query($sql);
            if(  $this->link->query($sql) === true) {
                $last_id = $this->link->insert_id;
            }
            return $last_id;
        }

        function taochitietDonhang( $idsanpham , $tensp, $giasp , $soluong , $hinhsp , $dongia , $idbill)  {
            $sql = "INSERT INTO detailbill( idsanpham ,tensp, giasp , soluong , hinhsp , dongia , idbill) VALUES ('$idsanpham','$tensp', '$giasp' , '$soluong' , '$hinhsp' , '$dongia' , '$idbill')";
            $this->link->query($sql); 
        }

        function addProduct($name_product,$price,$dess,$file_name,$id_cate,$id_brand){
            $sql = "INSERT INTO sanpham(tensanpham,gia,mota,hinhanh,iddanhmuc,idthuonghieu) VALUES (
                '$name_product','$price','$dess','$file_name','$id_cate','$id_brand')";
            $this->link->query($sql); 
        }

        function getproductID( $idcate ){
            $sql = "SELECT * FROM sanpham 
            WHERE iddanhmuc = '$idcate' ";
            return $this->link->query($sql); 
        }

        function getAccountbyUser($user_name){
            $sql = "SELECT * FROM khachhang WHERE email = '$user_name'";
            return $this->link->query($sql); 
        }
        
    
        
        function taoAccount($ten,$user_name,$password,$sdt,$diachi){
            $sql = "INSERT INTO khachhang(ten,email, password ,sdt, diachi ) VALUES ('$ten','$user_name','$password','$sdt','$diachi')";
            $this->link->query($sql); 
        }

        function getProduct(){
            $sql = "SELECT * FROM sanpham";
            return $this->link->query($sql); 
        }

        function getdetailBill( $idbill){
            $sql = "SELECT * FROM detailbill WHERE idbill = $idbill";
            return $this->link->query($sql); 

        }

        function getBill(){
            $sql = "SELECT * FROM bill";
            return $this->link->query($sql); 
        }
        function getBillbyID($idbill){
            $sql = "SELECT * FROM bill WHERE idbill = $idbill";
            return $this->link->query($sql); 
        }

        function updateIDBill($idbill,$email){
            $sql = "UPDATE khachhang SET idbill = $idbill WHERE email = '$email'";
            $this->link->query($sql); 
        }

        function getProductByID( $idsp ){
            $sql = "SELECT * FROM sanpham WHERE idsanpham = $idsp";
            return $this->link->query($sql); 
        }

        function getCategory(){
            $sql = "SELECT * FROM danhmuc";
            return $this->link->query($sql); 
        }


        function getBrand(){
            $sql = "SELECT * FROM thuonghieu";
            return $this->link->query($sql); 
        }

        function getCategoryOfProduct($iddm){
            $sql = "SELECT * FROM danhmuc WHERE iddanhmuc = $iddm";
            return $this->link->query($sql); 
        }

        function getBrandOfProduct($idth){
            $sql = "SELECT * FROM thuonghieu WHERE idthuonghieu = $idth";
            return $this->link->query($sql); 
        }

        function updateProduct($idsp,$tensp,$giasp,$id_cate,$id_brand,$mota,$hinhanh){
            $sql = "UPDATE sanpham SET tensanpham='$tensp', gia='$giasp',
            mota='$mota',hinhanh='$hinhanh',iddanhmuc='$id_cate',
            idthuonghieu='$id_brand' WHERE idsanpham = $idsp";
            $this->link->query($sql); 
        }
        function updateProductNoImg($idsp,$tensp,$giasp,$id_cate,$id_brand,$mota){
            $sql = "UPDATE sanpham SET tensanpham='$tensp', gia='$giasp',
            mota='$mota',iddanhmuc='$id_cate',
            idthuonghieu='$id_brand' WHERE idsanpham = $idsp";
            $this->link->query($sql); 
        }

        function getStatusBill($idbill){
            $sql = "SELECT trangthai FROM bill WHERE idbill = $idbill";
            return $this->link->query($sql); 
        }

        function SuccessBill($idbill,$statusbill){
            $sql = "UPDATE bill SET trangthai = '$statusbill' WHERE idbill = $idbill";
            $this->link->query($sql); 
        }


        // Begin Danh sách hàm cập nhật account
        function updateFullname($id,$new1){
            $sql = "UPDATE khachhang SET Ten = '$new1' WHERE idkhachhang = $id";
            $this->link->query($sql); 
        }

        function updateSDT($id,$new2){
            $sql = "UPDATE khachhang SET sdt = $new2 WHERE idkhachhang = $id";
            $this->link->query($sql); 
        }

        function updateAddress($id,$new3){
            $sql = "UPDATE khachhang SET diachi = '$new3'  WHERE idkhachhang = $id";
            $this->link->query($sql); 
        }

        function updatePassword($id,$new4){
            $sql = "UPDATE khachhang SET password = '$new4'  WHERE idkhachhang = $id";
            $this->link->query($sql); 
        }
        // Ends
        
        function getProductbyHot($hot){
            $sql = "SELECT * FROM sanpham WHERE hot >= 200";
            return $this->link->query($sql); 
        }

        function updateHotProduct($idsp,$newhot){
            $sql = "UPDATE sanpham SET hot = $newhot WHERE idsanpham = $idsp";
            $this->link->query($sql); 
        }

        function getBillByStatus1(){
            $sql = "SELECT * FROM bill WHERE trangthai = 1";
            return $this->link->query($sql); 
        }
        
        function getBillByStatus2(){
            $sql = "SELECT * FROM bill WHERE trangthai = 0";
            return $this->link->query($sql); 
        }

        function setAccountnotLogin($hoten,$diachi,$sdt,$email,$pass,$idbill) {
            $sql = "INSERT INTO khachhangngoai(hoten,email,pass,sdt,diachi,idbill) VALUES ('$hoten','$email','$pass','$sdt','$diachi',$idbill)";
            $this->link->query($sql); 
        }

        function getAccountnotLogin($email){
            $sql = "SELECT * FROM khachhangngoai WHERE email = '$email'";
            return $this->link->query($sql); 
        }
    }
    
    

    
    
    function showGiohang() {
        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
            $tong = 0;
            for( $i = 0; $i < sizeof($_SESSION['giohang']) ; $i++ ){
                $tongtien = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][1];
                $tong += $tongtien;
                echo '
                <style> 
                    .cart-detail {
                        display: flex;
                        flex-direction: row;
                    }
                    .tong {
                        style="width: 51px; height: 25px; background-color: #fefcfd; box-shadow: 1px 1px;"
                    }
                    .pd-24 {
                        padding: 8px 16px; 
                    }
                </style>
                    <div class="cart-detail">
                        <div> <img src="../images/'.$_SESSION['giohang'][$i][3].' " alt="" style="width: 100px; text-align: center;"></div>
                        <div style="width: 257px; display:block; text-align: center;"> '.$_SESSION['giohang'][$i][0].' </div>
                        <div style="width: 287px; text-align: center;"> 
                            '.$_SESSION['giohang'][$i][2].' 
                            <div> <a href="cart.php?delproduct='.$i.'&idpr='.$_SESSION['giohang'][$i][4].'">Xóa sản phẩm</a></div>
                        </div>
                        <div style="width: 87px; text-align: center;"> '.$_SESSION['giohang'][$i][1].' </div>
                        <div style="width: 292px; text-align: center;"> '.$tongtien.' </div>
                    </div>
                    
                ';
            }
            echo '
                <div class="tong"> 
                    <div class="pd-24"> Tổng: </div>
                    <div class="pd-24"> '.$tong.'</div>
                </div>
            ';
        }
        
        
    }
    function tonggiatridonhang() {
        $tongdonhang = 0;

        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
            for( $i = 0; $i < sizeof($_SESSION['giohang']) ; $i++ ){
                $tongtien = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][1];
                $tongdonhang += $tongtien;
            }
        }
        return $tongdonhang;
    }

    function showdonhang() {
        $tongdonhang = tonggiatridonhang();

        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
            if( sizeof($_SESSION['giohang']) == 0 ){
                echo 'Giỏ hàng rỗng. <a href ="product.php"> Tiếp tục mua sắm </a>';
            } else {
                for( $i = 0; $i < sizeof($_SESSION['giohang']) ; $i++ ) {
                    echo '
                    <style> 
                        .cart-detail {
                            display: flex;
                            flex-direction: row;
                            justify-content: center;
                            margin-top: 24px;
                            
                        }
                        .tong {
                            style="width: 51px; height: 25px; background-color: #fefcfd; box-shadow: 1px 1px;"
                        }
                        .pd-24 {
                            padding: 8px 16px; 
                        }
                    </style>
                        <div style="text-align: center;">
                            <div class="cart-detail">
                                <div> <img src="../images/'.$_SESSION['giohang'][$i][3].' " alt="" style="width: 100px; text-align: center;"></div>
                                <div style="width: 257px; display:block; text-align: center;"> '.$_SESSION['giohang'][$i][0].' </div>
                                <div style="width: 287px; text-align: center;"> 
                                    '.$_SESSION['giohang'][$i][2].' 
                                </div>
                                <div style="width: 87px; text-align: center;"> '.$_SESSION['giohang'][$i][1].' </div>
                            </div>
                        </div>
                    ';
                }
                echo '
                    <div class="tong">
                        <div class ="pd-24">Tổng cộng:</div>
                        <div class ="pd-24">'.$tongdonhang.'</div>
                    </div>
                ';

                
            }
        }
    }

    
    function deleteProduct( $idsp ){
        include '../db/connect.php';
        $sql = "DELETE FROM sanpham WHERE idsanpham = '$idsp'";
        mysqli_query($conn , $sql );
        header('location: ../Admin/qlsp.php');
    } 
?>