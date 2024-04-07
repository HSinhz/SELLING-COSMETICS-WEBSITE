<?php 
        $check = 0;
        $check1 = 0; 
        $check2 = 0;
        if( isset($_POST['oldpass'])){
            $password = $account['password'];
            $oldpass = $_POST['oldpass'];
            if( $password == $oldpass){
                $newpass = $_POST['newpass'];
                $cornfirm = $_POST['cornfirmnewpass'];
                if( strlen($newpass) >= 8 ){
                    if($newpass == $cornfirm ){
                        $con -> updatePassword($idkh,$newpass);
                        header('location: account.php');
                    } else {
                        $check2 = 1;
                    }
                } else {
                    $check1 = 1;
                }
                
            } else {
                $check = 1;
            }
            
        } 
    
?>


<div class="form-section-update">
    <div class="form-update-container">
        <div class="head-update"> 
            <h3>Đổi mật khẩu</h3>
        </div>
        <div class="main-form">
            <form action="" method="post">
                <div class="form-in">
                    <div class="nhap">
                        <input type="password" required name="oldpass" placeholder="Mật khẩu hiện tại" class="up-input">
                    </div>
                    <div class="error">
                        <?php 
                            if( $check == 1){
                                echo 'Mật khẩu không chính xác';
                            }
                        ?>
                    </div>              
                </div>
                
                <div class="form-in">
                    <div class="nhap">
                        <input type="password" required name="newpass" placeholder="Mật khẩu mới" class="up-input">
                    </div>
                    
                    <div class="error">
                        <?php 
                            if($check1 == 1){ 
                                echo 'Mật khẩu phải dài hơn kí tự';
                            }
                        ?>
                    </div>
                </div>
                <div class="form-in">
                    <div class="nhap">
                        <input type="password" required name="cornfirmnewpass" placeholder="Xác nhận mật khẩu mới" class="up-input">
                    </div>  
                    <div class="error">
                        <?php 
                            if( $check2 == 1){
                                echo 'Mật khẩu không trùng khớp';
                            }
                        ?>
                    </div>
                </div>
                <div class="btn-sbm">
                    <button type="submit">Cập nhật</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
