<?php

include 'auth.php';
include 'connection.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $conn->query(
    "DELETE FROM transactions
    WHERE Transaction_ID='$id'"
    );

}

header("Location: dashboard.php");
exit();

?>