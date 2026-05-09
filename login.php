<?php
session_start();
include 'connection.php';

if(isset($_POST['login'])){

    

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

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body class="login-page">

<div class="login-card">

    <h1 class="logo">
        BudgetEase
    </h1>

    <h3 class="sub-title">
        Login Account
    </h3>

    <form method="POST">

        <input type="email"
               name="email"
               class="form-control"
               placeholder="Email"
               required>

        <input type="password"
               name="password"
               class="form-control"
               placeholder="Password"
               required>

        <button type="submit"
                class="btn btn-success w-100"
                name="login">

            Login

        </button>

    </form>

    <a href="register.php"
       class="account-link d-block text-center mt-3">

        Create Account

    </a>

</div>

</body>

</html>