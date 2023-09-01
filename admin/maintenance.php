<?php

include '../config.php';
include_once '../services/config/Database.php';
include_once '../services/models/User.php';
include_once '../services/models/Product.php';

session_start();

/**
 * Get ID from session data. This proves user authentication
 */
if (isset($_SESSION['id'])) {
    // Resolve User Information
    $user = new User(Database::connect());
    $user->id = intval($_SESSION['id']);
    $user->read_single();

    // In case user is not an admin
    if ($user->role !== "Admin") {
        http_response_code(401); // Unauthorized
        include_once('../services/utils/error.php');
        exit();
    }
} else {
    http_response_code(401); // Unauthorized
    include_once('../services/utils/error.php');
    die();
}

$product = new Product(Database::connect());

/**
 * Delete request??
 */
if (isset($_GET['delete'])) {


    $delete_id = $_GET['delete'];

    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
    if ($delete_query) {
        header('location:product_maintenance.php');
        $message[] = 'product has been deleted';
    } else {
        header('location:product_maintenance.php');
        $message[] = 'product could not be deleted';
    };
};

/**
 * Update Request
 */
if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_category = $_POST['update_p_category'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_description = $_POST['update_p_description'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = '../assets/uploaded_img/' . $update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

    if ($update_query) {
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'product updated succesfully';
        header('location:product_maintenance.php');
    } else {
        $message[] = 'product could not be updated';
        header('location:product_maintenance.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Page | kapecafé</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="admin.css">

    <link rel="shortcut icon" type="image/png" href="../assets/logo/Icon.png">

</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">

        <section class="display-product-table">
            <h1>All Products</h1>
            <a href="add_product.php" class="option-btn" style="width: 223px; padding-top: 15px; margin-bottom: 20px;"> <i class="fa-solid fa-plus"></i></i> Add New Product </a>
            <table>
                <thead>
                    <th>Image</th>
                    <th>Categories</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php
                    $results = $product->read($size = 0);

                    if ($results->rowCount() > 0) {
                        while ($product_data = $results->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tr>
                                <td><img src="../assets/uploaded_img/<?php echo $product_data['image']; ?>" height="100" alt=""></td>
                                <td><?php echo $product_data['category']; ?></td>
                                <td><?php echo $product_data['name']; ?></td>
                                <td><?php echo $product_data['description']; ?></td>
                                <td>₱<?php echo $product_data['price']; ?></td>
                                <td>
                                    <a href="maintenance.php?delete=<?php echo $product_data['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                    <a href="maintenance.php?edit=<?php echo $product_data['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<div class='empty'>no product added</div>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="edit-form-container">

            <?php

            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <img src="../assets/uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                            <input type="text" class="box" required name="update_p_category" value="<?php echo $fetch_edit['category']; ?>">
                            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                            <input type="text" class="box" required name="update_p_description" value="<?php echo $fetch_edit['description']; ?>">
                            <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                            <input type="file" class="box" name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                            <input type="submit" value="update the product" name="update_product" class="btn">
                            <a class="option-btn" href="product_maintenance.php" role="button"> Cancel </a>

                        </form>

            <?php
                    };
                };
                echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>

        </section>

    </div>


    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <div><?php include '../footer.php'; ?></div>
</body>

</html>