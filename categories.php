
<?php
include 'auth.php';
include 'connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['add'])){

    $category = trim($_POST['category']);

    if(!empty($category)){

        $sql = "

        INSERT INTO categories
        (User_ID, Category_Name)

        VALUES

        
        ('$user_id','$category')

        ";

        if($conn->query($sql)){

            $success = "Category added successfully";

        } else {

            $error = $conn->error;
        }
    }
}

$categories = $conn->query(

"SELECT * FROM categories
WHERE User_ID='$user_id'

ORDER BY Category_Name ASC"

);
?>

<!DOCTYPE html>
<html>
<head>

<title>Categories</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body class="bg-dark text-white">

<div class="container mt-5 category-container">

<div class="d-flex justify-content-between mb-4">

<h2>Manage Categories</h2>

<a href="dashboard.php"
   class="btn btn-secondary">

Back Dashboard

</a>

</div>

<?php
if(isset($success)){
    echo "<div class='alert alert-success'>$success</div>";
}

if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<div class="card p-4 bg-dark border-secondary mb-4">

<form method="POST">

<div class="row">

<div class="col-md-10">

<input type="text"
       name="category"
       class="form-control"
       placeholder="Enter category name"
       required>

</div>