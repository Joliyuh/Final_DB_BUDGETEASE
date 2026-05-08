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

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="sidebar">

<div class="logo">BudgetEase</div>

<a href="dashboard.php">Dashboard</a>
<a href="add_transaction.php">Add Transaction</a>
<a href="categories.php">Categories</a>
<a href="reports.php">Reports</a>
<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">

<div class="page-title">
Financial Dashboard
</div>

<div class="user-box">
Welcome, <?= $fullname ?>
</div>

</div>

<div class="cards">

<div class="card-box">
<h3>Total Income</h3>
<h1>₱<?= number_format($totalIncome,2) ?></h1>
</div>

<div class="card-box">
<h3>Total Expense</h3>
<h1>₱<?= number_format($totalExpense,2) ?></h1>
</div>

<div class="card-box">
<h3>Remaining Balance</h3>
<h1>₱<?= number_format($balance,2) ?></h1>
</div>

</div>

<div class="chart-box">
<canvas id="financeChart"></canvas>
</div>

<br>

<div class="table-container">

<h2>Recent Transactions</h2>

<br>

<table>

<tr>
<th>Category</th>
<th>Amount</th>
<th>Type</th>
<th>Description</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row = $transactions->fetch_assoc()){ ?>

<tr>

<td><?= $row['Category_Name'] ?></td>
<td>₱<?= number_format($row['Amount'],2) ?></td>
<td><?= $row['Type'] ?></td>
<td><?= $row['Description'] ?></td>
<td><?= $row['Date'] ?></td>

<td>
<a href="edit_transaction.php?id=<?= $row['Transaction_ID'] ?>"
class="btn btn-edit">
Edit
</a>

<a href="delete_transaction.php?id=<?= $row['Transaction_ID'] ?>"
class="btn btn-delete"
onclick="return confirm('Delete transaction?')">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<script>

const ctx = document.getElementById('financeChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Income', 'Expense'],
        datasets: [{
            data: [<?= $totalIncome ?>, <?= $totalExpense ?>],
            backgroundColor: [
                '#22c55e',
                '#ef4444'
            ]
        }]
    }
});

</script>

</body>
</html>