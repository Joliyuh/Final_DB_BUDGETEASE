
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

       } else {

        $sql = "INSERT INTO users
        (Fullname, Email, Password)

        VALUES
        ('$fullname','$email','$password')";

        if($conn->query($sql)){
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card-box">

        <h1 class="logo text-center">
            BudgetEase
        </h1>

        <h3 class="sub-title text-center mb-4">
            Create Account
        </h3>

        <form method="POST">

            <input type="text"
                   name="fullname"
                   class="form-control mb-3"
                   placeholder="Full Name"
                   required>
<input type="email"
                   name="email"
                   class="form-control mb-3"
                   placeholder="Email"
                   required>
            <input type="password"
                   name="password"
                   class="form-control mb-3"
                   placeholder="Password"
                   required>

            <button class="btn btn-success w-100"
                    name="register">

                Register

            </button>

        </form>

        <a href="login.php"
           class="account-link d-block text-center mt-3">

            Already have an account?

        </a>

    </div>

</div>
</html>



    