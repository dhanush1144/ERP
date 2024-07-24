<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: student-login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <nav>
            <a href="view-attendance.php">View Attendance</a>
            <a href="view-marks.php">View Marks</a>
            <a href="view-announcements.php">View Announcements</a>
            <a href="contact-mentor.php">Contact Mentor</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>
