<?php

// require_once '/var/www/html/radios/upload-product.php';

// Include the database connection file
require_once 'db/config.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['upload'])) {
  // Get the form data
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  // Get the uploaded image file
  $image = $_FILES['image'];
  }

  // Check if the image file is valid
  if ($image['error'] == 0) {
    // Move the uploaded image file to the server
    $image_path = 'uploads/' . $image['name'];
    move_uploaded_file($image['tmp_name'], $image_path);

    // Insert the product data into the database using PDO
    $sql = "INSERT INTO Products (name, description, price, category, image) VALUES (:name, :description, :price, :category, :image)";
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


<!doctype html>
<html lang="zxx">

<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Radios - Electronics Store WooCommerce Template</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" type="images/x-icon"/>

    <!-- css include -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/uikit.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/upload-product.css">
</head>

<body>

    <div class="body_wrap">

        <!-- preloder start  -->
        <div class="preloder_part">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
        <!-- preloder end  -->

        <!-- back to top start -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
        <!-- back to top end -->

        <!-- header start -->
            <?php
                include 'assets/includes/header.php';
            ?>
        <!-- header end -->

        <!-- slide-bar start -->
            <?php
                include 'assets/includes/slide-bar.php';
            ?>
        <!-- slide-bar end -->

        <main>
            
            <!-- breadcrumb start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="radios-breadcrumb breadcrumbs">
                        <ul class="list-unstyled d-flex align-items-center">
                            <li class="radiosbcrmb-item radiosbcrumb-begin">
                                <a href="index.html"><span>Home</span></a>
                            </li>
                            <li class="radiosbcrumb-item radiosbcrumb-end">
                                <span>Account</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- breadcrumb end -->

            <!-- upload-product start -->
            <section class="account pb-90">
                <div class="container">
                    <div class="row mt-none-30">
                        <div class="col-lg-6 mt-30">
                            <div class="account__wrap pr-60">
                                <h2 class="account__title">Sign Up</h2>
                                <form action="upload-product.php" method="post" enctype="multipart/form-data">
                                    <div class="account__input-field">
                                        <label for="name">Product Name:</label>
                                        <input type="text" id="name" name="name" required>
                                    </div>
                                    <div class="account__input-field">
                                        <label for="description">Product Description:</label>
                                        <textarea id="description" name="description" required></textarea>
                                    </div>
                                    <div class="account__input-field">
                                        <label for="price">Product Price:</label>
                                        <input type="number" id="price" name="price" required>
                                    </div>
                                    <div class="account__input-field">
                                        <label for="image">Product Image:</label>
                                        <input type="file" id="image" name="image" accept="image/*" required>
                                    </div>
                                    <div class="account__input-field">
                                        <label for="category">Product Category:</label>
                                        <select id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="fashion">Fashion</option>
                                            <option value="home">Home</option>
                                        </select>
                                    </div>
                                    <div class="account__btn">
                                        <a class="thm-btn thm-btn__2" href="#!">
                                            <span class="btn-wrap">
                                               <!-- <button type="submit" name="upload">Upload Product</button>
                                               <button type="submit" name="upload">Upload Product</button> -->
                                                <span><button type="submit" name="upload">Upload Product</button></span>
                                                <span><button type="submit" name="upload">Upload Product</button></span>
                                            </span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-30">
                            <div class="account__wrap pl-60">
                                <h2 class="account__title">Login here</h2>
                                <div id="preview-container">
                                    <img id="preview" alt="Product Image Preview">
                                </div>
                                <!-- <form action="#">
                                    <div class="account__input-field">
                                        <label for="lemail">Email Address</label>
                                        <input id="lemail" type="email" placeholder="Enter Email Address">
                                    </div>
                                    <div class="account__input-field">
                                        <label for="lpassword">Password</label>
                                        <input id="lpassword" type="text" placeholder="password">
                                    </div>
                                    <div class="account__input-field">
                                        <input class="form-check-input" id="lcheckbox" type="checkbox" checked>
                                        <label class="form-check-label" for="lcheckbox">Remember Me?</label>
                                    </div>
                                    <div class="account__btn">
                                        <a class="thm-btn thm-btn__2" href="#!">
                                            <span class="btn-wrap">
                                                <span>Login here</span>
                                                <span>Login here</span>
                                            </span>
                                        </a>
                                    </div>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- upload-product end -->
            
        </main>

        <!-- footer start -->
            <?php
                include 'assets/includes/footer.php';
            ?>
        <!-- footer end -->

        <!-- start newsletter-popup-area-section -->
        <section class="newsletter-popup-area-section">
            <div class="newsletter-popup-area">
                <div class="newsletter-popup-ineer">
                    <button class="btn newsletter-close-btn"><i class="fal fa-times"></i></button>
                    <div class="img-holder">
                        <img src="assets/img/bg/newsletter.jpg" alt>
                    </div>
                    <div class="details">
                        <h4>Get 45% discount shipped to your inbox</h4>
                        <p>Subscribe to the radios eCommerce newsletter to receive timely updates to your favorite products</p>
                        <form>
                            <div>
                                <input type="email" placeholder="Enter your email" />
                                <button type="submit">Subscribe</button>
                            </div>
                            <div>
                                <label class="checkbox-holder"> Don't show this popup again!
                                    <input type="checkbox" class="show-message">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </section>
        <!-- end newsletter-popup-area-section -->  


        <!-- start cookies-area -->    
        <div class="cookies-area">
            <p> This website uses cookies to improve your experience. By using this website you agree to our <a href="#">Data Protection Policy</a>. </p>
            <a href="#" class="read-more">Read more</a>
            <div>
                <button class="cookie-btn">Accept</button>
            </div>
        </div>
        <!-- end cookies-area -->


    </div>

    <!-- jquery include -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/backToTop.js"></script>
    <script src="assets/js/uikit.min.js"></script>
    <script src="assets/js/resize-sensor.min.js"></script>
    <script src="assets/js/theia-sticky-sidebar.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jqueryui.js"></script>
    <script src="assets/js/touchspin.js"></script>
    <script src="assets/js/countdown.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/main.js"></script>
	<script src="assets/js/upload-product.js"></script>
</body>

</html>
