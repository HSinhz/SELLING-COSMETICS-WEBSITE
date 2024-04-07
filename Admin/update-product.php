<?php 
    session_start();
    include '../control/control.php';
    $con = new control();
    if( !isset($_SESSION['username'])){
        header('location: ../index.php');
    } else if( isset($_SESSION['username']) && isset($_SESSION['role'])){
        if( $_SESSION['role'] == 1){
            if( isset($_GET['idsp'])){
                $idsp = $_GET['idsp'];
            } else {
                header('location: qlsp.php');
            }
    // Lây dữ liệu từ database sản phẩm có id cụ thể
    
    $prd = $con -> getProductByID( $idsp);
    $infprd = mysqli_fetch_array($prd);

    // Lấy tên danh mục của sản phẩm
    $idcategory = $infprd['iddanhmuc'];
    $result1 = $con -> getCategoryOfProduct($idcategory);
    $tendanhmuc = mysqli_fetch_array($result1);

    // Lấy tên thương hiệu của sản phẩm
    $idbrand = $infprd['idthuonghieu'];
    $result2 = $con -> getBrandOfProduct($idbrand);
    $tenthuonghieu = mysqli_fetch_array($result2);
    // Lấy tất cả dữ liệu từ danh mục
    $category = $con -> getCategory();

    //Lấy tất cả dư liệu từ thương hiệu
    $brand = $con -> getBrand();


    // Thao tác với form 
    if( isset($_POST['update']) ){
        $tensp = $_POST['name_product'];
        $giasp = $_POST['price'];
        $id_cate = $_POST['id_cate'];
        $id_brand = $_POST['id_brand'];
        $mota = $_POST['dess'];

        $hinhanh = $_FILES['img']['name'];
        $hinhanh_tmp = $_FILES['img']['tmp_name'];
        move_uploaded_file($hinhanh_tmp , '../images/'.$hinhanh );

        $con -> updateProduct($idsp,$tensp,$giasp,$id_cate,$id_brand,$mota,$hinhanh);

        header('location: qlsp.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm - SWEET DREAM</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    

</head>
<body>
    
</body>
</html>
<header>
        <div class="container-header">
            <a href="../index.php"><img id="logo" src="../images/logo.png" alt="#"></a>
            <ul id="nav-left">
                <li><a href="../index.php">Trang chủ</a></li>
                <li><a href="add-product.php">Thêm sản phẩm</a></li>
                <li><a href="qlsp.php">Danh sách sản phẩm</a></li>
                <li><a href="../admin.php">Quản lý</a></li>
            </ul>
            <div class="nav-right">
            <div class="nav-right">
                <a href="../Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                <a class="log-in" href="../control/logout.php">Log out</a>
            </div>
        </div>
</header>

    <div id="content">
        <div class="content-section width-800">
            <div class="form-login">
                <h1>Cập nhật sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-input">
                        <input type="text"  name="name_product" placeholder="<?php echo $infprd['tensanpham'] ?>" value="<?php echo $infprd['tensanpham'] ?>" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <select name="id_cate"  id="" class="form-input width-100per">
                            <option value=""><?php echo $tendanhmuc['tendanhmuc'] ?></option>
                            <?php foreach($category as $key => $value) { ?>
                                <option value="<?php echo $value['iddanhmuc']?>"> <?php echo $value['tendanhmuc']?> </option>
                            <?php  } ?>
                            
                        </select>
                    </div>
                    <div class="box-input">
                        <select name="id_brand"  id="" class="form-input width-100per">
                            <option value=""> <?php echo $tenthuonghieu['tenthuonghieu']?></option>
                            <?php foreach($brand as $key => $value) { ?>
                                <option value="<?php echo $value['idthuonghieu']?>"> <?php echo $value['tenthuonghieu']?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="box-input">
                        <input type="text"  name="price" placeholder="" value="<?php echo $infprd['gia'] ?>" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <img src="../images/<?php echo $infprd['hinhanh'] ?>" alt="" style="width: 150px; height: 150px;">
                        <input type="file"  name="img" placeholder="Hình ảnh" value="<?php echo $infprd['hinhanh'] ?>" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <textarea name="dess" rows="4" class="form-input width-100per"><?php echo $infprd['mota'] ?></textarea>
                    </div>  
                    <div class="box-input">
                        <button type="submit" class="btn-submit" style="font-size: 18px" name="update">Cập nhật</button>
                    </div>
                </form>
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