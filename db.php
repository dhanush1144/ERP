<?php
$hostname = "sql109.infinityfree.com";
$username = "if0_36819352";
$password = "vo21urMdC2";
$dbname = "if0_36819352_erp_system";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
