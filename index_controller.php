

<?php
session_start();
require_once 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_type'])) {
        $userType = $_POST['user_type'];

        switch ($userType) {
            case 'student':
                header('Location: student_login.php');
                exit;
            case 'teacher':
                header('Location: teacher_login.php');
                exit;
            default:
                $error_message = "Please select an option to login.";
        }
    } else {
        $error_message = "Please select an option to login.";
    }
}
?>