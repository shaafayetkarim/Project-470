
<?php
session_start();

require_once 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch student ID
$st_id_query = "SELECT st_id FROM student WHERE username = ?";
$stmt_st_id = $con->prepare($st_id_query);
$stmt_st_id->bind_param("s", $username);
$stmt_st_id->execute();
$result_st_id = $stmt_st_id->get_result();
$st_id_row = $result_st_id->fetch_assoc();
$st_id = $st_id_row['st_id'] ?? null;

$marks_data = [];

if ($st_id) {
    // Fetch unique course codes for the student
    $course_code_query = "SELECT DISTINCT course_code FROM mark WHERE st_id = ?";
    $stmt_courses = $con->prepare($course_code_query);
    $stmt_courses->bind_param("i", $st_id);
    $stmt_courses->execute();
    $course_code_result = $stmt_courses->get_result();

    // Retrieve marks for each course
    while ($course_code_row = $course_code_result->fetch_assoc()) {
        $course_code = $course_code_row['course_code'];

        $marks_query = "SELECT * FROM mark WHERE st_id = ? AND course_code = ?";
        $stmt_marks = $con->prepare($marks_query);
        $stmt_marks->bind_param("is", $st_id, $course_code);
        $stmt_marks->execute();
        $marks_result = $stmt_marks->get_result();

        $course_marks = [];
        while ($row = $marks_result->fetch_assoc()) {
            $total_marks = $row['quiz'] + $row['mid'] + $row['assignment'] + $row['attendance'] + $row['final'];
            $course_marks[] = [
                'quiz' => $row['quiz'],
                'mid' => $row['mid'],
                'assignment' => $row['assignment'],
                'attendance' => $row['attendance'],
                'final' => $row['final'],
                'total' => $total_marks
            ];
        }

        $marks_data[$course_code] = $course_marks;
    }
}

$con->close();
?>
