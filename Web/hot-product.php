<?php 
    session_start();
    include '../db/connect.php';
    include '../control/control.php';
    $con = new control();
    $hot = 200;
    $pro_in_page = 6;
    // Nếu tồn tại biến $_GET['page'] thì gán giá trị bằng biến $page
    if(isset ($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start = ($page - 1 ) * $pro_in_page;
    $sql = "SELECT * FROM sanpham WHERE hot >= $hot LIMIT   $start, $pro_in_page";
    $result = mysqli_query($conn , $sql );
    
    $allproducts = $con -> getProductbyHot($hot);
    $allproducts = $allproducts->num_rows;
    $totalPages = ceil($allproducts / $pro_in_page); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NỔI BẬT - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    
</head>
<body>
<div id="head">
            <?php include '../header.php'?>
        </div>
<div id="content">
    <div class="content-section-product">
      
        <div class="layout-product layout-product-hotpage">
                <div class="hot-heading">
                    <h1>SẢN PHẨM NỔI BẬT</h1>
                </div>
                <?php 
                    if( mysqli_num_rows($result) > 0 ){
                        while( $row = mysqli_fetch_array($result)) {
                            if($row['hot'] >= 200 ){
                ?>
                            <div class="row product-list ">
                                <div class="col mt-16 product-inf">
                                    <img style="width:354px" src="../images/<?php echo $row['hinhanh']?>" class="product-img"></img>
                                    <div class="product-body" style="width:354px">
                                        <a href="detail-product.php?idsanpham=<?php echo $row['idsanpham'] ?>"><p class="name-product"><?php echo $row['tensanpham'] ?> </p></a>
                                        <a href="detail-product.php?idsanpham=<?php echo $row['idsanpham'] ?>"><p class="price-product mt-16"><?php echo $row['gia'] ?>  ₫ <span class="product-hot">HOT</span></p> </a>
                                    </div>
                                </div>   
                            </div>            
                <?php       
                            }
                        }
                    }
                ?>
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
</div>
</body>
</html>