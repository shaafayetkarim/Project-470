<?php
require_once 'connect.php';

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM `student` WHERE `username` = ? AND `password` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $login = 1;
        session_start();

        $session_lifetime = 60 * 60 * 24 * 7;
        session_set_cookie_params($session_lifetime);
        session_regenerate_id(true);

        $_SESSION['username'] = $username;
        header('Location: ./student_home.php');
    } else {
        $invalid = 1;
    }

    $stmt->close();
    $con->close();
}
