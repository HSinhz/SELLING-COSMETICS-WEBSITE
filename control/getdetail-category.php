<?php 
    session_start();
    
    if( isset($_GET['idcate'])){
        $idtemp = $_GET['idcate'];
        $product_cate = $con -> getproductID( $idtemp );
        
        while ( $product = mysqli_fetch_array($product_cate)) {
            echo '   
                <div class="row product-list">
                    <div class="col mt-16 product-inf">
                        <img src="../images/'.$product['hinhanh'].' " class="product-img"></img>
                        <div class="product-body">
                            <a href="detail-product.php?idsanpham='.$product['idsanpham'].'"><p class="name-product">'.$product['tensanpham'].'</p></a>
                            <a href="detail-product.php?idsanpham='.$product['idsanpham'].'"><p class="price-product mt-16">'.$product['gia'].'</p></a>
                        </div>
                    </div>   
                </div>';            
        }

    }

   
    
    
?>