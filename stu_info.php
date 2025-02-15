<?php require_once './controllers/student_info_controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
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
        .total-credit {
            font-weight: bold;
            color: #ffc107;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        tr {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Information</h1>
        <?php if (!empty($userData)): ?>
            <table>
                <?php foreach ($userData as $key => $value): ?>
                    <tr>
                        <th><?php echo htmlspecialchars($key); ?></th>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-credit">
                    <th>Total Credit</th>
                    <td><?php echo $totalCredit; ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>No data found for the user.</p>
        <?php endif; ?>
    </div>
    <div class="container" style="color: white;">
        <a href="student_home.php" style="color: white; text-decoration: none;"> Dashboard</a>
    </div>
</body>
</html>
