<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: faculty-login.html');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM assignments WHERE faculty_id = (SELECT id FROM faculty WHERE username='$username')";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Assignments</h1>
        <table>
            <thead>
                <tr>
                    <th>Assignment ID</th>
                    <th>Title</th>
                    <th>Deadline</th>
                    <th>Submitted By</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['deadline']; ?></td>
                        <td>
                            <?php
                            $submissionsQuery = "SELECT * FROM submissions WHERE assignment_id={$row['id']}";
                            $submissionsResult = mysqli_query($conn, $submissionsQuery);
                            while ($submission = mysqli_fetch_assoc($submissionsResult)) {
                                echo $submission['student_id'] . " ";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="faculty-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
