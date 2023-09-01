<?php

function html_header($title = 'Kapecafé')
{
    echo "
        <!DOCTYPE html>
        <html lang='en'>
    
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{$title}</title>
            <!-- for icons  -->
            <link rel='stylesheet' href='https://unicons.iconscout.com/release/v4.0.0/css/line.css'>
            <!-- bootstrap  -->
            <link rel='stylesheet' href='/assets/styles/bootstrap.min.css'>
            <!-- for swiper slider  -->
            <link rel='stylesheet' href='/assets/styles/swiper-bundle.min.css'>
            <!-- fancy box  -->
            <link rel='stylesheet' href='/assets/styles/jquery.fancybox.min.css'>
            <!-- custom css  -->
            <link rel='stylesheet' href='/assets/styles/style.css'>
    
            <link rel='icon' href='/assets/logo/Icon.png'>
        </head>
    ";
}

function html_footer()
{
    echo "
    <footer>
        <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script>, KapeCafé</p>
    </footer>
    ";
}

function html_footer_scripts()
{
    echo '
    <!-- jquery  -->
    <script src="/assets/scripts/jquery-3.5.1.min.js" defer></script>
    <!-- bootstrap -->
    <script src="/assets/scripts/bootstrap.min.js" defer></script>
    <script src="/assets/scripts/popper.min.js" defer></script>

    <!-- fontawesome  -->
    <script src="/assets/scripts/font-awesome.min.js" defer></script>

    <!-- swiper slider  -->
    <script src="/assets/scripts/swiper-bundle.min.js" defer></script>

    <!-- mixitup -- filter  -->
    <script src="/assets/scripts/jquery.mixitup.min.js" defer></script>

    <!-- fancy box  -->
    <script src="/assets/scripts/jquery.fancybox.min.js" defer></script>

    <!-- parallax  -->
    <script src="/assets/scripts/parallax.min.js" defer></script>

    <!-- gsap  -->
    <script src="/assets/scripts/gsap.min.js" defer></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js" defer></script>

    <!-- scroll trigger  -->
    <script src="/assets/scripts/ScrollTrigger.min.js" defer></script>
    <!-- scroll to plugin  -->
    <script src="/assets/scripts/ScrollToPlugin.min.js" defer></script>
    <!-- rellax  -->
    <!-- <script src="/assets/scripts/rellax.min.js"></script> -->
    <!-- <script src="/assets/scripts/rellax-custom.js"></script> -->
    <!-- smooth scroll  -->
    <script src="/assets/scripts/smooth-scroll.js" defer></script>
    <!-- custom js  -->
    <script src="/assets/scripts/main.js" defer></script>
    ';
}

function html_maintenance_header()
{
    echo "
    <header class='header'>
        <div class='flex'>
            <a href='#' class='logo'>kapecafé</a>
            <nav class='navbar'>
                <a href='maintenance.php'> All Products </a>
                <a href='maintenance.php?category=Cakes'> Cakes</a>
                <a href='maintenance.php?category=Beverages'> Beverages </a>
                <a href='maintenance.php?category=Pastries'> Pastries</a>
                <a href='maintenance.php?category=Kakanin'> Special Kakanin</a>
                <a href='../services/handler.php'><i class='fa-solid fa-right-from-bracket'></i>Logout</a>
            </nav>
        </div>
    </header>
    ";
}

function html_navbar($is_logged_in = false)
{
    echo "
    <!-- start of header  -->
    <header class='site-header'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-2'>
                    <div class='header-logo'>
                        <a href='#'>
                            <img src='/assets/logo/Icon.png' width='160' height='70' alt='Logo'>
                        </a>
                    </div>
                </div>
                <div class='col-lg-10'>
                    <div class='main-navigation'>
                        <button class='menu-toggle'><span></span><span></span></button>
                        <nav class='header-menu'>
                            <ul class='menu food-nav-menu'>
                                <li><a href='/index.php'>HOME</a></li>
                                <li><a href='/shop.php'>MENU</a></li>
                                <li><a href='/about.php'>ABOUT</a></li>
                                <li><a href='/testimonials.php'>TESTIMONIALS</a></li>
                                <li><a href='/contacts.php'>CONTACT</a></li>
                            </ul>
                        </nav>
                        <div class='header-right'>
                            <form action='#' class='header-search-form for-des'>
                                <input type='search' class='form-input' placeholder='Search Here...'>
                                <button type='submit'>
                                    <i class='uil uil-search'></i>
                                </button>
                            </form>
                            <a href='cart.php' class='header-btn header-cart'>
                                <i class='uil uil-shopping-bag'></i>
                            </a>
                            " . ($is_logged_in ? "
                            <a href='/services/handler.php?logout' class='header-btn'>
                                <i class='uil uil-sign-out-alt'></i>
                            </a>
                            " : "<a href='/signin.php' class='header-btn'>
                                    <i class='uil uil-user-md'></i>
                                </a>") . "
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    ";
}

function html_searchbar($is_logged_in = false, $cart_size = 0)
{

    echo "
    <!-- header -->
    <header>
        <!-- main header -->
        <div class='header-wrapper' id='header-wrapper'>
            <span class='mb-menu-toggle mb-menu-close' id='mb-menu-close'>
                <i class='bx bx-x'></i>
            </span>
            <!-- search nav-->
            <div class='bg-main'>
                <div class='mid-header container1'>
                    <a class='navbar-brand' href='#'>
                        <img src='/assets/logo/Icon.png' width='160' height='70' alt='Logo'>
                    </a>
                    <div class='search'>
                        <input type='text' placeholder='Search'>
                        <i class='bx bx-search-alt'></i>
                    </div>
                    <ul class='user-menu'>
                        <li><a href='#'><i class='bx bx-bell'></i></a></li>
                        " . ($is_logged_in ? "
                        <li><a href='/services/handler.php?logout'><i class='bx bx-log-out-circle'></i></a></li>
                        <!-- CART ICON -->
                        <li><a href='/cart.php'><i class='glyphicon glyphicon-shopping-cart my-cart-icon bx bx-cart'><span class='badge badge-notify my-cart-badge'>$cart_size</span></i></a></li>" : "<li><a href='/signin.php'><i class='bx bx-user-circle'></i></a></li>") . "
                    </ul>
                </div>
            </div>

            <!-- bottom header -->
            <div class='bg-second'>
                <div class='bottom-header container'>
                    <ul class='main-menu'>
                        <li>
                            <a href='/index.php'>Home</a>
                        </li>
                        <!-- mega menu -->
                        <li class='mega-dropdown'>
                            <!-- Shop-->
                            <a href='#'>
                                Shop by Categories
                                <i class='bx bxs-chevron-down'></i>
                            </a>
                            <div class='mega-content'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <!--all handler-->
                                        <div class='box-menu'>
                                            <ul>
                                                <li>
                                                    <a href='/shop.php'>All Products</a>
                                                </li>
                                                <li>
                                                    <a href='/shop.php?category=Cakes'>
                                                        Cakes
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='/shop.php?category=Beverages'>
                                                        Classic Beverages
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='/shop.php?category=Pastries'>
                                                        Filipino Pastries
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='/shop.php?category=Kakanin'>
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
                            <a href='/about.php'>About Us</a>
                        </li>
                        <li>
                            <a href='/contacts.php'>Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end bottom header -->
        </div>
        <!-- end main header -->
    </header>
    ";
}
