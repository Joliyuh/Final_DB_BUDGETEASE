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
