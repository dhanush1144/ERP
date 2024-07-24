<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$query = "SELECT s.id, s.name, s.email, s.department, s.class FROM students s JOIN mentors m ON s.mentor_id = m.id WHERE m.username = '{$_SESSION['username']}'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Mentees</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Mentees</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['class']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
