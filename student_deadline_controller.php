
<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: student_login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch student ID
$sql_st_id = "SELECT st_id FROM student WHERE username = ?";
$stmt_st_id = $con->prepare($sql_st_id);
$stmt_st_id->bind_param("s", $username);
$stmt_st_id->execute();
$result_st_id = $stmt_st_id->get_result();

if ($result_st_id->num_rows > 0) {
    $row = $result_st_id->fetch_assoc();
    $st_id = $row['st_id'];
    $_SESSION["st_id"] = $st_id;
} else {
    header("Location: student_login.php");
    exit();
}

function getCourses($con, $st_id)
{
    $sql_courses = "SELECT course_code FROM course WHERE st_id = ?";
    $stmt_courses = $con->prepare($sql_courses);
    $stmt_courses->bind_param("i", $st_id);
    $stmt_courses->execute();
    $result_courses = $stmt_courses->get_result();

    $courses = [];
    while ($row = $result_courses->fetch_assoc()) {
        $courses[] = "'" . $row['course_code'] . "'";
    }
    return $courses;
}

function fetchStudentDeadlines($con, $courses)
{
    if (empty($courses)) {
        echo "<tr><td colspan='4'>You are not enrolled in any courses</td></tr>";
        return;
    }

    $courseCodesString = implode(",", $courses);
    $currentDateTime = date("Y-m-d H:i:s");

    $sql_deadlines = "SELECT * FROM deadline WHERE course_code IN ($courseCodesString) AND CONCAT(date, ' ', time) >= ? ORDER BY CONCAT(date, ' ', time) ASC";
    $stmt_deadlines = $con->prepare($sql_deadlines);
    $stmt_deadlines->bind_param("s", $currentDateTime);
    $stmt_deadlines->execute();
    $result_deadlines = $stmt_deadlines->get_result();

    if ($result_deadlines->num_rows > 0) {
        while ($row = $result_deadlines->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['course_code'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No upcoming deadlines</td></tr>";
    }
}
?>
