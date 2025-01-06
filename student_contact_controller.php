
<?php
session_start();
require_once 'connect.php'; // Adjust the path as necessary

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: student_login.php");
    exit();
}

// Fetch the student ID based on the username
$username = $_SESSION['username'];
$st_id_query = "SELECT st_id FROM student WHERE username = ?";
$stmt_st_id = $con->prepare($st_id_query);
$stmt_st_id->bind_param("s", $username);
$stmt_st_id->execute();
$st_id_result = $stmt_st_id->get_result();
$st_id_row = $st_id_result->fetch_assoc();
$st_id = $st_id_row['st_id'];

// Fetch the enrolled courses for the student
$course_query = "SELECT course_code FROM course WHERE st_id = ?";
$stmt_course = $con->prepare($course_query);
$stmt_course->bind_param("i", $st_id);
$stmt_course->execute();
$course_result = $stmt_course->get_result();

// Prepare data for the view
$courses = [];
while ($course_row = $course_result->fetch_assoc()) {
    $course_code = $course_row['course_code'];

    // Fetch teacher details for each course
    $teacher_query = "SELECT t.name AS teacher_name, t.mail AS teacher_mail
                      FROM teacher t
                      INNER JOIN t_course tc ON t.unique_int = tc.unique_int
                      WHERE tc.course_code = ?";
    $stmt_teacher = $con->prepare($teacher_query);
    $stmt_teacher->bind_param("s", $course_code);
    $stmt_teacher->execute();
    $teacher_result = $stmt_teacher->get_result();

    if ($teacher_result->num_rows > 0) {
        $teacher_row = $teacher_result->fetch_assoc();
        $courses[] = [
            'course_code' => $course_code,
            'teacher_name' => $teacher_row['teacher_name'],
            'teacher_email' => $teacher_row['teacher_mail']
        ];
    } else {
        $courses[] = [
            'course_code' => $course_code,
            'teacher_name' => "Info not available",
            'teacher_email' => "Info not available"
        ];
    }
}

$con->close();
