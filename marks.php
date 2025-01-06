<?php require_once './controllers/student_marks_controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks</title>
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
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            color: #fff;
        }
        tr {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($marks_data): ?>
        <?php foreach ($marks_data as $course_code => $course_marks): ?>
            <h1>Student Marks for Course Code: <?= htmlspecialchars($course_code) ?></h1>
            <table border="1">
                <tr>
                    <th>Quiz</th>
                    <th>Mid</th>
                    <th>Assignment</th>
                    <th>Attendance</th>
                    <th>Final</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($course_marks as $marks): ?>
                    <tr>
                        <td><?= htmlspecialchars($marks['quiz']) ?></td>
                        <td><?= htmlspecialchars($marks['mid']) ?></td>
                        <td><?= htmlspecialchars($marks['assignment']) ?></td>
                        <td><?= htmlspecialchars($marks['attendance']) ?></td>
                        <td><?= htmlspecialchars($marks['final']) ?></td>
                        <td><?= htmlspecialchars($marks['total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No Marks Available</h1>
    <?php endif; ?>
</div>
<div class="container" style="color: white;">
    <a href="student_home.php" style="color: white; text-decoration: none;"> Dashboard</a>
</div>
</body>
</html>
