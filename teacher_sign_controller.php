
<?php
require_once 'connect.php';

$success = false;
$user_exists = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['Username'];
    $name = $_POST['Name'];
    $password = $_POST['Password'];
    $mail = $_POST['Mail'];
    $unique_int = $_POST['unique_int'];

    // Check if the user already exists
    $sql = "SELECT * FROM `teacher` WHERE `Username` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $user_exists = true;
        } else {
            // Insert new teacher data
            $sql = "INSERT INTO `teacher` (`Username`, `unique_int`, `Password`, `Name`, `Mail`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssss", $username, $unique_int, $password, $name, $mail);

            if ($stmt->execute()) {
                $success = true;
            } else {
                die($con->error);
            }
        }
    } else {
        die($con->error);
    }
}
?>
