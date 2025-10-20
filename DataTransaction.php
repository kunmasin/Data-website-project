<?php
include ("dataDatabaseLogin.php");
if (!isset($_COOKIE['users'])){
    header('location: DataLogIn.php');
    exit;
}
$loggedInUserEmail = $_COOKIE['users'];
$sql = "SELECT * FROM `data_users` WHERE e_mail LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserEmail);
$user = array();

if($stmt->execute()){
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           $user = $row;
        }
    } else {
        header('location: DataLogIn.php');
        exit;
    }

} else {
    echo "Error: " .$stmt->error;
}
$stmt->close();

$userId = $user['id']; // Assuming your user table has an 'id' column

$transactionQuery = "SELECT t.transaction_id, t.transaction_type, t.amount, t.status, t.created_at, t.details
                     FROM transactions t
                     WHERE t.user_id = ?
                     ORDER BY t.created_at DESC";

$transactionStmt = $conn->prepare($transactionQuery);
$transactionStmt->bind_param('i', $userId);
$transactionStmt->execute();
$transactionResult = $transactionStmt->get_result();
$transactions = $transactionResult->fetch_all(MYSQLI_ASSOC);
$transactionStmt->close();
$conn->close();

include ('cookie.php');
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
    <?php include('sidebar.php') ?>

    <div class="container">

        <div class="container">
    <h4 class="text-center">TRANSACTION HISTORY</h4><br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Type</th>
                <th>Details</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($transactions)) {
                $sn = 1;
                foreach ($transactions as $transaction) {
                    echo "<tr>
                            <td>{$sn}</td>
                            <td>" . htmlspecialchars($transaction['transaction_type']) . "</td>
                            <td>" . htmlspecialchars($transaction['details']) . "</td>
                            <td>" . htmlspecialchars($transaction['amount']) . "</td>
                            <td>" . htmlspecialchars($transaction['status']) . "</td>
                            <td>" . htmlspecialchars($transaction['created_at']) . "</td>
                        </tr>";
                    $sn++;
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No transactions found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

        </div>
<script src="DataDashboard1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>