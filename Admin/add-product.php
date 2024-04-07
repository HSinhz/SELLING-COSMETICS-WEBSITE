<?php
    session_start();
    include '../db/connect.php';
    include '../control/control.php';
    $con = new control();
    if( isset($_SESSION['username']) == false ){
        header('location: ../include/login.php');
    } else {
        if( isset( $_SESSION['role']) == true ) {
            $role = $_SESSION['role'];
            if( $role == 0 ){
                echo "Bạn không đủ quyền truy cập" . '<a href="../index.php">Bấm vào đây để vào trang chủ</a>';
                exit();
            }   
        }
    }
    // kết nối với danh mục và thương hiếu
    $category = $con -> getCategory();
    $brand = $con -> getBrand();
    
    if( isset($_POST['name_product'])){
        $name_product = $_POST['name_product'];
        $id_cate = $_POST['id_cate'];
        $id_brand = $_POST['id_brand'];
        $price = $_POST['price'];
        $dess = $_POST['dess'];
        
        if(isset($_FILES['img'])) {
            $file = $_FILES['img'];
            $file_name = $file['name'];   
            move_uploaded_file($file['tmp_name'] , '../images/'.$file_name);
            // echo $file['tmp_name'];
        }

        $sql_is_prdu = "INSERT INTO sanpham(tensanpham,gia,mota,hinhanh,iddanhmuc,idthuonghieu) VALUES (
            '$name_product','$price','$dess','$file_name','$id_cate','$id_brand')";
        $querry = mysqli_query($conn , $sql_is_prdu);
            
        if( isset($querry) == true ) {
            header('location: qlsp.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - SWEET DREAM</title>
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
                <li><a href="#">Thêm sản phẩm</a></li>
                <li><a href="qlsp.php">Danh sách sản phẩm</a></li>
                <li><a href="../admin.php">Quản lý</a></li>
            </ul>
            <div class="nav-right">
                <a href="../Web/account.php" class="name-account"><?php echo $_SESSION['Ten']?></a>
                <a class="log-in" href="../control/logout.php">Log out</a>
            </div>
        </div>
</header>

    <div id="content">
        <div class="content-section width-800">
            <div class="form-login">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-input">
                        <input type="text" required name="name_product" placeholder="Tên sản phẩm" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <select name="id_cate" required id="" class="form-input width-100per">
                            <option value="">Tên danh mục</option>
                            <?php foreach($category as $key => $value) { ?>
                                <option value="<?php echo $value['iddanhmuc']?>"> <?php echo $value['tendanhmuc']?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="box-input">
                        <select name="id_brand" required id="" class="form-input width-100per">
                            <option value="">Tên thương hiệu</option>
                            <?php foreach($brand as $key => $value) { ?>
                                <option value="<?php echo $value['idthuonghieu']?>"> <?php echo $value['tenthuonghieu']?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="box-input">
                        <input type="text" required name="price" placeholder="Giá sản phẩm" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <input type="file" required name="img" placeholder="Hình ảnh" class="form-input width-100per">
                    </div>
                    <div class="box-input">
                        <textarea name="dess" rows="4" class="form-input width-100per"></textarea>
                    </div>  
                    <div class="box-input">
                        <button type="submit" class="btn-submit" style="font-size: 18px">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>       
        </div>
    </div>


</body>
</html>