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