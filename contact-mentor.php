<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: student-login.html');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT mentor_id FROM students WHERE username='$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$mentor_id = $row['mentor_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $insertQuery = "INSERT INTO messages (sender_id, receiver_id, message, date) VALUES ((SELECT id FROM students WHERE username='$username'), $mentor_id, '$message', NOW())";
    mysqli_query($conn, $insertQuery);
    echo "Message sent successfully!";
}

$mentorQuery = "SELECT * FROM faculty WHERE id=$mentor_id";
$mentorResult = mysqli_query($conn, $mentorQuery);
$mentor = mysqli_fetch_assoc($mentorResult);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Mentor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Contact Mentor</h1>
        <h2>Mentor: <?php echo $mentor['name']; ?></h2>
        <form method="post">
            <textarea name="message" placeholder="Type your message here" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <a href="student-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
