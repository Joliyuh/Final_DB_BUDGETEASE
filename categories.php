
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