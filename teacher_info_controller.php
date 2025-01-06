
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: teacher_login.php");
    exit();
}

require_once 'connect.php';

$username = $_SESSION["username"];

$sql = "SELECT * FROM teacher WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$userData = $result->num_rows > 0 ? $result->fetch_assoc() : null;

$con->close();
