<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: admin-login.html');
    exit();
}

$query = "SELECT department, COUNT(*) as total_students FROM students GROUP BY department";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Department Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Department Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Total Students</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['total_students']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="admin-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
