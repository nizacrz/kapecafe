<?php
include_once './shared/general.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials | kapecafé</title>
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

    <section class="testimonials section bg-light">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">What they say</p>
                            <h2 class="h2-title">What our customers <span>say about us</span></h2>
                            <div class="sec-title-shape mb-4">
                                <img src="assets/images/title-shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="testimonials-img">
                            <img src="assets/images/testimonial-img.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="testimonials-box">
                                    <div class="testimonial-box-top">
                                        <div class="testimonials-box-img back-img" style="background-image: url(assets/images/testimonials/T1.png);">
                                        </div>
                                        <div class="star-rating-wp">
                                            <div class="star-rating">
                                                <span class="star-rating__fill" style="width:85%"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="testimonials-box-text">
                                        <h3 class="h3-title">
                                            Aron Felias
                                        </h3>
                                        <p>kapecafé made my days, I want to order more.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="testimonials-box">
                                    <div class="testimonial-box-top">
                                        <div class="testimonials-box-img back-img" style="background-image: url(assets/images/testimonials/T2.png);">
                                        </div>
                                        <div class="star-rating-wp">
                                            <div class="star-rating">
                                                <span class="star-rating__fill" style="width:80%"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="testimonials-box-text">
                                        <h3 class="h3-title">
                                            Keem Percival
                                        </h3>
                                        <p>I love the taste of the their special kakanin! it's very sweet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="testimonials-box">
                                    <div class="testimonial-box-top">
                                        <div class="testimonials-box-img back-img" style="background-image: url(assets/images/testimonials/T3.png);">
                                        </div>
                                        <div class="star-rating-wp">
                                            <div class="star-rating">
                                                <span class="star-rating__fill" style="width:89%"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="testimonials-box-text">
                                        <h3 class="h3-title">
                                            Zophia Mislos
                                        </h3>
                                        <p>I love the way they post and display their sweets in their website, it's very nice!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="testimonials-box">
                                    <div class="testimonial-box-top">
                                        <div class="testimonials-box-img back-img" style="background-image: url(assets/images/testimonials/T4.png);">
                                        </div>
                                        <div class="star-rating-wp">
                                            <div class="star-rating">
                                                <span class="star-rating__fill" style="width:100%"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="testimonials-box-text">
                                        <h3 class="h3-title">
                                            Joliefer Decena
                                        </h3>
                                        <p>I rate a perfect 5 star because this is the best café shop that i encountered in my life.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php html_footer();
    html_footer_scripts(); ?>
</body>

</html>