<?php
include('dataDatabaseLogin.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming user is logged in
    $data_type = $_POST['data_type'];
    $network_type = $_POST['network_type'];
    $phone_number = $_POST['phone_number'];
    $transaction_pin = $_POST['transaction_pin'];
    $amount = $_POST['amount'];
    $reference = uniqid('txn_'); // Unique transaction reference
    $status = 'pending';

    // Insert transaction
    $sql = "INSERT INTO transactions (user_id, transaction_type, amount, reference, status, details)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdsds', $user_id, $data_type, $amount, $reference, $status, $phone_number);

    if ($stmt->execute()) {
        echo "<script>alert('Transaction successful!');</script>";
    } else {
        echo "<script>alert('Transaction failed! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OURDATA WEBSITE</title>
    <link rel="stylesheet" href="..\Day7\DataCSSFile.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="d-flex">
        <div class="dashboard-background" id="nav-menu">
            <img class="user-image" src="../Day7/Day7templates/Photoroom-20240526_213830.png" alt="">
            <h4 class="text-center">ONIYE ADBULLAHI</h4>
            <ul>
                <li><a href="..\Day7\DataDashboard.php">DASHBOARD</a></li>
                <li><a href="..\Day7\DataDashoardAirtime.php">BUY AIRTIME</a></li>
                <li><a href="..\Day7\DataDashboardData.php">BUY DATA</a></li>
                <li><a href="..\Day7\DataDashboardCable.php">CABLE SUBSCRIPTION</a></li>
                <li><a href="..\Day7\DataDashboardUtility.php">BILL PAYMENTS</a></li>
                <li><a href="..\Day7\DataFundWallet.php">FUND WALLET</a></li>
                <li><a href="..\Day7\DataWallet2Wallet.php">WALLET 2 WALLET</a></li>
                <li><a href="..\Day7\DataTransaction.php">TRANSACTION HISTORY</a></li>
                <li><a href="..\Day7\DataAccountSetting.php">ACCOUNT SETTINGS</a></li>
                <li><a href="..\Day7\DataLogOut.php">LOGOUT</a></li>
            </ul>
        </div>
         
        <div class="container">
            <button class="menu-toggle btn btn-primary" onclick="toggleMenu()">&#9776;</button>
            <h4 class="text-center pt-3">DATA SUBSCRIPTION</h4>
            <h5>BALANCE: &#8358 <?php include ('balance.php')?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <form action="" method="POST">
                <label for="">Data Type</label><br>
                <select class="dashboard-inputs" name="transaction_type" id="">
                    <option value="Choose Data Type" selected disabled> Choose Data Type</option>
                    <option value="">SME</option>
                    <option value="">Cooperate Gifting</option>
                    <option value="">Share Me</option>
                </select><br>

                <label for="">Network Type</label><br>
                <select class="dashboard-inputs" name="transaction_type" id="">
                    <option value="Choose Network Type" selected disabled> Choose Network Type</option>
                    <option value="">MTN </option>
                    <option value="">AIRTEL</option>
                    <option value="">GLO</option>
                    <option value="">9 Mobile</option>
                </select><br>
                <label for="">Network Type</label><br>
                <select class="dashboard-inputs" name="transaction_type" id="">
                    <option value="Choose Network Type" selected disabled> Choose Network Type</option>
                    <option value="">MTN</option>
                    <option value="">AIRTEL</option>
                    <option value="">GLO</option>
                    <option value="">9 Mobile</option>
                </select><br>
                <label for="">Mobile Phone Number</label><br>
                <input type="text" class="dashboard-inputs" name="reference" placeholder="Mobile Phone Number"><br>
                <label for="">Transaction Pin</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Transaction Pin">
                <input type="submit" class="dashboard-submits" value="Submit Transaction"><br>
            </form>
</div> <!--End of Begining-->

<script src="DashboardScript.js"></script>
</body>
</html>