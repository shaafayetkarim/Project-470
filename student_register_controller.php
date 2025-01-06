
<?php
$success = false;
$user_exists = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    $username = $_POST['Username'];
    $name = $_POST['Name'];
    $password = $_POST['Password'];
    $mail = $_POST['Mail'];
    $sem_no = $_POST['Sem_no'];
    $course_count = $_POST['Course_count'];
    $CGPA = $_POST['CGPA'];

    // Check if the username already exists
    $sql = "SELECT * FROM `student` WHERE `Username` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $num = $result->num_rows;
        if ($num > 0) {
            $user_exists = true;
        } else {
            // Insert the new student
            $sql = "INSERT INTO `student` (`Username`, `Name`, `Password`, `Mail`, `Sem_no`, `Course_count`, `CGPA`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssiii", $username, $name, $password, $mail, $sem_no, $course_count, $CGPA);

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
