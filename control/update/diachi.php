<?php 
        if( isset($_POST['diachi'])){
            $newAddresss = $_POST['diachi'];
            $con -> updateAddress($idkh,$newAddresss);
            header('location: account.php');
        } 
    
?>

<div>
    <div class="form-section-update">
        <div class=""> 
            <h3>Địa chỉ hiện tại: <?php echo $account['diachi'] ?></h3>
        </div>
        <form action="" method="post">
            <div class="nhap">
                <input type="text" required name="diachi" placeholder="Địa chỉ" class="up-input">
            </div>
            <div class="btn-sbm">
                <button type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
