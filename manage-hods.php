<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: admin-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $department = $_POST['department'];

        $query = "INSERT INTO hod (name, username, password, department) VALUES ('$name', '$username', '$password', '$department')";
        mysqli_query($conn, $query);

        echo "HoD added successfully!";
    } elseif (isset($_POST['delete'])) {
        $hod_id = $_POST['hod_id'];
        $query = "DELETE FROM hod WHERE id=$hod_id";
        mysqli_query($conn, $query);

        echo "HoD deleted successfully!";
    }
}

$query = "SELECT * FROM hod";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage HoDs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Manage HoDs</h1>
        <h2>Add HoD</h2>
        <form method="post">
            <input type="hidden" name="add" value="1">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <label for="department">Department:</label>
            <input type="text" name="department" required>
            <button type="submit">Add HoD</button>
        </form>

        <h2>Delete HoD</h2>
        <form method="post">
            <input type="hidden" name="delete" value="1">
            <label for="hod_id">Select HoD:</label>
            <select name="hod_id" required>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Delete HoD</button>
        </form>

        <a href="admin-dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
