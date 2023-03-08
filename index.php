<?php
include_once './services/config/Database.php';
include_once './services/models/User.php';
include './shared/general.php';

session_start();

$user;

if (isset($_SESSION['id'])) {
    $user = new User(Database::connect());
    $user->id = intval($_SESSION['id']);
    $user->read_single();
}

html_header();
?>

<body class="body-fixed">
    <?php html_navbar(isset($user)) ?>

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
                                    <?php echo isset($user) ? "<h2> Hi, " . $user->username .  "!</h2>" : "";
                                    ?>
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
                            <a href="assets/images/FT1 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT1\ SIZE.png)"></a>
                            <a href="assets/images/FT2 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT2\ SIZE.png)"></a>
                            <a href="assets/images/FT3 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT3\ SIZE.png)"></a>
                            <a href="assets/images/FT4 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT4\ SIZE.png)"></a>
                            <a href="assets/images/FT1 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT1\ SIZE.png)"></a>
                            <a href="assets/images/FT2 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT2\ SIZE.png)"></a>
                            <a href="assets/images/FT3 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT3\ SIZE.png)"></a>
                            <a href="assets/images/FT4 SIZE.png" data-fancybox="table-slider" class="book-table-img back-img swiper-slide" style="background-image: url(assets/images/FT4\ SIZE.png)"></a>
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

    <?php html_footer_scripts() ?>

</body>

</html>