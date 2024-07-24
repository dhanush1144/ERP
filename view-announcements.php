<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: student-login.html');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM announcements WHERE receiver_type='student' ORDER BY date DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Announcements</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Announcements</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="student-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
