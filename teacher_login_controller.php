
<?php
session_start();
require_once 'connect.php';

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM `teacher` WHERE `username` = ? AND `password` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $num = $result->num_rows;
        if ($num > 0) {
            $login = 1;
            $row = $result->fetch_assoc();
            $_SESSION['unique_int'] = $row['unique_int'];
            $_SESSION['username'] = $username;
            header('Location: teacher_home.php');
            exit();
        } else {
            $invalid = 1;
        }
    }
}

