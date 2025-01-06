
<?php
session_start();
include 'connect.php';

// Redirect if user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: student_login.php");
    exit();
}

// Get student ID
function getStudentId($con, $username) {
    $sql = "SELECT st_id FROM student WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc()['st_id'] : null;
}

// Check seat availability
function checkSeatAvailability($con, $course_code) {
    $sql = "SELECT seat FROM available_courses WHERE course_code = ? AND seat > 0";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}

// Enroll in a course
function enrollCourse($con, $st_id, $course_code) {
    // Update available seats
    $sql_update_seats = "UPDATE available_courses SET seat = seat - 1 WHERE course_code = ?";
    $stmt_update_seats = $con->prepare($sql_update_seats);
    $stmt_update_seats->bind_param("s", $course_code);
    $stmt_update_seats->execute();

    // Insert into course table
    $sql_insert_course = "INSERT INTO course (st_id, course_code) VALUES (?, ?)";
    $stmt_insert_course = $con->prepare($sql_insert_course);
    $stmt_insert_course->bind_param("is", $st_id, $course_code);
    $stmt_insert_course->execute();

    // Insert into mark table
    $sql_insert_mark = "INSERT INTO mark (st_id, course_code, quiz, assignment, mid, final, attendance) 
                        VALUES (?, ?, 0, 0, 0, 0, 0)";
    $stmt_insert_mark = $con->prepare($sql_insert_mark);
    $stmt_insert_mark->bind_param("is", $st_id, $course_code);
    $stmt_insert_mark->execute();
}

// Drop a course
function dropCourse($con, $st_id, $course_code) {
    // Update available seats
    $sql_update_seats = "UPDATE available_courses SET seat = seat + 1 WHERE course_code = ?";
    $stmt_update_seats = $con->prepare($sql_update_seats);
    $stmt_update_seats->bind_param("s", $course_code);
    $stmt_update_seats->execute();

    // Remove from course table
    $sql_delete_course = "DELETE FROM course WHERE st_id = ? AND course_code = ?";
    $stmt_delete_course = $con->prepare($sql_delete_course);
    $stmt_delete_course->bind_param("is", $st_id, $course_code);
    $stmt_delete_course->execute();

    // Remove from mark table
    $sql_delete_mark = "DELETE FROM mark WHERE st_id = ? AND course_code = ?";
    $stmt_delete_mark = $con->prepare($sql_delete_mark);
    $stmt_delete_mark->bind_param("is", $st_id, $course_code);
    $stmt_delete_mark->execute();
}

// Fetch available courses
function getAvailableCourses($con, $st_id) {
    $sql = "SELECT * FROM available_courses 
            WHERE course_code NOT IN 
            (SELECT course_code FROM course WHERE st_id = ?) 
            AND seat > 0";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $st_id);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch enrolled courses
function getEnrolledCourses($con, $st_id) {
    $sql = "SELECT c.course_code, ac.name FROM course c
            JOIN available_courses ac ON c.course_code = ac.course_code
            WHERE c.st_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $st_id);
    $stmt->execute();
    return $stmt->get_result();
}
?>
