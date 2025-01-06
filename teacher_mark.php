<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Marks</title>
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
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            color: #fff;
        }
        .remove-button {
            background-color: #ff3333;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include './controllers/teacher_marks_controller.php'; ?>
    <div class="container">
        <h1>Update Student Marks</h1>
        <form method="post">
            <label>Select Course Code:</label>
            <select name="course_code">
                <?php foreach ($enrolled_course_codes as $course_code): ?>
                    <option value="<?= $course_code ?>"><?= $course_code ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <label>Select Student ID:</label>
            <input type="text" name="st_id">
            <br><br>
            <label>Select Mark Type:</label>
            <select name="mark_type">
                <option value="quiz">Quiz</option>
                <option value="mid">Mid</option>
                <option value="assignment">Assignment</option>
                <option value="attendance">Attendance</option>
                <option value="final">Final</option>
            </select>
            <br><br>
            <label>Enter Mark:</label>
            <input type="text" name="mark">
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php if ($marks_result): ?>
            <h1>Student Marks for Course Code: <?= htmlspecialchars($selected_course_code) ?></h1>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Quiz</th>
                    <th>Mid</th>
                    <th>Assignment</th>
                    <th>Attendance</th>
                    <th>Final</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $marks_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['st_id'] ?></td>
                        <td><?= $row['quiz'] ?></td>
                        <td><?= $row['mid'] ?></td>
                        <td><?= $row['assignment'] ?></td>
                        <td><?= $row['attendance'] ?></td>
                        <td><?= $row['final'] ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="remove_st_id" value="<?= $row['st_id'] ?>">
                                <input type="hidden" name="remove_course_code" value="<?= $selected_course_code ?>">
                                <input type="submit" class="remove-button" name="remove" value="Remove Mark">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="container" style="color: white;">
        <a href="teacher_home.php" style="color: white; text-decoration: none;">Dashboard</a>
    </div>
</body>
</html>
