<?php
include 'auth.php';
include 'connection.php';

$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];

$totalIncome = $conn->query(
"SELECT SUM(Amount) AS total FROM transactions
WHERE User_ID='$user_id' AND Type='Income'"
)->fetch_assoc()['total'];


$totalExpense = $conn->query(
"SELECT SUM(Amount) AS total FROM transactions
WHERE User_ID='$user_id' AND Type='Expense'"
)->fetch_assoc()['total'];

$balance = $totalIncome - $totalExpense;

$transactions = $conn->query(
"SELECT transactions.*, categories.Category_Name
FROM transactions
INNER JOIN categories
ON transactions.Category_ID = categories.Category_ID
WHERE transactions.User_ID='$user_id'
ORDER BY Date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="sidebar">

<div class="logo">BudgetEase</div>

<a href="dashboard.php">Dashboard</a>
<a href="add_transaction.php">Add Transaction</a>
<a href="categories.php">Categories</a>
<a href="reports.php">Reports</a>
<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<div class="page-title">
Financial Dashboard
</div>

<div class="user-box">
Welcome, <?= $fullname ?>
</div>

</div>