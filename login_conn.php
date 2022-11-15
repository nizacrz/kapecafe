<?php

include "config.php";
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$password = validate($_POST['password']);

	if (empty($username)) {
		header("Location: signin.php?error=Username is required!");
	    exit();
	}else if(empty($password)){
        header("Location: signin.php?error=Password is required!");
	    exit();
	}else{
		
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);

            if ($row["role"] == "Admin") {
                $_SESSION['role'] = $row['role'];
            	header('Location: admin/product_maintenance.php');
		        exit();

            }else{
				$_SESSION['username'] = $row['username'];
                header('Location: index.php');
			}
		}else{
			header("Location: signin.php?error=Invalid username or password! Please try again.");
	        exit();
		}
	}
	
}else{
	header("Location: signin.php");
	exit();
}
?>