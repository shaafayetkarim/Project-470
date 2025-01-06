
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: teacher_login.php");
    exit();
}

$username = $_SESSION["username"];
