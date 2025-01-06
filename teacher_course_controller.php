<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: teacher_login.php");
    exit();
}

$username = $_SESSION["username"];
$unique_int = $_SESSION["unique_int"];

$messages = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['enroll'])) {
        $selected_course = $_POST['course_code'];

        $sql_check_faculty = "SELECT * FROM t_course WHERE course_code = ?";
        $stmt_check_faculty = $con->prepare($sql_check_faculty);
        $stmt_check_faculty->bind_param("s", $selected_course);
        $stmt_check_faculty->execute();
        $result_check_faculty = $stmt_check_faculty->get_result();

        if ($result_check_faculty->num_rows == 0) {
            $sql_insert_course = "INSERT INTO t_course (unique_int, course_code) VALUES (?, ?)";
            $stmt_insert_course = $con->prepare($sql_insert_course);
            $stmt_insert_course->bind_param("ss", $unique_int, $selected_course);
            $stmt_insert_course->execute();

            $messages = "You have successfully enrolled as faculty in course: $selected_course.";
        } else {
            $messages = "This course already has a faculty.";
        }
    }

    if (isset($_POST['drop'])) {
        $dropped_course = $_POST['dropped_course'];

        $sql_drop_course = "DELETE FROM t_course WHERE unique_int = ? AND course_code = ?";
        $stmt_drop_course = $con->prepare($sql_drop_course);
        $stmt_drop_course->bind_param("ss", $unique_int, $dropped_course);
        $stmt_drop_course->execute();

        $messages = "You have successfully dropped course: $dropped_course.";
    }
}

$sql_enrolled_courses = "SELECT tc.course_code, ac.name FROM t_course tc
                         JOIN available_courses ac ON tc.course_code = ac.course_code
                         WHERE tc.unique_int = ?";
$stmt_enrolled_courses = $con->prepare($sql_enrolled_courses);
$stmt_enrolled_courses->bind_param("s", $unique_int);
$stmt_enrolled_courses->execute();
$result_enrolled_courses = $stmt_enrolled_courses->get_result();

$sql_available_courses = "SELECT * FROM available_courses 
                          WHERE course_code NOT IN 
                          (SELECT course_code FROM t_course WHERE unique_int = ?) 
                          AND seat > 0";
$stmt_available_courses = $con->prepare($sql_available_courses);
$stmt_available_courses->bind_param("s", $unique_int);
$stmt_available_courses->execute();
$result_available_courses = $stmt_available_courses->get_result();

$con->close();
?>
