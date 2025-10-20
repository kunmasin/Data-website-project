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
    $data_type = $_POST['data_type'];
    $network = $_POST['network']; // Get the selected network
    $phone_number = $_POST['phone_number'];
    $transaction_pin = $_POST['transaction_pin'];
    $amount = $_POST['amount'];
    $reference = uniqid('txn_'); // Unique transaction reference
    $status = 'pending';
    $details = 'This user made a purchase of '. $amount .' '. $data_type .' '. $network . ' to '. $phone_number . ' the transaction is ' . $status;

    // Determine the transaction type based on data_type and network
    $transaction_type = '';
    if ($data_type === 'sme' && $network === 'mtn') {
        $transaction_type = 'mtn_sme_data';
    } else if ($data_type === 'gifting' && $network === 'mtn') {
        $transaction_type = 'mtn_cg_data';
    } else if ($data_type === 'gifting' && $network === 'airtel') {
        $transaction_type = 'airtel_data'; // Adjust as needed
    } else if ($data_type === 'gifting' && $network === 'glo') {
        $transaction_type = 'glo_data'; // Adjust as needed
    } else if ($data_type === 'gifting' && $network === 'mobile') {
        $transaction_type = 'mobile_data'; // Adjust as needed
    }

    // Insert transaction
    
    $sql = "INSERT INTO transactions (user_id, transaction_type, amount, reference, status, details)
    VALUES ('$userId','$data_type', '$amount', '$reference', '$status', '$details')";


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
            <h4 class="text-center pt-3">UTILITY / BILL SUBSCRIPTION</h4>
            <h5>BALANCE: &#8358 <?php echo $balance ?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <form action="">
                <label for="">Utility / Bill Type</label><br>
                <select class="dashboard-inputs" name="" id="">
                    <option value="Choose Disco Type" selected disabled> Choose Cable Type</option>
                    <option>POSTPAID</option>
                    <option>PREPAID</option>
                </select><br>

                <label for="">Disco State Type</label><br>
                <select class="dashboard-inputs" name="discoState" id="">
                <option disabled selected>--Disco State--</option>
                <option> Kwara Electric            </option>
                <option> Ikeja Electric            </option>
                <option>Eko Electric            </option>
                <option> Abuja Electric            </option>
                <option>  Kano Electric            </option>
                <option>   Enugu Electric            </option>
                <option> Port Harcourt Electric            </option>
                <option> Ibadan Electric            </option>
                <option> Kaduna Electric            </option>
                <option"> Jos Electric            </option>
                <option">  Benin Electric            </option>
                <option"> Yola Electric            </option>
                </select><br>

                <label for="">Meter Number</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Meter Number"><br>
                <label for="">Utility / Bill Amount</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Amount"><br>
                <label for="">Phone Number</label>
                <input type="text" class="dashboard-inputs" placeholder="Customer Phone Number"><br>
                <label for="">Transaction Pin</label>
                <input type="text" class="dashboard-inputs" placeholder="Transaction Pin"><br>
                <input type="submit" class="dashboard-submits" value="Submit Transaction"><br>
            </form>
</div> <!--End of Begining-->
<script src="DashboardScript.js"></script>
</body>
</php>