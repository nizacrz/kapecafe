<?php

include $_SERVER['DOCUMENT_ROOT'] . '/shared/general.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?php echo http_response_code() ?></title>
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
        <div class="content1" style="text-align: center;">
            <h2><?php echo http_response_code() ?></h2>
            <h2>An Error has occurred</h2>
            <p>It seems you attempted to access a page that caused that error.</p>
        </div>
    </section>
    <?php html_footer();
    html_footer_scripts(); ?>
</body>

</html>