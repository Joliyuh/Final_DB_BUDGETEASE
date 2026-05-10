
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

        
        ('$user_id','$category')

        ";

        if($conn->query($sql)){

            $success = "Category added successfully";

        } else {

            $error = $conn->error;
        }
    }
}

$categories = $conn->query(

"SELECT * FROM categories
WHERE User_ID='$user_id'

ORDER BY Category_Name ASC"

);
?>
