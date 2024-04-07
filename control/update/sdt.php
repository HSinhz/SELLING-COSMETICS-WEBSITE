<?php 
        if( isset($_POST['sdt'])){
            $newSDT = $_POST['sdt'];
            $con -> updateSDT($idkh,$newSDT);
            header('location: account.php');
        } 
    
?>


<div class="form-section-update">
    <div > 
        <h3>Số điện thoại hiện tại: <?php echo $account['sdt'] ?></h3>
    </div>
    <div >
        <form action="" method="post">
            <div class="nhap">
                <input type="text" required name="sdt" placeholder="Số điện thoại" class="up-input">
            </div>
            
            <div class="btn-sbm">
                <button type="submit">Cập nhật</button>
            </div>
            
        </form>
    </div>
</div>




