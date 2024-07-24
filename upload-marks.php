<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: faculty-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $marks = $_POST['marks']; // Array of student_id => marks

    foreach ($marks as $student_id => $mark) {
        $query = "INSERT INTO marks (student_id, subject, marks) VALUES ($student_id, '$subject', $mark)";
        mysqli_query($conn, $query);
    }

    echo "Marks uploaded successfully!";
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
    <title>Upload Marks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Upload Marks</h1>
        <form method="post">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" required>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = mysqli_fetch_assoc($studentsResult)) { ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><input type="number" name="marks[<?php echo $student['id']; ?>]" required></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button type="submit">Submit Marks</button>
        </form>
        <a href="faculty-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
