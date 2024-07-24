<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: mentor-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "UPDATE mentors SET email='$email', phone='$phone', address='$address' WHERE username='{$_SESSION['username']}'";
    mysqli_query($conn, $query);

    echo "Data updated successfully!";
}

$query = "SELECT email, phone, address FROM mentors WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($conn, $query);
$mentor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Update Personal Data</h1>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $mentor['email']; ?>" required>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo $mentor['phone']; ?>" required>
            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $mentor['address']; ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
