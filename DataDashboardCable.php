<?php
session_start(); // Ensure session is started

include("dataDatabaseLogin.php");

// Check if the user is logged in (using cookies)
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

include('dataDatabaseLogin.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cableType = $_POST['cableType'];
    $cablePlans = $_POST['cablePlans']; // Get the selected network
    $smartCardNumber = $_POST['smartCardNumber'];
    $transaction_pin = $_POST['transaction_pin'];
    $amount = $_POST['amount'];
    $reference = uniqid('txn_'); // Unique transaction reference
    $status = 'pending';
    $details = 'This user made a purchase of '. $amount .' '. $cableType .' '. $cablePlans . ' to '. $smartCardNumber . ' the transaction is ' . $status;

    // Determine the transaction type based on data_type and network
    // Insert transaction
    
    $sql = "INSERT INTO transactions (user_id, transaction_type, amount, reference, status, details)
    VALUES ('$userId','$cableType', '$amount', '$reference', '$status', '$details')";


if ($conn->query($sql) === TRUE) {
echo "<script>alert('Transaction successful!');</script>";
} else {
echo "<script>alert('Transaction failed! Please try again.');</script>";
}
$conn->close();
}

include ('balance.php');
include ('cookie.php');
?>

<!DOCTYPE php>
<php lang="en">
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
        <?php include('sidebar.php') ?>
     
        <div class="container">
            <h4 class="text-center pt-3">CABLE SUBSCRIPTION</h4>
            <h5>BALANCE: &#8358 <?php echo $balance ?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <form action="" method="post">
                <label for="">Cable Type</label><br>
                <select class="dashboard-inputs" name="cableType" id="cableType">
                    <option value="Choose Airtime Type" selected disabled> Choose Cable Type</option>
                    <option value="gotv">GoTv</option>
                    <option value="dstv">Dstv</option>
                    <option value="startimes">Startimes</option>
                </select><br>

                <label for="">Cable Plan Type</label><br>
                <select class="dashboard-inputs" name="cablePlans" id="cablePlans">
                    <option value="Choose Network Type" selected disabled> Choose Network Type</option>
                </select><br>
                <label for="">Smart Card Number</label><br>
                <input type="text" class="dashboard-inputs" name="smartCardNumber" placeholder="Smart Card Number"><br>
                <label for="">Cable Amount</label><br>
                <input type="text" class="dashboard-inputs" name="amount" placeholder="Amount"><br>
                <label for="">Transaction Pin</label><br>
                <input type="text" class="dashboard-inputs" name="transaction_pin" placeholder="Transaction Pin">
                <input type="submit" class="dashboard-submits" name="buy_cable" value="Submit Transaction"><br>
            </form>
</div> <!--End of Begining-->
<script src="DashboardScript.js"></script>
<script>
document.getElementById("cableType").addEventListener("change", function() {
    var cableType = this.value;
    var plansDropdown = document.getElementById("cablePlans");
    plansDropdown.innerHTML = ""; // Clear previous options

    if (cableType === "gotv") {
        plansDropdown.innerHTML = `
            <option disabled selected>Plan</option>
            <option>GoTv MAX - $Price</option>
            <option>GoTv Smallie - $Price</option>
            <option>GoTv Jinja - $Price</option>
            <option>GoTv Jolli - $Price</option>
        `;
    } else if (cableType === "dstv") {
        plansDropdown.innerHTML = `
            <option disabled selected>Plan</option>
            <option>DSTV Padi - $Price</option>
            <option>DSTV Great Wall Standalone - $Price</option>
            <option>DSTV Yanga - $Price</option>
            <option>DSTV Compact - $Price</option>
        `;
    } else if (cableType === "startimes") {
        plansDropdown.innerHTML = `
            <option disabled selected>Plan</option>
            <option>Basic - $Price</option>
            <option>Smart - $Price</option>
            <option>Nova - $Price</option>
            <option>Super - $Price</option>
        `;
    } else {
        plansDropdown.innerHTML = `<option value="">Select a cable type first</option>`;
    }
});

document.getElementById("data").onclick = function () {
    alert("You have purchased $Amount of data successfully");
}
</script>

</body>
</php>