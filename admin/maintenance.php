<?php

include '../config.php';
include_once '../shared/general.php';
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

/**
 * This is the Product Data Object.
 * This variable is used for initiating CRUD Requests
 * and for updating the database.
 */
$product = new Product(Database::connect());

/**
 * Delete request receives the product ID
 * then a delete request is executed.
 */
if (isset($_GET['delete'])) {

    $delete_id = intval($_GET['delete']);

    $product->id = $delete_id;
    $delete_result = $product->delete();

    if ($delete_result) {
        header('location:maintenance.php');
        $message[] = 'product has been deleted';
        die();
    } else {
        header('location:maintenance.php');
        $message[] = 'product could not be deleted';
        die();
    };
};

/**
 * Update Request
 */
if (isset($_POST['update_product'])) {

    // Resolve all information into Product PDO
    $product->id = intval($_POST['update_p_id']);
    $product->category = $_POST['update_p_category'];
    $product->name = $_POST['update_p_name'];
    $product->description = $_POST['update_p_description'];
    $product->price = $_POST['update_p_price'];

    // Check if an image was uploaded
    if (isset($_FILES['update_p_image']) && $_FILES['update_p_image']['error'] === UPLOAD_ERR_OK) {
        // Create a new name for the image
        $uploaded_image = $_FILES['update_p_image'];
        $product_image_name = md5_file($uploaded_image['tmp_name']) . '.' . pathinfo($uploaded_image['name'], PATHINFO_EXTENSION);

        $product->image = $product_image_name;
    }

    // Execute the update query
    $update_query = $product->update();

    if ($update_query) {
        // Successful update
        if (isset($uploaded_image)) {
            $update_p_image_folder = '../assets/uploaded_img/' . $product_image_name;

            move_uploaded_file($uploaded_image['tmp_name'], $update_p_image_folder);
        }
        header('location:maintenance.php');
    } else {
        // Failed to update
        header('location:maintenance.php');
    }
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
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
    <?php html_maintenance_header(); ?>

    <div class="container">

        <section class="display-product-table">
            <h1><?php
                echo isset($category) ? $category : "All Products";
                ?></h1>
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

                    if (isset($category)) {
                        $product->category = $category;
                        $results = $product->read_by_category();
                    } else {
                        $results = $product->read($size = 0);
                    }

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
                $edit_id = intval($_GET['edit']);

                $product->id = $edit_id;
                $edit_result = $product->read_single();
                if ($edit_result->rowCount() > 0) {
                    $product_info = $edit_result->fetch(PDO::FETCH_ASSOC);
            ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <img src="../assets/uploaded_img/<?php echo $product_info['image']; ?>" height="200" alt="">
                        <input type="hidden" name="update_p_id" value="<?php echo $product_info['id']; ?>">
                        <input type="text" class="box" required name="update_p_category" value="<?php echo $product_info['category']; ?>">
                        <input type="text" class="box" required name="update_p_name" value="<?php echo $product_info['name']; ?>">
                        <input type="text" class="box" required name="update_p_description" value="<?php echo $product_info['description']; ?>">
                        <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $product_info['price']; ?>">
                        <input type="file" class="box" name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="update the product" name="update_product" class="btn">
                        <a class="option-btn" href="product_maintenance.php" role="button"> Cancel </a>

                    </form>

            <?php
                };
                echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>
        </section>
    </div>
    <div><?php html_footer();
            html_footer_scripts(); ?></div>
</body>

</html>