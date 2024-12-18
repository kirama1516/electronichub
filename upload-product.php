<?php

require_once '/var/www/html/radios/upload-product.php';

// Include the database connection file
require_once 'db_connection.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];

  // Get the uploaded image file
  $image = $_FILES['image'];

  // Check if the image file is valid
  if ($image['error'] == 0) {
    // Move the uploaded image file to the server
    $image_path = 'uploads/' . $image['name'];
    move_uploaded_file($image['tmp_name'], $image_path);

    // Insert the product data into the database using PDO
    $sql = "INSERT INTO products (name, description, price, category, image) VALUES (:name, :description, :price, :category, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':image', $image_path);
    $stmt->execute();

    // Check if the product data was inserted successfully
    if ($stmt->rowCount() > 0) {
      echo "Product uploaded successfully!";
    } else {
      echo "Error uploading product!";
    }
  } else {
    echo "Error uploading image file!";
  }
}

// Close the PDO connection
$pdo = null;

?>
