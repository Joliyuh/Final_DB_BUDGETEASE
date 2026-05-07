<?php
include 'auth.php';
include 'connection.php';

$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];

$totalIncome = $conn->query(
"SELECT SUM(Amount) AS total FROM transactions
WHERE User_ID='$user_id' AND Type='Income'"
)->fetch_assoc()['total'];
