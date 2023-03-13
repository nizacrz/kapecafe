<?php
include_once './shared/general.php';
include_once './services/config/Database.php';
include_once './services/models/Product.php';
include_once './services/models/User.php';
include_once './services/models/Cart.php';
include_once './services/models/Order.php';

session_start();

$conn = Database::connect();
$product = new Product($conn);
$cart;
$user;

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Resolve user information
    $user = new User($conn);
    $user->id = intval($_SESSION['id']);
    $user->read_single();

    $cart = new Cart($conn);
    $cart->user_id = $user->id;
} else {
    echo '<script>alert("You must log in first"); window.location.href = "/signin.php"</script>';
    die();
}


if (isset($_POST['order_btn'])) {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];

    $cart_query = $cart->read_by_user_full();
    $price_total = 0;
    if ($cart_query->rowCount() > 0) {
        while ($product_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
            $product_price = $product_item['price'] * $product_item['quantity'];
            $price_total += $product_price;
        };
    };

    $total_product = implode(', ', $product_name);

    $order = new Order($conn);
    $order->name = $name;
    $order->number = $number;
    $order->email = $email;
    $order->method = $method;
    $order->flat = $flat;
    $order->street = $street;
    $order->city = $city;
    $order->state = $state;
    $order->country = $country;
    $order->pin_code = $pin_code;
    $order->total_products = $total_product;
    $order->total_price = number_format($price_total);

    $order_success = $order->create();

    if ($order_success) {
        echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping, <span></br>" . $name . "!</span> </h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> Grand total : ₱" . $price_total . "/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>" . $name . "</span> </p>
            <p> your number : <span>" . $number . "</span> </p>
            <p> your email : <span>" . $email . "</span> </p>
            <p> your address : <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> your payment mode : <span>" . $method . "</span> </p>
            <p>Please pay when product arrives.</p>
         </div>
            <a href='cart.php?delete_all' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | kapecafé</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="/assets/styles/checkoutagain.css">



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
    <link rel="stylesheet" href="/assets/styles/checkout.css">

</head>

<body>

    <?php
    if (isset($user)) {
        $cart_check = new Cart($conn);
        $cart_check->user_id = $user->id;
        $cart_stmt = $cart_check->read_by_user();
        $cart_count = $cart_stmt->rowCount();
    }

    html_searchbar(isset($user), isset($cart_count) ? $cart_count : NULL)
    ?>


    <div class="container">

        <section class="checkout-form">

            <h1 class="heading">complete your order</h1>

            <form action="" method="post">

                <div class="display-order">
                    <?php
                    $items = $cart->read_by_user_full();
                    $total = 0;
                    $grand_total = 0;
                    if ($items->rowCount() > 0) {
                        while ($item = $items->fetch(PDO::FETCH_ASSOC)) {
                            $total_price = $item['price'] * $item['quantity'];
                            $grand_total = $total += $total_price;
                    ?>
                            <span><?= $item['name']; ?>(<?= $item['quantity']; ?>)</span>
                    <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>your cart is empty!</span></div>";
                    }
                    ?>
                    <span class="grand-total"> grand total : ₱<?= number_format($grand_total); ?>/- </span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Contact number</span>
                        <input type="text" placeholder="Phone no." name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>Email address</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>payment method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>cash on delivery</option>
                            <option value="credit cart">credit cart</option>
                            <option value="paypal">paypal</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>address line 1</span>
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>city</span>
                        <input type="text" placeholder="e.g. Quezon City" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>state</span>
                        <input type="text" placeholder="e.g. NCR" name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>country</span>
                        <input type="text" placeholder="e.g. Philippines" name="country" required>
                    </div>
                    <div class="inputBox">
                        <span>pin code</span>
                        <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                    </div>
                </div>
                <input type="submit" value="order now" name="order_btn" class="btn">
            </form>

        </section>

    </div>

    <!-- footer -->
    <div><?php html_footer(); ?></div>
    <!-- end footer -->

</body>

</html>