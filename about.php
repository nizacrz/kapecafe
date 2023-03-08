<?php
include_once './shared/general.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | kapecafé</title>
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="/assets/styles/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="/assets/styles/swiper-bundle.min.css">
    <!-- fancy box  -->
    <link rel="stylesheet" href="/assets/styles/jquery.fancybox.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="/assets/styles/style.css">


    <link rel="icon" href="/assets/logo/Icon.png">
</head>


<body class="body-fixed">
    <?php html_navbar() ?>

    <section class="about-sec section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title text-center mb-5">
                        <p class="sec-sub-title mb-3">About Us</p>
                        <h2 class="h2-title">Discover Our <span>Restaurant Story</span></h2>
                        <div class="sec-title-shape mb-4">
                            <img src="/assets/images/title-shape.svg" alt="">
                        </div>
                        <p>In 2020, the company began in Pasig City as a small business run by a group of friends and had grown into a Filipino-owned and professionally managed enterprise. Kapecafé has become popular in the Philippines, offering an extensive selection of cakes and ice creams. Our products include Filipino-flavored cakes such as Ube Sans Rival, Mango Supreme, Pandam Macapuno, Avocado Deluxe, and Pandan Cake. The company also offered online ordering, allowing customers to purchase cakes and ice cream conveniently. The mission of Sweets is to bring families together and spread the joy of eating.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="about-video">
                        <div class="about-video-img" style="background-image: url(/assets/images/ABOUT\ PAGE.jpg);">
                        </div>
                        <div class="play-btn-wp">
                            <a href="assets" data-fancybox="video" class="play-btn">
                                <i class="uil uil-play"></i>
                            </a>
                            <span>Watch The Recipe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="brands-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-title mb-5">
                        <div class="brands-box">
                            <a href="#"> <img src="assets/logo/Icon.png" alt=""></a>
                        </div>
                        <br><br>
                        <center>
                            <h5 class="h5-title">Trusted Four Companies</h5>
                        </center>
                    </div>
                    <div class="brands-row">
                        <div class="brands-box">
                            <a href="https://thefrenchbakeronline.com/"> <img src="assets/images/brands/french baker.png" alt=""></a>
                        </div>
                        <div class="brands-box">
                            <a href="https://breadtalk.com.ph/"> <img src="assets/images/brands/bread talk.png" alt=""> </a>
                        </div>
                        <div class="brands-box">
                            <a href="https://www.pandemanila.com.ph/"> <img src="assets/images/brands/pan de manila.png" alt=""> </a>
                        </div>
                        <div class="brands-box">
                            <a href="https://lolanenas.com/products"> </a><img src="assets/images/brands/lola nenas.png" alt=""> </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-team section">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">Our Team</p>
                            <h2 class="h2-title">Meet Our Developers</h2>
                            <div class="sec-title-shape mb-4">
                                <img src="assets/images/title-shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row team-slider">
                    <div class="swiper-wrapper">
                        <div class="col-lg-4 swiper-slide">
                            <div class="team-box text-center">
                                <div style="background-image: url(assets/images/chef/C1.png);" class="team-img back-img">

                                </div>
                                <h3 class="h3-title">CRUZ, YUNICE NICOLLE</h3>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 swiper-slide">
                            <div class="team-box text-center">
                                <div style="background-image: url(assets/images/chef/C2.png);" class="team-img back-img">

                                </div>
                                <h3 class="h3-title">DURIAS, HYACINTH SOPHIA</h3>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 swiper-slide">
                            <div class="team-box text-center">
                                <div style="background-image: url(assets/images/chef/C3.png);" class="team-img back-img">

                                </div>
                                <h3 class="h3-title">FERNANDEZ, KYLE ASHLEY</h3>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/kyle.bfernandez"><i class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/kyleaxityvt">
                                                <i class="uil uil-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/channel/UC6mU_LOaqR2oq0fargHc_qw">
                                                <i class="uil uil-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 swiper-slide">
                            <div class="team-box text-center">
                                <div style="background-image: url(assets/images/chef/C4.png );" class="team-img back-img">
                                </div>
                                <h3 class="h3-title">LAGUA, SHAKAINA DANIELLE</h3>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 swiper-slide">
                            <div class="team-box text-center">
                                <div style="background-image: url(assets/images/chef/C5.png );" class="team-img back-img">

                                </div>
                                <h3 class="h3-title">MORATA, KHYLA</h3>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="uil uil-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#x">
                                                <i class="uil uil-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
    </section>

    <?php html_footer();
    html_footer_scripts(); ?>
</body>

</html>