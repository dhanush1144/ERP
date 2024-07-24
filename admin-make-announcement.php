<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: admin-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $receiver_type = $_POST['receiver_type'];
    $query = "INSERT INTO announcements (sender_id, receiver_type, message) VALUES ((SELECT id FROM admin WHERE username='{$_SESSION['username']}'), '$receiver_type', '$message')";
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
            <label for="receiver_type">Receiver Type:</label>
            <select name="receiver_type" required>
                <option value="student">Students</option>
                <option value="faculty">Faculty</option>
                <option value="hod">HoDs</option>
            </select>
            <button type="submit">Submit Announcement</button>
        </form>
        <a href="admin-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
