
<?php
session_start();
require_once 'connect.php'; // Adjust the path as needed

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: student_login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user data
$username = $_SESSION["username"];
$sql = "SELECT * FROM student WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$userData = [];
$totalCredit = 0;

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $totalCredit = $userData["course_count"] * 3; // Calculate total credit
}

$con->close();
?>
