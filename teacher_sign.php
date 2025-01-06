<?php include './controllers/teacher_sign_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('new.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registration-box {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: white;
            max-width: 400px;
        }

        .title {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 1.5em;
            font-weight: bold;
            color: white;
        }

        .alert {
            margin-top: 20px;
        }

        label {
            display: block;
            text-align: left;
        }

        input {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        button:hover {
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
    <div class="title">Studex Fusion</div>

    <div class="registration-box">
        <h2>Teacher Registration</h2>

        <?php if ($user_exists): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> User already exists!
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> You have registered successfully. Redirecting...
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "../../index.php";
                }, 3000); 
            </script>
        <?php endif; ?>

        <form action="teacher_sign.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="Name" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="Username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>

            <label for="retype_password">Retype Password:</label>
            <input type="password" id="retype_password" name="retype_password" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="Mail" required>

            <label for="unique_int">Unique Initial:</label>
            <input type="text" id="unique_int" name="unique_int" required>

            <button type="submit">Register</button>
        </form>

        <p style="margin-top: 20px;">
            Already have an account? <a href="index.php" style="color: #f0f0f0;">Log in</a>
        </p>
    </div>
    <div class="image-container">
        <img src="logo.jpg" alt="Image">
    </div>
</body>
</html>
