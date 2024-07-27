<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'db.php';

$search_result = '';
$update_result = '';
$delete_result = '';

if (isset($_POST['search'])) {
    $nic = $_POST['nic'];
    $sql = "SELECT * FROM students WHERE nic='$nic'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $search_result = "
            <div class='result'>
                <h3>Student Details</h3>
                <p>NIC: " . $row['nic'] . "</p>
                <p>Name: " . $row['name'] . "</p>
                <p>Address: " . $row['address'] . "</p>
                <p>Tel: " . $row['tel'] . "</p>
                <p>Course: " . $row['course'] . "</p>
                <p>Username: " . $row['username'] . "</p>
            </div>
        ";
    } else {
        $search_result = "No student found with NIC: $nic";
    }
}

if (isset($_POST['update'])) {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $course = $_POST['course'];
    $username = $_POST['username'];

    $sql = "UPDATE students SET name='$name', address='$address', tel='$tel', course='$course', username='$username' WHERE nic='$nic'";
    if ($conn->query($sql) === TRUE) {
        $update_result = "Student details updated successfully.";
    } else {
        $update_result = "Error updating record: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $nic = $_POST['nic'];
    $sql = "DELETE FROM students WHERE nic='$nic'";
    if ($conn->query($sql) === TRUE) {
        $delete_result = "Student deleted successfully.";
    } else {
        $delete_result = "Error deleting record: " . $conn->error;
    }
}

$title = "Search Students";
include 'header.php';
?>

<h2>Search Student</h2>
<form method="POST" action="">
    <input type="text" name="nic" placeholder="Enter NIC" required>
    <input type="submit" name="search" value="Search">
</form>
<div class="message"><?php echo $search_result; ?></div>

<?php if (!empty($search_result) && strpos($search_result, 'No student found') === false): ?>
<div class="update-section">
    <h2>Update Student Details</h2>
    <form method="POST" action="">
        <input type="hidden" name="nic" value="<?php echo $row['nic']; ?>">
        <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required>
        <input type="text" name="address" placeholder="Address" value="<?php echo $row['address']; ?>" required>
        <input type="text" name="tel" placeholder="Tel" value="<?php echo $row['tel']; ?>" required>
        <input type="text" name="course" placeholder="Course" value="<?php echo $row['course']; ?>" required>
        <input type="text" name="username" placeholder="Username" value="<?php echo $row['username']; ?>" required>
        <input type="submit" name="update" value="Update">
    </form>
    <div class="message"><?php echo $update_result; ?></div>
</div>

<div class="delete-section">
    <h2>Delete Student</h2>
    <form method="POST" action="">
        <input type="hidden" name="nic" value="<?php echo $row['nic']; ?>">
        <input type="submit" name="delete" value="Delete">
    </form>
    <div class="message"><?php echo $delete_result; ?></div>
</div>
<?php endif; ?>


