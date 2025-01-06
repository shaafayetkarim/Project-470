<?php require_once './controllers/signup_controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Type Selection</title>
    <style>
        body {
            background-image: url('login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            color: white;
        }

        .signup-container h1 {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 20px;
            color: white;
            font-weight: bold;
        }

        form {
            text-align: left;
        }

        label, select, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        select {
            padding: 8px;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
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
    <div class="signup-container">
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST">
            <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <input type="submit" value="Sign Up">
        </form>
    </div>
    <div class="image-container">
        <img src="logo.jpg" alt="Image">
    </div>
</body>
</html>
