<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: faculty-login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <nav>
            <a href="take-attendance.php">Take Attendance</a>
            <a href="upload-marks.php">Upload Marks</a>
            <a href="view-assignments.php">View Assignments</a>
            <a href="make-announcement.php">Make Announcement</a>
            <a href="upload-videos.php">Upload Videos</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>
