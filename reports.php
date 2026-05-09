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

<!DOCTYPE html>
<html>
<head>

<title>Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="sidebar">

    <div class="logo">
        BudgetEase
    </div>

    <a href="dashboard.php">Dashboard</a>

    <a href="add_transaction.php">
        Add Transaction
    </a>

    <a href="categories.php">
        Categories
    </a>

    <a href="reports.php">
        Reports
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>

<div class="main">

    <div class="topbar">

        <h1 class="page-title">
            Financial Reports
        </h1>

    </div>

    <div class="table-container">

        <table>

            <tr>

                <th>ID</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>

            </tr>

            <?php while($row = $reports->fetch_assoc()){ ?>

            <tr>

                <td>
                    <?= $row['Transaction_ID'] ?>
                </td>

                <td>
                    <?= $row['Category_Name'] ?>
                </td>

                <td>
                    ₱<?= $row['Amount'] ?>
                </td>

                <td>
                    <?= $row['Type'] ?>
                </td>

                <td>
                    <?= $row['Description'] ?>
                </td>

                <td>
                    <?= $row['Date'] ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
