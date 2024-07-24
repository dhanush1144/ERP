<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: mentor-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $query = "INSERT INTO announcements (sender_id, receiver_type, message) VALUES ((SELECT id FROM mentors WHERE username='{$_SESSION['username']}'), 'mentee', '$message')";
    mysqli_query($conn, $query);

    echo "Announcement made successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Announcement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Make Announcement</h1>
        <form method="post">
            <textarea name="message" placeholder="Type your announcement here" required></textarea>
            <button type="submit">Submit Announcement</button>
        </form>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
