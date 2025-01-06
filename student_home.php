<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Information</title>
    <style>
       
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('login.jpg');
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
            background-color: #f0f0f0;
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
        .title {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            left: 20px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="title">Studex Fusion</div>
    <div class="container">
        <?php
        session_start();

        
        if (!isset($_SESSION["username"])) {
            header("Location: student_login.php"); 
            exit();
        }

        
        echo "<div class='welcome-message'>Welcome, " . $_SESSION["username"] .'!!!'. "</div>";
        echo 'Student Dashboard';
        
        include './controllers/connect.php';
        ?>
        <div class="image-container">
            <img src="logo1.jpg" alt="Image">
        </div>
        <div class="menu-container">
            <ul class="menu">
                <li><a href="stu_info.php">Info</a></li>
                <li><a href="student_course.php">Course</a></li>
                <li><a href="student_contact.php">Contact</a></li>
                <li><a href="student_deadline.php">Deadline</a></li>
                <li><a href="marks.php">Marks</a></li> <!-- Marks section -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="footer">Made with VSCode</div>
</body>
</html>
