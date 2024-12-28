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
                include 'assets/includes/admin-header.php';
            ?>
        <!-- header end -->

        <!-- slide-bar start -->
            <?php
                include 'assets/includes/admin-slide-bar.php';
            ?>
        <!-- slide-bar end -->

        <main>
            <!-- admin-dashboard-area start -->
            <section class="admin-dashboard-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="admin-dashboard-sidebar">
                                <div class="admin-dashboard-sidebar-header">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="admin-dashboard-sidebar-body">
                                    <ul>
                                        <li><a href="admin_dashboard.php">Dashboard</a></li>
                                        <li><a href="admin_products.php">Products</a></li>
                                        <li><a href="admin_orders.php">Orders</a></li>
                                        <li><a href="admin_customers.php">Customers</a></li>
                                        <li><a href="admin_reports.php">Reports</a></li>
                                        <li><a href="admin_settings.php">Settings</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="admin-dashboard-content">
                                <div class="admin-dashboard-content-header">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="admin-dashboard-content-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="admin-dashboard-card">
                                                <div class="admin-dashboard-card-header">
                                                    <h4>Products</h4>
                                                </div>
                                                <div class="admin-dashboard-card-body">
                                                    <h2>120</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="admin-dashboard-card">
                                                <div class="admin-dashboard-card-header">
                                                    <h4>Orders</h4>
                                                </div>
                                                <div class="admin-dashboard-card-body">
                                                    <h2>50</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="admin-dashboard-card">
                                                <div class="admin-dashboard-card-header">
                                                    <h4>Customers</h4>
                                                </div>
                                                <div class="admin-dashboard-card-body">
                                                    <h2>100</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-dashboard-chart">
                                        <canvas id="admin-dashboard-chart"></canvas>
                                    </div>
                                </div>

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