<?php

session_start();


$_SESSION = array();


session_destroy();


header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; 
            color: #333; 
        }

       
        .logo-container {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 100px;
        }

        
        .logo {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        
        .logout-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        
        .logout-message {
            text-align: center;
            padding: 20px;
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
        }
    </style>
</head>
<body>
    
    <div class="logo-container">
        <img class="logo" src="logo.jpg" alt="Logo">
    </div>

    
    <div class="logout-container">
        <div class="logout-message">
            <h1>Logged Out Successfully</h1>
            <p>You have been successfully logged out. Redirecting you to the homepage...</p>
        </div>
    </div>
</body>
</html>
