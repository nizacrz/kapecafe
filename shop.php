<?php
include 'config.php';
include_once './shared/general.php';
include_once './services/config/Database.php';
include_once './services/models/Product.php';
include_once './services/models/User.php';
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

$db = new Database();
$conn = $db->connect();
$product = new Product($conn);

$category;
$index_size = 1;
$page = 1;
$stmt;

if (isset($_GET['category'])) {
    $category = str::sanitizeString($_GET['category']);
}

if (isset($_GET['page'])) {
    $page = intval(str::sanitizeInt($_GET['page']));
}

$nextPage = $page + 1;
$prevPage = $page - 1;

if (isset($category)) {
    $product->category = $category;

    $categs = $product->read_products_per_category(0);
    $categs_count = $categs->rowCount();
    $index_size = floor($categs_count / $DISPLAY_COUNT);

    $stmt = $product->read_products_per_category($DISPLAY_COUNT, $page);
} else {
    $categs = $product->read(0);
    $categs_count = $categs->rowCount();
    $index_size = floor($categs_count / $DISPLAY_COUNT);

    $stmt = $product->read($DISPLAY_COUNT, $page);
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
    <title>All Products | kapecafé</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- app css -->
    <link rel="shortcut icon" type="image/png" href="/assets/logo/Icon.png">
    <link rel="stylesheet" href="/assets/styles/shop.css">
</head>

<body>
    <?php
    html_searchbar()
    ?>
    <!-- products content -->
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="index.php">home</a>
                    <span>
                        <i class="bx bxs-chevrons-right"></i>
                    </span>
                    <a href="#">All <?php echo isset($category) ? $category : 'Products' ?></a>
                </div>
            </div>
        </div>


        <!--ALL PRODUCTS-->
        <div class="box">
            <div class="row">

                <?php
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="col-3 col-md-6 col-sm-12">
                            <form method="POST" action="">
                                <div class="product-card">
                                    <!--image-->
                                    <div class="product-card-img">
                                        <img src="assets/uploaded_img/<?php echo $row['image']; ?>" class="img-responsive">
                                        <img src="assets/uploaded_img/<?php echo $row['image']; ?>" class="img-responsive">
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
                                            <br><?php echo $row['name']; ?>
                                            <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>" />
                                        </div>
                                        <!--description-->
                                        <div class="product-card-desc">
                                            <br><?php echo $row['description']; ?>
                                            <input type="hidden" name="product_description" value="<?php echo $row['description']; ?>" />
                                        </div>
                                        <!--price-->
                                        <div class="product-card-price">
                                            <span class="curr-price">₱ <?php echo $row['price']; ?></span>
                                            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>" />
                                        </div>
                                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>" />
                                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>" />
                                        <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>" />
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

        <div class="page-box">
            <ul class="pagination">
                <?php
                if ($prevPage > 0) {
                ?>
                    <li><a href="shop.php?<?php echo isset($category) ? `category=$category&page=$prevPage` : "page=$prevPage" ?>"><i class='bx bxs-chevron-left'></i></a></li>
                <?php
                }
                for ($i = 1; $i <= $index_size + 1; $i++) {
                ?>
                    <li><a href="shop.php?<?php echo isset($category) ? "category=$category&page=$i" : "page=$i" ?>" class="<?php echo $page === $i ? 'active' : '';  ?>"><?php echo $i ?></a></li>
                <?php }
                if ($nextPage < $index_size + 2) { ?>
                    <li><a href="shop.php?<?php echo isset($category) ? `category=$category&page=$nextPage` : "page=$nextPage" ?>"><i class='bx bxs-chevron-right'></i></a></li>
                <?php } ?>
            </ul>
        </div>
        <br>
    </div>
    </div>
    <!-- end products content -->
    <!-- footer -->
    <?php html_footer() ?>
    <!-- end footer -->
</body>

</html>