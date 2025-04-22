<?php
include('dataDatabaseLogin.php'); // Database connection

$query = "SELECT t.transaction_id, u.names, u.e_mail, u.phone_no, t.transaction_type, t.amount, t.status, t.created_at
          FROM transactions t
          JOIN data_users u ON t.user_id = u.id
          ORDER BY t.created_at DESC";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OURDATA WEBSITE</title>
    <link rel="stylesheet" href="../Day7/DataCSSFile.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="dashboard-background" id="nav-menu">
        <img class="user-image" src="../Day7/Day7templates/Photoroom-20240526_213830.png" alt="">
        <h4 class="text-center">ONIYE ABDULLAHI</h4>
        <ul>
            <li><a href="../Day7/DataDashboard.php">DASHBOARD</a></li>
            <li><a href="../Day7/DataDashoardAirtime.php">BUY AIRTIME</a></li>
            <li><a href="../Day7/DataDashboardData.php">BUY DATA</a></li>
            <li><a href="../Day7/DataDashboardCable.php">CABLE SUBSCRIPTION</a></li>
            <li><a href="../Day7/DataDashboardUtility.php">BILL PAYMENTS</a></li>
            <li><a href="../Day7/DataFundWallet.php">FUND WALLET</a></li>
            <li><a href="../Day7/DataWallet2Wallet.php">WALLET 2 WALLET</a></li>
            <li><a href="../Day7/DataTransaction.php">TRANSACTION HISTORY</a></li>
            <li><a href="../Day7/DataAccountSetting.php">ACCOUNT SETTINGS</a></li>
            <li><a href="../Day7/DataLogOut.php">LOGOUT</a></li>
        </ul>
    </div>

    <div class="container">
        <button class="menu-toggle btn btn-primary" onclick="toggleMenu()">&#9776;</button>

        <div class="container">
    <h4 class="text-center">TRANSACTION HISTORY</h4><br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$sn}</td>
                            <td>{$row['names']}</td>
                            <td>{$row['e_mail']}</td>
                            <td>{$row['phone_no']}</td>
                            <td>{$row['transaction_type']}</td>
                            <td>{$row['amount']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                    $sn++;
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No transactions found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
<script src="DataDashboard1.js"></script>
</body>
</html>
