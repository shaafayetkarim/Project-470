<?php
include './controllers/teacher_contacts_controller.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Contacts</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #fff;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #fff;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Contacts</h1>

        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php elseif (empty($teacherCourses)): ?>
            <p>No courses enrolled.</p>
        <?php else: ?>
            <div class="enrolled-courses">
                <h2>Enrolled Courses:</h2>
                <table>
                    <tr>
                        <th>Course Code</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Email</th>
                    </tr>
                    <?php foreach ($teacherCourses as $course): ?>
                        <?php foreach ($course['students'] as $student): ?>
                            <tr>
                                <td><?= $course['course_code'] ?></td>
                                <td><?= $student['st_id'] ?></td>
                                <td><?= $student['name'] ?></td>
                                <td><?= $student['mail'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <div class="container" style="color: white;">
        <a href="teacher_home.php">Dashboard</a>
    </div>
</body>
</html>
