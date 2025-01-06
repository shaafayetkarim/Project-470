<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in Courses</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #334257;
            color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            text-align: center;
        }
        .course {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #1f2d3d;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .course-name {
            flex: 1;
            color: #fff;
        }
        .course-select {
            margin-left: 20px;
        }
        select {
            padding: 8px;
            font-size: 16px;
            color: black;
            border: none;
            border-radius: 5px;
            background-color: #fff;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .enrolled-courses {
            margin-top: 30px;
        }
        .enrolled-courses h2 {
            margin-bottom: 10px;
            text-align: center;
        }
        .enrolled-courses table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #fff;
        }
        .enrolled-courses th, .enrolled-courses td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #fff;
        }
        .enrolled-courses th {
            background-color: #f2f2f2;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enroll in Courses</h1>
        <?php
        include_once './controllers/student_course_controller.php';

        $st_id = getStudentId($con, $_SESSION["username"]);

        if (isset($_POST['enroll'])) {
            $selected_course = $_POST['selected_course'];
            if (checkSeatAvailability($con, $selected_course)) {
                enrollCourse($con, $st_id, $selected_course);
                echo "You have successfully enrolled in course: $selected_course";
            } else {
                echo "No available seats for the selected course.";
            }
        }

        if (isset($_POST['drop'])) {
            $dropped_course = $_POST['dropped_course'];
            dropCourse($con, $st_id, $dropped_course);
            echo "You have successfully dropped course: $dropped_course";
        }

        $available_courses = getAvailableCourses($con, $st_id);
        $enrolled_courses = getEnrolledCourses($con, $st_id);

        if ($available_courses->num_rows > 0) {
            echo "<form method='post'>";
            while ($row = $available_courses->fetch_assoc()) {
                echo "<div class='course'>";
                echo "<div class='course-name'>" . $row['name'] . " - " . $row['course_code'] . "</div>";
                echo "<div class='course-select'><input type='radio' name='selected_course' value='" . $row['course_code'] . "'></div>";
                echo "</div>";
            }
            echo "<input type='submit' name='enroll' value='Enroll'>";
            echo "</form>";
        } else {
            echo "No available courses with open seats.";
        }

        if ($enrolled_courses->num_rows > 0) {
            echo "<div class='enrolled-courses'>";
            echo "<h2>Enrolled Courses:</h2>";
            echo "<table>";
            echo "<tr><th>Course Code</th><th>Course Name</th><th>Action</th></tr>";
            while ($row = $enrolled_courses->fetch_assoc()) {
                echo "<tr><td>" . $row['course_code'] . "</td><td>" . $row['name'] . "</td>";
                echo "<td><form method='post'><input type='hidden' name='dropped_course' value='" . $row['course_code'] . "'>";
                echo "<input type='submit' name='drop' value='Drop'></form></td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='enrolled-courses'>";
            echo "<h2>Enrolled Courses:</h2>";
            echo "<p>No courses enrolled.</p>";
            echo "</div>";
        }

        $con->close();
        ?>
    </div>
    <div class="container" style="color: white;">
        <a href="student_home.php" style="color: white; text-decoration: none;">Dashboard</a>
    </div>
</body>
</html>
