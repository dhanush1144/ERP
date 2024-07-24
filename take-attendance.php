<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: faculty-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $attendance = $_POST['attendance']; // Array of student_id => status

    foreach ($attendance as $student_id => $status) {
        $query = "INSERT INTO attendance (student_id, date, status) VALUES ($student_id, '$date', '$status')";
        mysqli_query($conn, $query);
    }

    echo "Attendance taken successfully!";
}

// Fetch students from the same department as the faculty
$username = $_SESSION['username'];
$query = "SELECT department FROM faculty WHERE username='$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$department = $row['department'];

$studentsQuery = "SELECT * FROM students WHERE department='$department'";
$studentsResult = mysqli_query($conn, $studentsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Take Attendance</h1>
        <form method="post">
            <label for="date">Date:</label>
            <input type="date" name="date" required>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = mysqli_fetch_assoc($studentsResult)) { ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="present" required></td>
                            <td><input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="absent" required></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button type="submit">Submit Attendance</button>
        </form>
        <a href="faculty-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
