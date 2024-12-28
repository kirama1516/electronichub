<?php

include "db/config.php"; // Ensure $pdo is properly initialized in db.php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        handleLogin($pdo);
    } else if (isset($_POST['signup'])) {
        handleSignUp($pdo);
    } else {
        header("Location: account.php?error=InvalidRequest");
        exit();
    }
}

/**
 * Handle user login.
 * @param PDO $pdo
 */
function handleLogin($pdo)
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // if (empty($email) || empty($password)) {
    //     header("Location: account.php?error=emptyfields");
    //     exit();
    // }

    try {
        $sql = "SELECT * FROM `Users` WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password_hash'])) {
                // Set session variables
                $_SESSION['userId'] = $row['user_id'];
                $_SESSION['userName'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Redirect based on role
                if ($row['role'] === 'admin') {
                    header("Location: admin-dashboard.php?login=success");
                } else {
                    header("Location: index.php?login=success");
                }
                exit();
            } else {
                header("Location: account.php?error=wrongPassword");
                exit();
            }
        } else {
            header("Location: account.php?error=noUser");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: account.php?error=sqlerror");
        exit();
    }
}

/**
 * Handle user sign-up.
 * @param PDO $pdo
 */
function handleSignUp($pdo)
{
    $username = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';
    $role = $_POST['role'] ?? 'user'; // Default role is 'user'


    // if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
    //     header("Location: account.php?error=emptyfields");
    //     exit();
    // }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: account.php?error=invalidEmail");
        exit();
    }

    if ($password !== $confirmpassword) {
        header("Location: account.php?error=passwordCheck");
        exit();
    }

    try {
        // Check if the email already exists
        $sql = "SELECT email FROM `Users` WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            header("Location: account.php?error=emailTaken");
            exit();
        }

        // Insert the new user
        $sql = "INSERT INTO `Users` (username, email, password_hash, role) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $hashPwd = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$username, $email, $hashPwd, $role]);

        header("Location: account.php?signin=success");
        exit();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: account.php?error=sqlerror S");
        exit();
    }
}

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
                            <li class="radiosbcrumb-item radiosbcrumb-begin">
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

            <!-- account start -->
            <section class="account pb-90">
                <div class="container">
                    <div class="row mt-none-30">
                        <div class="col-lg-6 mt-30">
                            <div class="account__wrap pr-60">
                                <h2 class="account__title">Sign Up</h2>
                                <form action="account.php" method="post">
                                    <input type="hidden" name="role" value="user">
                                    <div class="account__input-field">
                                        <label for="name">Your Name</label>
                                        <input id="name" name="name" type="text" placeholder="Enter your name*">
                                    </div>
                                    <div class="account__input-field">
                                        <label for="email">Email Address</label>
                                        <input id="email" name="email" type="email" placeholder="Enter Email Address">
                                    </div>
                                    <div class="account__input-field">
                                        <label for="password">New Password</label>
                                        <input id="password" name="password" type="text" placeholder="Create password">
                                    </div>
                                    <div class="account__input-field">
                                        <label for="password">Confirm password</label>
                                        <input id="password" name="confirmpassword" type="text" placeholder="Confirm password">
                                    </div>
                                    <div class="account__input-field">
                                        <input class="form-check-input" id="checkbox" type="checkbox">
                                        <label class="form-check-label" for="checkbox">I agree to al <a href="#!">Terms</a> & <a href="#!">Condition</a> and Feeds</label>
                                    </div>
                                    <div class="account__btn">
                                        <a class="thm-btn thm-btn__2" href="#">
                                            <span class="btn-wrap">
                                                <span><button type="submit" name="signup">Sign Up</button></span>
                                                <span><button type="submit" name="signup">Sign Up</button></span>
                                            </span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-30">
                            <div class="account__wrap pl-60">
                                <h2 class="account__title">Login here</h2>
                                <form action="#" method="post">
                                    <div class="account__input-field">
                                        <label for="lemail">Email Address</label>
                                        <input id="lemail" name="email" type="email" placeholder="Enter Email Address">
                                    </div>
                                    <div class="account__input-field">
                                        <label for="lpassword">Password</label>
                                        <input id="lpassword" name="password" type="text" placeholder="password">
                                    </div>
                                    <div class="account__input-field">
                                        <input class="form-check-input" id="lcheckbox" type="checkbox" checked>
                                        <label class="form-check-label" for="lcheckbox">Remember Me?</label>
                                    </div>
                                    <div class="account__btn">
                                        <a class="thm-btn thm-btn__2" href="#">
                                            <span class="btn-wrap">
                                            <span><button type="submit" name="login">Login</button></span>
                                            <span><button type="submit" name="login">Login</button></span>
                                            </span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- account end -->
            
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
</body>

</html>
