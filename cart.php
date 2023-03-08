<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/shared/general.php';
session_start();
@include 'config.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if ($update_quantity_query) {
        header('location:cart.php');
    };
};

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location:cart.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:cart.php');
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
    <title>Shopping Cart | kapecafé</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- app css -->
    <link rel="shortcut icon" type="image/png" href="/assets/logo/Icon.png">
    <link rel="stylesheet" href="/assets/styles/cart.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        $(document).ready(function() {
            var quantity = 0;
            $('.quantity-right-plus').click(function(e) {
                // Increment

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var btn_id = $(this).attr('id');
                var id = btn_id.split("-")[1];
                var quantity = parseInt($('#quantity-' + id).val());

                // If is not undefined

                $('#quantity-' + id).val(quantity + 1);
            });

            $('.quantity-left-minus').click(function(e) {
                // Decrement

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var btn_id = $(this).attr('id');
                var id = btn_id.split("-")[1];
                var quantity = parseInt($('#quantity-' + id).val());
                console.log(quantity);
                // If is not undefined

                if (quantity > 1) {
                    $('#quantity-' + id).val(quantity - 1);
                }
            });
        });
    </script>
</head>

<body>
    <?php html_searchbar() ?>

    <div class="cart-container">

        <section class="shopping-cart" style="padding: 30px 45px 30px 45px !important; margin-bottom: auto;">

            <h1 class="heading" style="text-align: center;"> Shopping Cart </h1>
            <br>
            <table>

                <thead style="padding: 1.5rem;font-size: 18px;color: white;background-color: black;">
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Price</th>
                    <th style="text-align: center;">Quantity</th>
                    <th style="text-align: center;">Total price</th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                </thead>

                <tbody>

                    <?php

                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>
                            <tr>
                                <form action="" method="post">
                                    <td><img src="assets/uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                                    <td><?php echo $fetch_cart['name']; ?></td>
                                    <td>₱<?php echo number_format($fetch_cart['price']); ?>.00</td>
                                    <td>

                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">

                                        <!-- Quantity Plus & Minus -->

                                        <div class="input-group">

                                            <span class="input-group-btn">
                                                <button type="button" id="dec-<?php echo $fetch_cart['id']; ?>" class="quantity-left-minus btn-minus btn-danger btn-number" data-type="minus" data-field="">-
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity-<?php echo $fetch_cart['id']; ?>" name="update_quantity" class="form-control input-number" value="<?php echo $fetch_cart['quantity']; ?>" min="1">
                                            <span class="input-group-btn">

                                                <button type="button" id="inc-<?php echo $fetch_cart['id']; ?>" class="quantity-right-plus btn-plus btn-success btn-number" name="update_update_btn" data-type="plus" data-field="">+
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                        <!-- End Quantity Plus & Minus -->
                                        <br>
                                    </td>
                                    <td>₱ <?php echo $sub_total = number_format($fetch_cart['price']) * number_format($fetch_cart['quantity']); ?>.00</td>
                                    <td class="update-td"><input type="submit" value="Update" name="update_update_btn" class="btn-update btn-warning"> </td>
                                    <td> <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="btn-delete btn-danger" style="margin-left: -13px; font-size: 18px; text-align: center; padding-right: 13px; margin-top: -15px;"> </i> Delete</a>
                                    </td>
                                </form>

                            </tr>
                    <?php
                            $grand_total += $sub_total;
                        };
                    };
                    ?>

                    <tr class="table-bottom">
                        <td><a href="shop_1.php" class="btn-continue btn-warning">Continue Shopping</a></td>
                        <td colspan="3">GRAND TOTAL</td>
                        <td>₱<?php echo $grand_total; ?>.00</td>
                        <td></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn-deleteall btn-danger"> <i class="fas fa-trash"></i> Delete all </a></td>

                    </tr>

                </tbody>
            </table>
            <br>
            <center>
                <div class="horizontal-center">
                    <button class="checkout-btn">
                        <a href="checkout.php" <?= ($grand_total > 1) ? '' : 'disabled'; ?>><span>Proceed to Checkout</span>
                    </button>
                </div>
            </center>
        </section>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php html_footer(); ?>

    <script src="/assets/scripts/jquery.nice-number.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>