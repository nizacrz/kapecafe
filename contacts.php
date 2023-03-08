<?php
include_once './shared/general.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts | kapecafé</title>
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
    <link rel="stylesheet" href="/assets/styles/contact.css">
    <link rel="icon" href="/assets/logo/Icon.png">
</head>


<body class="body-fixed">
    <?php html_navbar() ?>

    <section class="contact1">
        <div class="content1">
            <center>
                <br> <br> <br> <br> <br> <br>

                <h2>Contact Us </h2>
                <p>kapecafé accept your feedback and concerns. It would be greatly appreciated if you could contact us! </p>
            </center>
        </div>
        <div class="container1">
            <div class="contactInfo1">
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>KapeCafe@gmail.com</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>(02) 8911 0964</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>938 Aurora Boulevard,<br>Cubao,<br>Quezon City 1109</p>
                    </div>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.5844619095187!2d121.04838442886974!3d14.622731847806484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7bf0ffd25cd%3A0xf6fdea659846b5c7!2s938%20Aurora%20Blvd%2C%20Cubao%2C%20Quezon%20City%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1649779505955!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="contactForm1">
                <form>
                    <h2>Send Message</h2>
                    <div class="inputBox">
                        <input type="text" name="" required="required">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea required="required"></textarea>
                        <span>Type your Message...</span>
                    </div>
                    <div class="inputBox">
                        <a class="my-button" value="send" href="#">Send</a><a href="index.html" a class="my-button" title="back" href="#">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <?php html_footer();
    html_footer_scripts(); ?>


</body>

</html>