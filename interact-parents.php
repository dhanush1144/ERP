<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: mentor-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parent_id = $_POST['parent_id'];
    $message = $_POST['message'];
    $query = "INSERT INTO messages (sender_id, receiver_type, message) VALUES ((SELECT id FROM mentors WHERE username='{$_SESSION['username']}'), 'parent', '$message')";
    mysqli_query($conn, $query);

    echo "Message sent successfully!";
}

$query = "SELECT p.id, p.name FROM parents p JOIN students s ON p.student_id = s.id JOIN mentors m ON s.mentor_id = m.id WHERE m.username = '{$_SESSION['username']}'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interact with Parents</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Interact with Parents</h1>
        <form method="post">
            <label for="parent_id">Select Parent:</label>
            <select name="parent_id" required>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <textarea name="message" placeholder="Type your message here" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <a href="mentor-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
