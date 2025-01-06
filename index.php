<?php
require_once './controllers/index_controller.php'; // Include the controller
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('index.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            color: black;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            text-align: center;
            color: white;
        }

        .title {
            font-size: 3em;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        input[type="radio"] {
            margin: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 20px;
            font-size: 1.1em;
        }

        a {
            color: #f0f0f0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }

        .bottom-center {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1em;
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .bottom-right {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 0.8em;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 5px;
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
    <div class="title">Studex Fusion</div>
    <div class="container">
        <?php if(isset($error_message)) echo "<div class='error-message'>$error_message</div>"; ?>
        <h1>Login</h1>
        <form action="index.php" method="post">
            <label>
                <input type="radio" name="user_type" value="student"> I'm a student
            </label>
            <br>
            <label>
                <input type="radio" name="user_type" value="teacher"> I'm a teacher
            </label>
            <br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
    
    <div class="bottom-center">
        This project is made for students and teachers to have a great interaction medium which is convenient for both of them. To keep track of things, 'Studex Fusion' will play a significant role. It will save a lot of time and accurately provide information to the teachers and students.
    </div>
    <div class="image-container">
        <img src="logo1.jpg" alt="Image">
    </div>
    
</body>
</html>
