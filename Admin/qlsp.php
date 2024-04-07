<?php 
    session_start();
   
    include '../db/connect.php';
    include '../control/control.php';
    $con = new control();
    if( !isset($_SESSION['username'])){
        header('location: ../index.php');
    } else if( isset($_SESSION['username']) && isset($_SESSION['role'])){
        if( $_SESSION['role'] == 1){
            $pro_in_page = 10;
            $idsptemp = null;
            $allproducts = $con -> getProduct();
            $allproducts = $allproducts->num_rows;
            //$allproducts = 61/10 = 6.1

            $totalPages = ceil($allproducts / $pro_in_page);
            // $totalPages = 7
           
            // Nếu tồn tại biến $_GET['page'] thì gán giá trị bằng biến $page
            if(isset ($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $start = ($page - 1 ) * $pro_in_page;
            $sql1 = "SELECT * FROM sanpham LIMIT   $start, $pro_in_page";
            $result = mysqli_query($conn , $sql1 );

            // $totalproducts = $con -> getProduct();
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ SẢN PHẨM - SWEET DREAM</title>
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
                <li><a href="#">Danh sách sản phẩm</a></li>
                <li><a href="../admin.php">Quản lý</a></li>
            </ul>
            <div class="nav-right">
                <a href="../Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                <a class="log-in" href="../control/logout.php">Log out</a>
            </div>
        </div>
</header>
    <div id="content">
        <div class="content-section-product mr-56 ">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th></th>
                    <th>Giá</th>
                    <th></th>
                </tr>
                <div class="form-product-mgr">
                    <?php 
                        if( mysqli_num_rows($result) > 0 ){
                            while( $allproduct = mysqli_fetch_array($result)) {
                    ?>
                    <div class="product-mgr">
                        <tr>
                            <td class="inf"> <?php  $idsptemp=$allproduct['idsanpham'];  echo $allproduct['idsanpham'];?></td>
                            <td class="" style="width: 245px"> <img src="../images/<?php echo $allproduct['hinhanh']?>" class="product-img" style="width: 100%;"></img></td>
                            <td class="inf"> <?php echo $allproduct['tensanpham'];?></td>
                            <td  class="inf"> <?php echo $allproduct['gia'];?></td>
                            <td class="inf"> <button class="js-btn-delpr">Xóa sản phẩm</button> </td>
                            <td class="inf"> <a href="update-product.php?idsp=<?php echo $allproduct['idsanpham']; ?>">Sửa sản phẩm</a> </td>
                            <div class="js-modal">
                                <div class="js-modal_container text-cent">
                                    <div class="title-heading">
                                        <h2 > Xác nhận xóa sản phâm</h2>
                                    </div>
                                    <div class="choice">
                                        <div class="js-btn-cancel"> 
                                            <a href="">Hủy</a>
                                        </div>
                                        <div class="btn-confirm"> 
                                            <a class="" href="../control/deleteproduct.php?idsp=<?php echo $idsptemp;?>">Đồng ý</a>    
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </tr>
                    </div>  
                </div>
              
                <?php       
                        }
                    }
                ?>  
            </table>   
        </div>
        
    </div>

  <div class="phan-trang">
            <div class="inner-phan-trang">
                <?php 
                    for( $i = 1 ; $i <= $totalPages ; $i++ ){
                ?>
                        <a href="?page=<?php echo $i?>" <?php if($page == $i){echo "class='active'";} ?>><?php echo $i?></a>
                <?php
                    }
                ?>
            </div>
        </div>           


    <script>
        const delprBtns =document.querySelectorAll('.js-btn-delpr');
        const modalComfirm =document.querySelector('.js-modal');
        const modalContainer =document.querySelector('.js-modal_container')
        const modalClose =document.querySelector('.js-btn-cancel')
        function showBoxConfirm( ) {
            modalComfirm.classList.add('open')
        }

        function cancelDele(){
            modalComfirm.classList.remove('open')
        }

        function dungnoibot(){
            modalComfirm.stopPropagation()
        }
        for ( const delprBtn of delprBtns ){
            delprBtn.addEventListener('click',showBoxConfirm)
        }

        modalClose.addEventListener('click', cancelDele() )

        modalContainer.addEventListener('click', dungnoibot())
    </script>
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