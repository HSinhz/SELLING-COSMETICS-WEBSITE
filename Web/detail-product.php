<?php 

    include '../db/connect.php';
    include '../control/getdetail-category.php';
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM sanpham WHERE idsanpham = $id";
    $result = mysqli_query($conn , $sql);
    $product = mysqli_fetch_assoc($result);

    $sql1 = "SELECT * FROM danhmuc";
    $category1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/detail-product.css">
    

</head>
<body>
<div id="head">
            <?php include '../header.php'?>
        </div>

    <div id="content">
        <div class="content-section-detail">
            <div class="layout-category">
                <h3 class="heading-category"><i class="ti-menu"></i> Danh mục</h3>
                <div class="list-category">
                    <?php 
                        if( mysqli_num_rows($category1) > 0){
                            foreach( $category1 as $key => $value){
                    ?>
                            <div class="category">
                                <li><a href=""><?php echo $value['tendanhmuc'] ?></a></li>
                            </div>
                    <?php     
                            }
                        }
                        ?>
                </div>
                
            </div>
            
            <div class="img-product pad-24">
                <img src="../images/<?php echo $product['hinhanh'] ?>" alt="" class="img">
            </div>
            <div class="detail-product mt-16">
                <div class="body-product pad-24">
                    <h1> <?php echo $product['tensanpham'] ?></h1>
                    <p class="pad-16" style="font-size: 28px; font-family: serif; color: red;"><?php echo $product['gia'] ?> ₫</p>
                    <p class="pad-16"><?php echo $product['mota'] ?></p>
                    <div class="buy-form">
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="idsp" value="<?php echo $product['idsanpham'] ?>">
                            <input type="hidden" name="tensp" value="<?php echo $product['tensanpham'] ?>">
                            <input type="hidden" name="giasp" value="<?php echo $product['gia'] ?>">
                            <input type="hidden" name="hinhanh" value="<?php echo $product['hinhanh'] ?>">
                            <div class="quanti-pro">
                                <input type="number" name="soluong" min="1" max="20" value="1">
                            </div>
                            <div class="btn-click">
                                <input type="submit" name="muangay" class="btn-buy mt-16" value="Mua ngay">
                                <!-- <input type="submit" name="add-cart" class="btn-buy mt-16" value="Thêm vào giỏ hàng" style="width: 180px;"> -->
                            </div>
                        </form>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</body>
</html>