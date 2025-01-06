<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'] ?? null;

    if ($userType) {
        switch ($userType) {
            case 'student':
                header('Location: student_sign.php');
                exit;
            case 'teacher':
                header('Location: teacher_sign.php');
                exit;
        }
    }
}
?>
