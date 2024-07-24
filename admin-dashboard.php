<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin-login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <nav>
            <a href="view-department-reports.php">View Department Reports</a>
            <a href="manage-hods.php">Manage HoDs</a>
            <a href="manage-faculty.php">Manage Faculty</a>
            <a href="make-announcement.php">Make Announcement</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>
