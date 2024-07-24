<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $type = $_POST['type'];
    $reason = $_POST['reason'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $query = "INSERT INTO permissions (student_id, type, reason, start_date, end_date, approved_by) VALUES ('$student_id', '$type', '$reason', '$start_date', '$end_date', (SELECT id FROM mentors WHERE username='{$_SESSION['username']}'))";
    mysqli_query($conn, $query);

    echo "Permission granted successfully!";
}

$query = "SELECT id, name FROM students WHERE mentor_id = (SELECT id FROM mentors WHERE username='{$_SESSION['username']}')";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Leave/Permission/On Duty</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Provide Leave/Permission/On Duty</h1>
        <form method="post">
            <label for="student_id">Select Student:</label>
            <select name="student_id" required>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <label for="type">Type:</label>
            <select name="type" required>
                <option value="leave">Leave</option>
                <option value="permission">Permission</option>
                <option value="on_duty">On Duty</option>
            </select>
            <label for="reason">Reason:</label>
            <textarea name="reason" required></textarea>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" required>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" required>
            <button type="submit">Submit</button>
        </form>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
