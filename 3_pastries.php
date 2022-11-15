<?php

include 'config.php';
session_start();

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        echo '<script>alert("Product already added to cart")</script>';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        echo '<script>alert("Product added to cart succesfully")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ADDTOCART STYLE -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .badge-notify {
            right: -10px;
            top: -10px;
            min-width: 10px;
            min-height: 10px;
            line-height: 10px;
            padding: 5px;
            color: #fff;
            background-color: #bf1f1f;
            font-size: 10px;
            border-radius: 20px;
            border: solid 1px #c93a3a;
        }
    </style>
    <!-- ADDTOCART STYLE END -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filipino Pastries | kapecafé</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- app css -->
    <link rel="shortcut icon" type="image/png" href="assets/logo/Icon.png">
    <link rel="stylesheet" href="shop.css">
</head>

<body>
    <!-- header -->
    <header>
        <!-- main header -->
        <div class="header-wrapper" id="header-wrapper">
            <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
                <i class="bx bx-x"></i>
            </span>
            <!-- search nav-->
            <div class="bg-main">
                <div class="mid-header container1">
                    <a class="navbar-brand" href="#">
                        <img src="assets/logo/Icon.png" width="160" height="70" alt="Logo">
                    </a>
                    <div class="search">
                        <input type="text" placeholder="Search">
                        <i class="bx bx-search-alt"></i>
                    </div>
                    <ul class="user-menu">
                        <li><a href="#"><i class='bx bx-bell'></i></a></li>
                        <li><a href="logout.php"><i class='bx bx-log-out-circle'></i></a></li>
                        <!-- CART ICON -->
                        <?php

                        $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);

                        ?>
                        <li><a href="cart.php"><i class='glyphicon glyphicon-shopping-cart my-cart-icon bx bx-cart'><span class="badge badge-notify my-cart-badge"><?php echo $row_count; ?></span></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- bottom header -->
            <div class="bg-second">
                <div class="bottom-header container">
                    <ul class="main-menu">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <!-- mega menu -->
                        <li class="mega-dropdown">
                            <!-- Shop-->
                            <a href="#">
                                Shop by Categories
                                <i class="bx bxs-chevron-down"></i>
                            </a>
                            <div class="mega-content">
                                <div class="row">
                                    <div class="col-12">
                                        <!--all handler-->
                                        <div class="box-menu">
                                            <ul>
                                                <li>
                                                    <a href="shop_1.php">All Products</a>
                                                </li>
                                                <li>
                                                    <a href="1_cakes.php">
                                                        Cakes
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="2_beverages.php">
                                                        Classic Beverages
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="3_pastries.php">
                                                        Filipino Pastries
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="4_kakanin.php">
                                                        Special Kakanin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- end mega menu -->
                        <li>
                            <a href="about.php">About Us</a>
                        </li>
                        <li>
                            <a href="contacts.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end bottom header -->
        </div>
        <!-- end main header -->
    </header>
    <!-- end header -->
    <!-- products content -->
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="index.php">home</a>
                    <span>
                        <i class="bx bxs-chevrons-right"></i>
                    </span>
                    <a href="3_pastries.php">All Filipino Pastries</a>
                </div>
            </div>
        </div>


        <!--ALL PRODUCTS-->
        <div class="box">
            <div class="row">

                <?php
                $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE category = 'Pastries'");
                if (mysqli_num_rows($select_product) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_product)) {
                ?>
                        <div class="col-3 col-md-6 col-sm-12">
                            <form method="POST" action="">
                                <div class="product-card">
                                    <!--image-->
                                    <div class="product-card-img">
                                        <img src="assets/uploaded_img/<?php echo $fetch_product['image']; ?>" class="img-responsive">
                                        <img src="assets/uploaded_img/<?php echo $fetch_product['image']; ?>" class="img-responsive">
                                    </div>
                                    <!--Product Info-->
                                    <div class="product-card-info">

                                        <div class="product-btn1">
                                            <!--ADD TO CART -->
                                            <button class="btn-flat btn-hover btn-cart-add my-cart-btn" input type="submit" name="add_to_cart" value="add to cart" style="font-size: 16px; width: 180px;">
                                                <i class='bx bxs-cart-add'> ADD TO CART</i>
                                            </button>
                                        </div>
                                        <!--name-->
                                        <div class="product-card-name">
                                            <br><?php echo $fetch_product['name']; ?>
                                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" />
                                        </div>
                                        <!--description-->
                                        <div class="product-card-desc">
                                            <br><?php echo $fetch_product['description']; ?>
                                            <input type="hidden" name="product_description" value="<?php echo $fetch_product['description']; ?>" />
                                        </div>
                                        <!--price-->
                                        <div class="product-card-price">
                                            <span class="curr-price">₱ <?php echo $fetch_product['price']; ?></span>
                                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>" />
                                        </div>
                                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" />
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>" />
                                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>" />
                                    </div>
                                </div>
                            </form>
                        </div>

                <?php

                    };
                };
                ?>

            </div>
        </div>

        <!-- end products content -->
        <!-- footer -->
        <div><?php include 'footer.php'; ?></div>
        <!-- end footer -->
</body>

</html>