
<?php
include 'auth.php';
include 'connection.php';

$user_id = $_SESSION['user_id'];

$categories = $conn->query(
"SELECT * FROM categories
WHERE User_ID='$user_id'");

if(isset($_POST['add'])){

 $category = $_POST['category'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $conn->query(

        "INSERT INTO transactions

    (User_ID, Category_ID, Amount, Type, Description, Date)

    VALUES

    ('$user_id','$category','$amount','$type','$description','$date')"

    );

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Transaction</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">


</head>

<body class="main-body">
<div class="main-container">        

<div class="container mt-5">

<div class="card p-4 login-card">

<h2>Add Transaction</h2>


<form method="POST">

<select name="category"
        class="form-control mb-3"
        required>

<option value="">Select Category</option>

<?php while($cat = $categories->fetch_assoc()){ ?>

<option value="<?= $cat['Category_ID'] ?>">
<?= $cat['Category_Name'] ?>
</option>

<?php } ?>

</select>

<input type="number"
       step="0.01"
       name="amount"
       class="form-control mb-3"
       placeholder="Amount"
       required>

<select name="type"
        class="form-control mb-3">

<option>Income</option>
<option>Expense</option>

</select>