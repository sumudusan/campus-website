<?php
session_start();
include 'db.php';

$registration_result = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $course = $_POST['course'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registration_result = "Username already exists. Please choose another.";
    } else {
        $sql = "INSERT INTO students (nic, name, address, tel, course, username, password) 
                VALUES ('$nic', '$name', '$address', '$tel', '$course', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $registration_result = "Registration successful. You can now <a href='index.php'>login</a>.";
        } else {
            $registration_result = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$title = "Register";
include 'header.php';
?>

<h2>Register</h2>
<form method="POST" action="">
    <input type="text" name="nic" placeholder="NIC" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="tel" placeholder="Tel" required>
    <input type="text" name="course" placeholder="Course" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Register">
</form>
<div class="message"><?php echo $registration_result; ?></div>
<p>Already have an account? <a href="index.php">Login here</a></p>


