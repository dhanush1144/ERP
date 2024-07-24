<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$query = "SELECT s.id, s.name, a.date, a.status FROM attendance a JOIN students s ON a.student_id = s.id JOIN mentors m ON s.mentor_id = m.id WHERE m.username = '{$_SESSION['username']}' ORDER BY a.date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Attendance Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
