<?php
    session_start();
    include '../control/control.php';

    $con = new control();
    
    $check = null;
    $billsucces = null;
    $billnotsuccess = null;
    if( !isset($_SESSION['username'])){
        header('location: ../index.php');
    } else if( isset($_SESSION['username']) && isset($_SESSION['role'])){
        if( $_SESSION['role'] == 1){
            
            if( isset($_GET['check'])){
                if(  $_GET['check'] == 1){
                    $check = 1; // xuất ra tất cả các đơn
                    $donhangs = $con -> getBill();
                } else if( $_GET['check'] == 2) {
                    $billsucces = $con -> getBillByStatus1();
                    $check = 2; // xuất ra đơn đã gửi 
                } else if( $_GET['check'] == 3 ){
                    $billnotsuccess = $con -> getBillByStatus2();
                    $check = 3; // xuất ra đơn chưa gửi 
                }
            } 
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Quản lý đơn hàng - SWEET DREAM</title>
            <link rel="stylesheet" href="../style/style.css">
            <link rel="stylesheet" href="../style/qlsp.css">
            <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
            

        </head>
        <body>
        <header>
                <div class="container-header">
                    <a href="../index.php"><img id="logo" src="../images/logo.png" alt="#"></a>
                    <ul id="nav-left">
                        <li><a href="../index.php">Trang chủ</a></li>
                        <li><a href="add-product.php">Thêm sản phẩm</a></li>
                        <li><a href="qlsp.php">Danh sách sản phẩm</a></li>
                        <li><a href="#">Quản lý đơn hàng</a></li>               
                    </ul>
                    <div class="nav-right">
                        <a href="../Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                        <a href="../control/logout.php"class="log-in" href="">Log out</a>
                    </div>
                </div>
        </header>
            <div id="content"> 
                <div class="content-section-product mr-56">
            
                <table>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>
                            <th>Tổng tiền</th> 
                            <th><a href="?check=1" style="position: relative;">
                                    Trạng thái
                                </a>
                                <ul class="subnav">
                                    <li><a href="?check=2">Đơn đã gửi</a></li>
                                    <li><a href="?check=3">Đơn chưa gửi</a></li>
                                </ul>
                            </th>
                        </tr>
                        
                        <?php 
                            if($check == 1){
                                    if( mysqli_num_rows($donhangs) > 0 ){
                                        while( $donhang = mysqli_fetch_array($donhangs)) {
                        ?> 
                                            <tr>
                                                <td>  <?php echo $donhang['idbill'];?>   </td>
                                                <td>  <?php echo $donhang['ten'];?>      </td>
                                                <td style="width: 300px">  <?php echo $donhang['diachi'];?>   </td>
                                                <td>  <?php echo $donhang['sdt'];?>      </td>
                                                <td>  <?php echo $donhang['tongtien'];?> </td>
                                                <td> 
                                                    <?php 
                                                        if($donhang['trangthai'] == 0){
                                                            echo '<div style="color: red;">Chưa gửi</div>';
                                                        } else {
                                                            echo '<div style="color: green;">Đã gửi</div>';
                                                        }
                                                    ?>
                                                </td>
                                                <td> <a href="detailbill.php?iddh=<?php echo $donhang['idbill'];?>">Chi tiết</a></td>
                                            </tr>                                            
                        <?php       
                                        }
                                    }
                                } else if( $check == 2 ){
                                    if(mysqli_num_rows($billsucces)){
                                        while( $bill = mysqli_fetch_array($billsucces)) {
                        ?>
                                            <tr>
                                                <td>  <?php echo $bill['idbill'];?>   </td>
                                                <td>  <?php echo $bill['ten'];?>      </td>
                                                <td   style="width: 300px">  <?php echo $bill['diachi'];?>   </td>
                                                <td>  <?php echo $bill['sdt'];?>      </td>
                                                <td>  <?php echo $bill['tongtien'];?> </td>
                                                <td> 
                                                    <?php 
                                                        if($bill['trangthai'] == 1){
                                                            echo '<div style="color: green;">Đã gửi</div>';
                                                        }
                                                    ?>
                                                </td>
                                                <td> <a href="detailbill.php?iddh=<?php echo $bill['idbill'];?>">Chi tiết</a></td>
                                            </tr>           
                        <?php
                                        }
                                    }
                                } else if($check == 3){
                                    if(mysqli_num_rows($billnotsuccess)){
                                        while( $bill1 = mysqli_fetch_array($billnotsuccess)) {
                        ?>
                                        <tr>
                                                <td>  <?php echo $bill1['idbill'];?>   </td>
                                                <td>  <?php echo $bill1['ten'];?>      </td>
                                                <td   style="width: 300px">  <?php echo $bill1['diachi'];?>   </td>
                                                <td>  <?php echo $bill1['sdt'];?>      </td>
                                                <td>  <?php echo $bill1['tongtien'];?> </td>
                                                <td> 
                                                    <?php 
                                                        if($bill1['trangthai'] == 0){
                                                            echo '<div style="color: red;">Chưa gửi</div>';
                                                        } else {
                                                            echo '<div style="color: green;">Đã gửi</div>';
                                                        }
                                                    ?>
                                                </td>
                                                <td> <a href="detailbill.php?iddh=<?php echo $bill1['idbill'];?>">Chi tiết</a></td>
                                            </tr>           
                        <?php
                                        }
                                    
                                }
                            }
                        ?>
                          
                        
                    </table>   
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