<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll as Faculty</title>
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
        <h1>Enroll as Faculty</h1>
        <?php include './controllers/teacher_course_controller.php'; ?>

        <?php if (!empty($messages)): ?>
            <p><?= $messages; ?></p>
        <?php endif; ?>

        <h2>Available Courses</h2>
        <?php if ($result_available_courses->num_rows > 0): ?>
            <form method="post">
                <?php while ($row = $result_available_courses->fetch_assoc()): ?>
                    <div class="course">
                        <div class="course-name"><?= $row['name'] . " - " . $row['course_code']; ?></div>
                        <input type="radio" name="selected_course" value="<?= $row['course_code']; ?>">
                    </div>
                <?php endwhile; ?>
                <input type="submit" name="enroll" value="Enroll">
            </form>
        <?php else: ?>
            <p>No available courses without faculty.</p>
        <?php endif; ?>

        <h2>Enrolled Courses</h2>
        <?php if ($result_enrolled_courses->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result_enrolled_courses->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['course_code']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="dropped_course" value="<?= $row['course_code']; ?>">
                                <input type="submit" name="drop" value="Drop">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No courses enrolled as faculty.</p>
        <?php endif; ?>
    </div>
    <div class="container" style="color: white;">
        <a href="teacher_home.php" style="color: white; text-decoration: none;"> Dashboard</a>
    </div>
</body>
</html>
