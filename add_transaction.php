
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