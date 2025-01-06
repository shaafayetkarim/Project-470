
<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: teacher_login.php");
    exit();
}

$username = $_SESSION["username"];
$unique_int_query = "SELECT unique_int FROM teacher WHERE username = ?";
$stmt_unique_int = $con->prepare($unique_int_query);
$stmt_unique_int->bind_param("s", $username);
$stmt_unique_int->execute();
$unique_int_result = $stmt_unique_int->get_result();
$unique_int_row = $unique_int_result->fetch_assoc();
$unique_int = $unique_int_row['unique_int'];

$enrolled_course_codes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $course_code = $_POST['course_code'];
        $st_id = $_POST['st_id'];
        $mark_type = $_POST['mark_type'];
        $mark = $_POST['mark'];

        $enrollment_query = "SELECT COUNT(*) AS enrolled FROM t_course WHERE unique_int = ? AND course_code = ?";
        $stmt_enrollment = $con->prepare($enrollment_query);
        $stmt_enrollment->bind_param("is", $unique_int, $course_code);
        $stmt_enrollment->execute();
        $enrollment_result = $stmt_enrollment->get_result();
        $enrollment_row = $enrollment_result->fetch_assoc();
        $enrolled = $enrollment_row['enrolled'];

        if ($enrolled > 0) {
            $student_enrollment_query = "SELECT COUNT(*) AS enrolled FROM course WHERE st_id = ? AND course_code = ?";
            $stmt_student_enrollment = $con->prepare($student_enrollment_query);
            $stmt_student_enrollment->bind_param("is", $st_id, $course_code);
            $stmt_student_enrollment->execute();
            $student_enrollment_result = $stmt_student_enrollment->get_result();
            $student_enrollment_row = $student_enrollment_result->fetch_assoc();
            $student_enrolled = $student_enrollment_row['enrolled'];

            if ($student_enrolled > 0) {
                $update_query = "UPDATE mark SET $mark_type = ? WHERE st_id = ? AND course_code = ?";
                $stmt_update = $con->prepare($update_query);
                $stmt_update->bind_param("dis", $mark, $st_id, $course_code);
                $stmt_update->execute();
                $message = "Mark updated successfully!";
            } else {
                $message = "The student is not enrolled in the selected course code.";
            }
        } else {
            $message = "You are not enrolled in the selected course code.";
        }
    } elseif (isset($_POST['remove'])) {
        $remove_st_id = $_POST['remove_st_id'];
        $remove_course_code = $_POST['remove_course_code'];
        $remove_query = "DELETE FROM mark WHERE st_id = ? AND course_code = ?";
        $stmt_remove = $con->prepare($remove_query);
        $stmt_remove->bind_param("is", $remove_st_id, $remove_course_code);
        $stmt_remove->execute();
        $message = "Mark removed successfully!";
    }
}

$course_query = "SELECT course_code FROM t_course WHERE unique_int = ?";
$stmt_course = $con->prepare($course_query);
$stmt_course->bind_param("s", $unique_int);
$stmt_course->execute();
$course_result = $stmt_course->get_result();

while ($row = $course_result->fetch_assoc()) {
    $enrolled_course_codes[] = $row['course_code'];
}

$marks_result = null;
if (isset($_POST['course_code'])) {
    $selected_course_code = $_POST['course_code'];
    $marks_query = "SELECT * FROM mark WHERE course_code = ?";
    $stmt_marks = $con->prepare($marks_query);
    $stmt_marks->bind_param("s", $selected_course_code);
    $stmt_marks->execute();
    $marks_result = $stmt_marks->get_result();
}
$con->close();
?>
