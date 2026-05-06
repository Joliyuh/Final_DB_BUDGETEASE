
<?php
include 'connection.php';

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );
 $check = $conn->query(
        "SELECT * FROM users WHERE Email='$email'"
    );

    if($check->num_rows > 0){

        $error = "Email already exists";







    }