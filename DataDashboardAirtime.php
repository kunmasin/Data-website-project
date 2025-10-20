<?php
session_start();
include("dataDatabaseLogin.php");
include("balance.php");
include("cookie.php");



function deduct_wallet_balance($conn, $user_id, $amount) {
    $stmt = $conn->prepare("SELECT current_balance FROM wallet_balance WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_balance);
    $stmt->fetch();
    $stmt->close();

    if ($current_balance >= $amount) {
        $stmt = $conn->prepare("UPDATE wallet_balance SET current_balance = current_balance - ? WHERE id = ?");
        $stmt->bind_param("di", $amount, $user_id);
        return $stmt->execute();
    } else {
        return false;
    }
}

if (!isset($_COOKIE['users'])) {
    header('location: DataLogIn.php');
    exit;
}

$loggedInUserEmail = $_COOKIE['users'];
$sql = "SELECT id FROM `data_users` WHERE e_mail LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserEmail);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $userId = $user['id'];
} else {
    header('location: DataLogIn.php');
    exit;
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airtimeType = $_POST['airtime_type'];
    $network = $_POST['network'];
    $phoneNumber = $_POST['phone_number'];
    $amount = floatval($_POST['amount']);
    $transactionPin = $_POST['transaction_pin'];
    $reference = uniqid('airtime_');
    $status = 'pending';
    $details = 'This user made a purchase of '. $amount .' '. $airtimeType .' '. $network . ' to '. $phoneNumber . ' the transaction is ' . $status;

    if (empty($network) || empty($phoneNumber) || empty($amount) || empty($transactionPin)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }

    

    if (!deduct_wallet_balance($conn, $userId, $amount)) {
        echo "<script>alert('Insufficient Wallet Balance.');</script>";
        exit;
    }

    $transactionType = 'Airtime';
    $sql = "INSERT INTO transactions (user_id, transaction_type, subscription, amount, reference, status, details)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdsss", $userId, $transactionType, $airtimeType, $amount, $reference, $status, $details);

    if ($stmt->execute()) {
        echo "<script>alert('Transaction successful!');</script>";
    } else {
        echo "<script>alert('Transaction failed! Please try again.');</script>";
    }
    $stmt->close();
    $conn->close();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
       <?php include('sidebar.php') ?>

        <div class="container">
            <h4 class="text-center pt-3">BUY AIRTIME</h4>
            <h5>BALANCE: &#8358 <?php echo $balance ?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <form action="" method="POST">
                <label for="airtime_type">Airtime Type</label><br>
                <select class="dashboard-inputs" name="airtime_type" id="airtime_type">
                    <option value="Choose Airtime Type" selected disabled> Choose Airtime Type</option>
                    <option value="vtu">VTU</option>
                    <option value="share_me">Share Me</option>
                </select><br>

                <label for="network">Airtime Network Type</label><br>
                <select class="dashboard-inputs" name="network" id="network">
                    <option value="Choose Network Type" selected disabled> Choose Network Type</option>
                    <option value="mtn">MTN</option>
                    <option value="airtel">AIRTEL</option>
                    <option value="glo">GLO</option>
                    <option value="9mobile">9 Mobile</option>
                </select><br>
                <label for="phone_number">Airtime Phone Number</label><br>
                <input type="text" class="dashboard-inputs" name="phone_number" placeholder="Phone Number"><br>
                <label for="amount">Airtime Amount</label><br>
                <input type="number" class="dashboard-inputs" name="amount" placeholder="Amount"><br>
                <label for="transaction_pin">Transaction Pin</label><br>
                <input type="password" class="dashboard-inputs" name="transaction_pin" placeholder="Transaction Pin">
                <input type="submit" class="dashboard-submits" value="Submit Transaction"><br>
            </form>
        </div>
    </div>
    <script src="DashboardScript.js"></script>
</body>
</html>
