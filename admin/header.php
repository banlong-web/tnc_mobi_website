<?php
ob_start();
session_start();
include("../inc/config.php");
include("../inc/funtions.php");
include("../inc/CSRF_Protect.php");

if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Admin</title>
    <link rel="stylesheet" href="../admin/assets/css/semantic.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="ui top fixed inverted menu">
        <div class="left menu">
            <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
                <i class="sidebar icon"></i>
            </a>
            <a href="index.php" class="header item">
                <?php echo "TNC-MOBI" ?>
            </a>
            <a href="../index.php" class="header item" target="_blank">
                <?php echo "Visit site" ?>
            </a>
        </div>
        <div class="right menu">
            <a href="#" class="item">
                <i class="bell icon"></i>
            </a>
            <div class="ui dropdown item">
                <a href="#" class="dropdown-toggle" data-toggle="menu">
                    <img src="../public/uploads/<?php echo $_SESSION['admin']['photo']; ?>" class="user-image" alt="Admin Icon">
                    <span class="hidden-xs"><?php echo $_SESSION['admin']['full_name']; ?></span>
                </a>
                <i class="user cirlce icon"></i>
                <div class="menu">
                    <a href="profile-edit.php" class="item"><i class="info circle icon"></i> <?php echo 'Profile' ?></a>
                    <a href="logout.php" class="item"><i class="sign-out icon"></i><?php echo 'Logout' ?></a>
                </div>
            </div>
        </div>
    </nav>
    <?php 
        $current_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    ?>
    <div class="ui sidebar inverted vertical visible menu sidebar-menu" id="sidebar">
        <div class="item">
            <div class="menu">
                <a href="index.php" class="item <?php if($current_page == 'index.php') echo "active"; ?>">
                    <div>
                        <i class="icon tachometer alternate"></i>
                        <?php echo 'Trang chủ'; ?>
                    </div>
                </a>
            </div>
        </div>
        <div class="item">
            <div class="header">
                <i class="cogs icon"></i>
                <?php echo 'Thiết Lập Cửa Hàng'; ?>
            </div>
            <div class="menu">
                <a href="country.php" class="item <?php if($current_page == 'country.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Tỉnh/Thành Phố'; ?>
                    </div>
                </a>
                <a href="shipping-cost.php" class="item <?php if($current_page == 'shipping-cost.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Giá Vận Chuyển'; ?>
                    </div>
                </a>
                <a href="category.php" class="item <?php if($current_page == 'category.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Danh Mục'; ?>
                    </div>
                </a>
                <a href="attributes.php" class="item <?php if($current_page == 'attributes.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Thuộc Tính'; ?>
                    </div>
                </a>
            </div>
        </div>
        <div class="item">
            <div class="header">
                <i class="archive icon"></i>
                <?php echo 'Quản Lý Sản Phẩm'; ?>
            </div>
            <div class="menu">
                <a href="product.php" class="item 
                <?php if($current_page == 'product.php' || $current_page == 'product-edit.php' || $current_page == 'product-add.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Sản Phẩm'; ?>
                    </div>
                </a>
            </div>
        </div>
        <div class="item">
            <div class="header">
                <i class="cogs icon"></i>
                <?php echo 'Thiết Lập Website'; ?>
            </div>
            <div class="menu">
                <a href="settings.php" class="item <?php if($current_page == 'settings.php') echo "active"; ?>">
                    <div>
                        <?php echo 'Thiết Lập'; ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="pusher dimmed">
        <div class="main-content">
            <div class="ui grid stackable padded">
