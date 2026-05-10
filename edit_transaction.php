<?php
include 'auth.php';
include 'connection.php';

$id = $_GET['id'];

$data = $conn->query(
"SELECT * FROM transactions
WHERE Transaction_ID='$id'");

$row = $data->fetch_assoc();

if(isset($_POST['update'])){
