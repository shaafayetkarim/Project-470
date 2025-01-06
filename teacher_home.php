<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../../login.jpg');
            background-size: cover;
            color: #000;
            position: relative;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .welcome-message {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .menu-container {
            width: 70%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            margin-top: 20px;
        }
        .menu {
            list-style-type: none;
            padding: 0;
            font-size: 20px;
        }
        .menu li {
            margin-bottom: 10px;
        }
        .menu li a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu li a:hover {
            background-color: #ddd;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            left: 20px;
            font-size: 14px;
            color: #333;
        }
        .image-container {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 200px;
            height: auto;
            border-radius: 10px;
            overflow: hidden;
        }
        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php include './controllers/teacher_home_controller.php'; ?>
    <div class="container">
        <div class='welcome-message'>Welcome, <?= htmlspecialchars($username); ?>!!!</div>
        <div class="title">Teacher Dashboard</div>
        <div class="image-container">
            <img src="logo1.jpg" alt="Image">
        </div>
        <div class="menu-container">
            <ul class="menu">
                <li><a href="teacher_info.php">Info</a></li>
                <li><a href="teacher_course.php">Course</a></li>
                <li><a href="teacher_deadline.php">Set Deadline</a></li>
                <li><a href="teacher_contact.php">Contact</a></li>
                <li><a href="teacher_mark.php">Mark Assign</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="footer">Made with VSCode</div>
</body>
</html>
