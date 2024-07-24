<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: hod-login.html');
    exit();
}

$query = "SELECT s.id, s.name, m.subject, m.marks FROM marks m JOIN students s ON m.student_id = s.id ORDER BY m.subject";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Marks Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Marks Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['marks']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="hod-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
