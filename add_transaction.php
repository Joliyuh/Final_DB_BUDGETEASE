
<?php
include 'auth.php';
include 'connection.php';

$user_id = $_SESSION['user_id'];

$categories = $conn->query(
"SELECT * FROM categories
WHERE User_ID='$user_id'");

if(isset($_POST['add'])){