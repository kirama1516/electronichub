<?php

include "db/config.php"; // Ensure $pdo is properly initialized in db.php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        handleLogin($pdo);
    } else if (isset($_POST['signup'])) {
        handleSignUp($pdo);
    } else {
        header("Location: admin.php?error=InvalidRequest");
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

//     if (empty($email) || empty($password)) {
//         header("Location: account.php?error=emptyfields");
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
        header("Location: admin.php?error=wrongPassword");
        exit();
    }
} else {
    header("Location: admin.php?error=noUser");
    exit();
}
} catch (PDOException $e) {
error_log("Error: " . $e->getMessage());
header("Location: admin.php?error=sqlerror");
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

// if (empty($username) || empty($email) || empty($password) || empty($confirmpassword) || empty($role)){
//     header("Location: admin.php?error=emptyfields");
//     exit();
// }

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
header("Location: admin.php?error=invalidEmail");
exit();
}

if ($password !== $confirmpassword) {
header("Location: admin.php?error=passwordCheck");
exit();
}

try {
// Check if the email already exists
$sql = "SELECT email FROM `Users` WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    header("Location: admin.php?error=emailTaken");
    exit();
}

// Insert the new user
$sql = "INSERT INTO `Users` (username, email, password_hash, role) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$hashPwd = password_hash($password, PASSWORD_DEFAULT);
$stmt->execute([$username, $email, $hashPwd, $role]);

header("Location: admin.php?signin=success");
exit();
} catch (PDOException $e) {
error_log("Error: " . $e->getMessage());
header("Location: admin.php?error=sqlerror");
exit();
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title>Kict Website</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="images/x-icon"/>
    
</head>

<body>
    <div class="countainer">
        <!-- <h1>
            <b>KICT</b><sup>experience IT</sup>
        </h1>
        <h2>KNOW IT ICT LTD. </h2>
        <address>
            ADD: No. 23 Albarka Plaza,Justice Dahiru Mustapha Avenue Farm Center Kano.<br>
            Phone No.:08034099090,08095743914,08038933443. Email:knowitict@gmail.com. Google:kict.online.
        </address>
    </div> -->

    <div class="glass">
        <div class="form-box login">
            <!-- <a href="#">
                <span class="icon-close"><ion-icon name="close">✖</ion-icon></span>
            </a><br> -->
            <b>LOGIN</b>
            <form action="admin.php" method="post">
                <div class="input-box">
                    <span class="icon">
                        <!-- <ion-icon name="username">🧑🏻</ion-icon> -->
                    </span>
                    <input type="text" name="email" id="usermail">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password">
                    <label>Password</label>
                </div>
                <br>
                <div class="remember">
                    <label><input type="checkbox">Remember me</label>
                    <a href="forgot-password.php">
                        Forgot Password?
                    </a>
                </div>
                <br>
                <div>
                    <input type="submit" name="login" class="rcorners" value="Login">
                </div>
                <div class="login-register">
                    <p>If you don't have an account?<a href="#" class="register-link">Sign up</a></p>
                </div>
            </form>
        </div>


        <div class="form-box register">
            <b>Register</b>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="role" value="admin">
                 <div class="input-box">
                    <span class="icon">
                        <!-- <ion-icon name="username" id="username">🧑🏻</ion-icon> -->
                    </span>
                    <input type="text" name="username">
                    <label>username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <!-- <ion-icon name="email">🧑🏻</ion-icon> -->
                    </span>
                    <input type="text" name="email" id="email">
                    <label>email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <!-- <ion-icon name="lock-closed">🔒</ion-icon> -->
                    </span>
                    <input type="password" name="password" id="password">
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <!-- <ion-icon name="lock-closed">🔒</ion-icon> -->
                    </span>
                    <input type="password" name="confirmpassword" id="confirmpassword">
                    <label>Confirm password</label>
                </div>
                <div class="input-image">
                    <span class="icon">
                        <!-- <ion-icon name="image">🧑🏻</ion-icon> -->
                    </span>
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <label for="file">Upload image</label>
                </div>
                <br>
                <div class="remember">
                    <label><input type="checkbox">I agree to the terms & conditions</label>
                </div>
                <div>
                    <input type="submit" name="signup" class="rcorners" value="Sign Up">
                </div>
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>

</html>