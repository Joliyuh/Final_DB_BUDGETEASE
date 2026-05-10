<?php
session_start();
$user_id = $_SESSION['user_id'];

include 'connection.php';

$query = "
SELECT transactions.*, categories.Category_Name
FROM transactions
JOIN categories
ON transactions.Category_ID = categories.Category_ID

WHERE transactions.User_ID = '$user_id'

ORDER BY transactions.Date DESC
";

$reports = $conn->query($query);

?>
