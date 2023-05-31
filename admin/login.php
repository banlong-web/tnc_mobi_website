<?php
include("../inc/config.php");
include("../inc/funtions.php");
include("../inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = "";

if(isset($_POST['login'])) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $email =  strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        $statement = $pdo->prepare("SELECT * FROM tbl_users WHERE `email`=? AND `status`=?");
        $statement->execute([$email, 'Active']);
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($total == 0) {
            $error_message .= "Username doesn't match";
        } else {
            foreach ($result as $row) {
                $rowPass = $row['password'];
            }
            if($rowPass != md5($password)) {
                $error_message .= "Password doesn't match";
            } else {
                $_SESSION['admin'] = $row;
                header("location: index.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Đăng Nhập Trang Chủ'; ?></title>
    <link rel="stylesheet" href="../admin/assets/css/semantic.min.css">
    <link rel="stylesheet" href="../admin/assets/css/container.min.css">
    <link rel="stylesheet" href="../admin/assets/css/form.min.css">
    <link rel="stylesheet" href="../admin/assets/css/input.min.css">
    <link rel="stylesheet" href="../admin/assets/css/grid.min.css">
    <link rel="stylesheet" href="../admin/assets/css/list.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="ui centered grid container">
            <div class="six wide column">
                <div class="logo">
                    <h1><?php echo 'Đăng Nhập'; ?></h1>
                </div>
                <form class="ui form" method="post" action="">
                    <?php $csrf->echoInputField(); ?>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="username" id="username" placeholder="Tên đăng nhập" autocomplete="off">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                        </div>
                        
                    </div>
                    <div class="button-login">
                        <input class="ui button" id="login" name="login" type="submit" value="Đăng nhập"/>
                    </div>
                    <div class="ui error message"></div>
                    <?php echo $error_message;?>
                </form>
            </div>
        </div>
    </div>
    <script src="../admin/assets/js/jquery-3.6.4.min.js"></script>
    <script src="../admin/assets/js/semantic.min.js"></script>
    <script src="../admin/assets/js/form.min.js"></script>
    <script src="../admin/assets/js/admin.js"></script>
</body>

</html>