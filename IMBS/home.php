<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$title = "Home";
include 'header.php';
?>

<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
<div class="links">
    <a href="register.php">Register Students</a>
    <a href="search.php">Search Students</a>
</div>


