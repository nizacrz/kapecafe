<?php

@include '../config.php';

if(isset($_POST['add_product'])){
   $category = $_POST['category'];
   $name = $_POST['name'];
   $description = $_POST['description'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $p_image_tmp_name = $_FILES['image']['tmp_name'];
   $p_image_folder = '../assets/uploaded_img/'.$image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(category, name, description, price, image) VALUES('$category', '$name', '$description', '$price', '$image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product | kapecafé</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">

   <link rel="shortcut icon" type="image/png" href="../assets/logo/Icon.png">

</head>
<body>
<?php include 'header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="text" name="category" placeholder="enter the product category" class="box" required>
   <input type="text" name="name" placeholder="enter the product name" class="box" required>
   <input type="text" name="description" placeholder="enter the product description" class="box" required>
   <input type="number" name="price" min="0" placeholder="enter the product price" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
   <a class="option-btn" href="product_maintenance.php" role="button"> Cancel </a>
</form>

</section>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- custom js file link  -->
<script src="js/script.js"></script>
<div><?php include '../footer.php'; ?></div>
</body>

</html>