<?php 
    
    include '../db/connect.php';
    include '../control/control.php';
    $con = new control();
    $sql1 = "SELECT * FROM danhmuc";
    $category1 = mysqli_query($conn, $sql1);
    $product_cate = 0;
    $idtemp = null;
    // $product_cate = $con -> getproductID( $idtemp );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    
</head>
<body>
<div id="head">
            <?php include '../header.php'?>
        </div>
<div id="content">
    <div class="content-section-product">
        <div class="layout-category">
            <h3 class="heading-category"><i class="ti-menu"></i> Danh mục</h3>
            <div class="list-category">
                <?php 
                    if( mysqli_num_rows($category1) > 0){
                        foreach( $category1 as $key => $value){
                ?>
                        <div class="category">
                            <li><a href="detail-category.php?idcate=<?php echo $value['iddanhmuc']?>"><?php echo $value['tendanhmuc'] ?></a></li>
                        </div>
                <?php     
                        }
                    }
                    ?>
            </div>
            
        </div>
        <div class="layout-product">
            <?php 
                    include '../control/getdetail-category.php';
                    // unset($_GET['idcate']);
            ?>
        </div>
    </div>    
</div>
</body>
</html>