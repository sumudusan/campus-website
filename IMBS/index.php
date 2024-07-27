<?php
session_start();
include 'db.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        $error_message = "Invalid username or password. Please try again or register.";
    }
}

$title = "Login";
include 'header.php';
?>

<h2>Login</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
</form>
<div class="message"><?php echo $error_message; ?></div>
<p >Don't have an account? <a href="register.php">Register here</a></p>






