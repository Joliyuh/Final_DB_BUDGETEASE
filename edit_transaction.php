<?php
include 'auth.php';
include 'connection.php';

$id = $_GET['id'];

$data = $conn->query(
"SELECT * FROM transactions
WHERE Transaction_ID='$id'");

$row = $data->fetch_assoc();

if(isset($_POST['update'])){

 $amount = $_POST['amount'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    $conn->query(

    "UPDATE transactions

    SET
    Amount='$amount',
    Type='$type',
    Description='$description'

    WHERE Transaction_ID='$id'");

        header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Transaction</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>

<body class="main-body">

<div class="container mt-5">

<div class="edit-card mx-auto"
     style="max-width:450px;">

<h2>Edit Transaction</h2>

<form method="POST">

<input type="number"
       step="0.01"
       name="amount"
       value="<?= $row['Amount'] ?>"
       class="form-control mb-3">

<select name="type"
        class="form-control mb-3">

<option <?= $row['Type']=="Income" ? "selected" : "" ?>>
Income
</option>

<option <?= $row['Type']=="Expense" ? "selected" : "" ?>>
Expense
</option>

</select>

<textarea name="description"
          class="form-control mb-3"><?= $row['Description'] ?></textarea>

<button class="btn btn-primary w-100"
        name="update">

Update

</button>

</form>

</div>

</div>

</body>
</html>
