<?php 
    
      if( isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $dtaccount = $con -> getAccountbyUser($username);
        $account = mysqli_fetch_assoc($dtaccount);
        $idkh = $account['idkhachhang'];
        if( isset($_POST['fullname'])){
            $newFullname = $_POST['fullname'];
            $con -> updateFullname($idkh,$newFullname);
            header('location: account.php');
        } 
    }
    

    
?>
    <div class="form-section-update">
        <div> 
            <h3>Tên hiện tại: <?php echo $account['Ten'] ?></h3>
        </div>
        <form action="" method="post">
            <div class="form-in">
                <div class="nhap">
                    <input type="text" required name="fullname" placeholder="Họ và Tên" class="up-input">
                </div>
            </div>
            
            <div class="btn-sbm">
                <button type="submit">Cập nhật</button >
            </div>
        </form>
    </div>
<?php 
    
?>
