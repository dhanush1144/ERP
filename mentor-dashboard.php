<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <div class="dashboard-links">
            <a href="view-mentees.php">View Mentees</a>
            <a href="view-mattendance.php">View Attendance Reports</a>
            <a href="update-personal-data.php">Update Personal Data</a>
            <a href="make-mannouncement.php">Make Announcement</a>
            <a href="interact-parents.php">Interact with Parents</a>
            <a href="provide-permission.php">Provide Leave/Permission/On Duty</a>
        </div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
