<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: faculty-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {
    $video = $_FILES['video'];
    $videoPath = 'uploads/' . basename($video['name']);
    if (move_uploaded_file($video['tmp_name'], $videoPath)) {
        $query = "INSERT INTO videos (faculty_id, video_path) VALUES ((SELECT id FROM faculty WHERE username='{$_SESSION['username']}'), '$videoPath')";
        mysqli_query($conn, $query);

        echo "Video uploaded successfully!";
    } else {
        echo "Failed to upload video.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Videos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Upload Videos</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="video" accept="video/*" required>
            <button type="submit">Upload Video</button>
        </form>
        <a href="faculty-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
