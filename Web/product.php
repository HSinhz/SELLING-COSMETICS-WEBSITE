`<?php 
    session_start();
    include '../db/connect.php';
    include '../control/control.php';
    $con = new control();
    $pro_in_page = 9;
    $allproducts = $con -> getProduct();
    $allproducts = $allproducts->num_rows;
    // $allproduct = 53
    $totalPages = ceil($allproducts / $pro_in_page);
    // 53 / 9 = 5.1323 $totalPage = 6
    // Nếu tồn tại biến $_GET['page'] thì gán giá trị bằng biến $page
    if(isset ($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start = ($page - 1 ) * $pro_in_page;
    // ( 2 -1)*9 =9
    $sql = "SELECT * FROM sanpham LIMIT   $start, $pro_in_page ";
    $result = mysqli_query($conn , $sql );

    

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
    <link rel="stylesheet" href="../images/icons/themify-icons/themify-icons.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11480297165"></script> 
    <script> 
        window.dataLayer = window.dataLayer || []; 
        function gtag(){
            dataLayer.push(arguments);
        } 
        gtag('js', new Date()); 
        gtag('config', 'AW-11480297165'); 
    </script>
    <!-- Event snippet for Lượt mua hàng conversion page --> 
    <script> 
        gtag('event', 'conversion', { 'send_to': 'AW-11480297165/D79gCObU_ooZEM3dneIq', 'transaction_id': '' }); 
    </script>
    <script 
        async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js">
    </script>
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
                if( mysqli_num_rows($result) > 0 ){
                    while( $row = mysqli_fetch_array($result)) {
            ?>
                        <div class="row product-list">
                            <div class="col mt-16 product-inf">
                                <img src="../images/<?php echo $row['hinhanh']?>" class="product-img"></img>
                                <div class="product-body">
                                    <a href="detail-product.php?idsanpham=<?php echo $row['idsanpham'] ?>"><p class="name-product"><?php echo $row['tensanpham'] ?> </p></a>
                                    <a href="detail-product.php?idsanpham=<?php echo $row['idsanpham'] ?>"><p class="price-product mt-16"><?php echo $row['gia'] ?> ₫</p> </a>
                                </div>
                            </div>   
                         </div>            
            <?php       
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

<!-- Google tag (gtag.js) --> 
<amp-analytics type="gtag" data-credentials="include"> 
    <script 
        type="application/json"> { "vars": { 
            "gtag_id": "AW-11480297165", 
            "config": { "AW-11480297165": { "groups": "default" } } 
        },  "triggers": {"C_30A1wJlazIQ": { "on": "visible", "vars": { "event_name": "conversion", "transaction_id": "", "send_to": ["AW-11480297165/D79gCObU_ooZEM3dneIq"] } } } } 
    </script> 
</amp-analytics>

</body>
</html>