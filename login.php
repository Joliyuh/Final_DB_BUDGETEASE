<?php
session_start();
include 'connection.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Email='$email'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['Password'])){

            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['fullname'] = $user['Fullname'];

            header("Location: dashboard.php");

        } else {
            $error = "Wrong password";
        }

    } else {
        $error = "User not found";
    }
}
?>

