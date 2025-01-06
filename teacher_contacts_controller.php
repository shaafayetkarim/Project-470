
<?php
session_start();
include 'connect.php';

$teacherCourses = [];
$error = '';

if (!isset($_SESSION["username"])) {
    header("Location: teacher_login.php");
    exit();
}

$username = $_SESSION["username"];

try {
    // Fetch unique_int for the teacher
    $sql = "SELECT unique_int FROM teacher WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $teacherData = $result->fetch_assoc();
        $unique_int = $teacherData['unique_int'];

        // Fetch enrolled courses for the teacher
        $sql_courses = "SELECT course_code FROM t_course WHERE unique_int = ?";
        $stmt_courses = $con->prepare($sql_courses);
        $stmt_courses->bind_param("s", $unique_int);
        $stmt_courses->execute();
        $result_courses = $stmt_courses->get_result();

        while ($course = $result_courses->fetch_assoc()) {
            $course_code = $course['course_code'];

            
            $sql_students = "SELECT s.st_id, s.name, s.mail 
                             FROM student s 
                             JOIN course c ON s.st_id = c.st_id 
                             WHERE c.course_code = ?";
            $stmt_students = $con->prepare($sql_students);
            $stmt_students->bind_param("s", $course_code);
            $stmt_students->execute();
            $result_students = $stmt_students->get_result();

            $students = [];
            while ($student = $result_students->fetch_assoc()) {
                $students[] = $student;
            }

            $teacherCourses[] = [
                'course_code' => $course_code,
                'students' => $students
            ];
        }
    } else {
        $error = 'Teacher information not found.';
    }
} catch (Exception $e) {
    $error = 'An error occurred: ' . $e->getMessage();
} finally {
    $con->close();
}
?>
