<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | kapecafé</title>
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- fancy box  -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="assets/logo/Icon.png">
</head>


<body class="body-fixed">
    <!-- start of header  -->
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="#">
                            <img src="assets/logo/Icon.png" width="160" height="70" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="shop_1.php">MENU</a></li>                                
                                <li><a href="about.php">ABOUT</a></li>
                                <li><a href="testimonials.php">TESTIMONIALS</a></li>
                                <li><a href="contacts.php">CONTACT</a></li>
                            </ul>
                        </nav>

                        <div class="header-right">
                            <form action="#" class="header-search-form for-des">
                                <input type="search" class="form-input" placeholder="Search Here...">
                                <button type="submit">
                                    <i class="uil uil-search"></i>
                                </button>
                            </form>
                            
                            <a href="cart.php" class="header-btn header-cart">
                                
                                <i class="uil uil-shopping-bag"></i>        
                            </a>
                       
                            <a href="logout.php" class="header-btn">
                                <i class="uil uil-sign-out-alt"></i>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="viewport">
        <div id="js-scroll-content">
            <section class="main-banner" id="home">
                <div class="js-parallax-scene">
                    <div class="banner-shape-1 w-100" data-depth="0.30">
                        <img src="assets/images/slice cake rz.png" alt="">
                    </div>
                    <div class="banner-shape-2 w-100" data-depth="0.25">
                        <img src="assets/images/coffee.png" alt="">
                    </div>
                </div>
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                <?php echo "<h2> Hi, " . $_SESSION['username'] .  "!</h2>"; ?>
                                    <h1 class="h1-title">
                                        Welcome to 
                                        <span>kapecafé</span>
                                            Shop
                                    </h1>
                                    <p><b>kapecafé</b> is a Famous For Natural Ingredients. Our Sweet Story Began With One Goal At Heart -
                                         To Make Every Family Celebration Truly Special By Creating Delicious And Beautiful Beverages and Pastries.
                                          The Rest Is History, kapecafé Has Been Baking Delightful And Affordable Cafe For Filipinos.
                                           No Merienda No Almusal Is Complete Without <b>kapecafé</b>.</p>
                                    <div class="banner-btn mt-4">
                                        <a href="shop_1.php" class="sec-btn">Check our Menu</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <div class="banner-img" style="background-image: url(assets/products/CAKE3.png);">
                                    </div>
                                </div>
                                <div class="banner-img-text mt-4 m-auto">
                                    <h5 class="h5-title">Best Selling Cake</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <br><br><br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title text-center mb-5">
                        <p class="sec-sub-title mb-3">BEST SELLING PRODUCT</p>
                        <h2 class="h2-title">What our customers <span>most to buy</span></h2>
                        <div class="sec-title-shape mb-4">
                            <img src="assets/images/title-shape.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="gallery">
                <div class="col-lg-10 m-auto">
                    <div class="book-table-img-slider" id="icon">
                        <div class="swiper-wrapper">
                            <a href="assets/images/FT1 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT1\ SIZE.png)"></a>
                            <a href="assets/images/FT2 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT2\ SIZE.png)"></a>
                            <a href="assets/images/FT3 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT3\ SIZE.png)"></a>
                            <a href="assets/images/FT4 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT4\ SIZE.png)"></a>
                            <a href="assets/images/FT1 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT1\ SIZE.png)"></a>
                            <a href="assets/images/FT2 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT2\ SIZE.png)"></a>
                            <a href="assets/images/FT3 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT3\ SIZE.png)"></a>
                            <a href="assets/images/FT4 SIZE.png" data-fancybox="table-slider"
                                class="book-table-img back-img swiper-slide"
                                style="background-image: url(assets/images/FT4\ SIZE.png)"></a>
                        </div>

                        <div class="swiper-button-wp">
                            <div class="swiper-button-prev swiper-button">
                                <i class="uil uil-angle-left"></i>
                            </div>
                            <div class="swiper-button-next swiper-button">
                                <i class="uil uil-angle-right"></i>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- jquery  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!-- fontawesome  -->
    <script src="assets/js/font-awesome.min.js"></script>

    <!-- swiper slider  -->
    <script src="assets/js/swiper-bundle.min.js"></script>

    <!-- mixitup -- filter  -->
    <script src="assets/js/jquery.mixitup.min.js"></script>

    <!-- fancy box  -->
    <script src="assets/js/jquery.fancybox.min.js"></script>

    <!-- parallax  -->
    <script src="assets/js/parallax.min.js"></script>

    <!-- gsap  -->
    <script src="assets/js/gsap.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>

    <!-- scroll trigger  -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- scroll to plugin  -->
    <script src="assets/js/ScrollToPlugin.min.js"></script>
    <!-- rellax  -->
    <!-- <script src="assets/js/rellax.min.js"></script> -->
    <!-- <script src="assets/js/rellax-custom.js"></script> -->
    <!-- smooth scroll  -->
    <script src="assets/js/smooth-scroll.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>
 
</body>
</html>