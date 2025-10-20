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
    $network = ""; // Get the selected network
    $phone_number = $_POST['phone_number'];
    $transaction_pin = $_POST['transaction_pin'];
    $amount = $_POST['amount'];
    $reference = uniqid('txn_'); // Unique transaction reference
    $status = 'pending';
    $details = 'This user made a purchase of '. $amount .' '. $data_type .' '. $network . ' to '. $phone_number . ' the transaction is ' . $status;

    // Determine the transaction type based on data_type and network
    $transaction_type = 'Data';
    $subscription = '';
    if ($data_type === 'sme' && $network === 'mtn') {
        $subscription = 'mtn_sme_data';
    } else if ($data_type === 'gifting' && $network === 'mtn') {
        $subscription = 'mtn_cg_data';
    } else if ($data_type === 'gifting' && $network === 'airtel') {
        $subscription = 'airtel_data'; // Adjust as needed
    } else if ($data_type === 'gifting' && $network === 'glo') {
        $subscription = 'glo_data'; // Adjust as needed
    } else if ($data_type === 'gifting' && $network === 'mobile') {
        $subscription = 'mobile_data'; // Adjust as needed
    }

    // Insert transaction
    
    $sql = "INSERT INTO transactions (user_id, transaction_type, subscription, amount, reference, status, details)
    VALUES ('$userId','$transaction_type', '$subscription', '$amount', '$reference', '$status', '$details')";

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
       <?php include('sidebar.php') ?>

        <div class="container">
            <h4 class="text-center pt-3">DATA SUBSCRIPTION</h4>
            <h5>BALANCE: &#8358 <?php echo $balance ?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <form action="" method="POST">
                <select class="form dashboard-inputs" name="data_type" id="data_type">
                    <option disabled selected id="data_type">Data Type</option>
                    <option id="sme" value="sme">SME</option>
                    <option id="cg" value="gifting">Corporate Gifting</option>
                </select>

                <div class="data_bot2 hidden" id="network_div">
                    <label for="network">Network <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" name="network" id="network">
                        <option disabled selected>Network</option>
                        <option id="mtn" value="mtn">MTN</option>
                        <option id="glo" value="glo">GLO</option>
                        <option id="airtel" value="airtel">AIRTEL</option>
                        <option id="mobile" value="mobile">9Mobile</option>
                    </select>
                </div>

                <div id="mtn_sme_plan" class="form hidden">
                    <label for="mtn_sme_list">MTN SME Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="mtn_sme_list" name="amount">
                        <option disabled selected>Plan</option>
                        <option value="500">MTN SME 1GB &#8358  500</option>
                        <option value="950">MTN SME 2GB &#8358 950</option>
                        <option value="1350">MTN SME 3GB &#8358 1350</option>
                        <option value="1700">MTN SME 4GB &#8358 1700</option>
                        <option value="2100">MTN SME 5GB &#8358 2100</option>
                    </select>
                </div>

                <div id="mtn_cg_plan" class="form hidden">
                    <label for="mtn_cg_list">MTN Corporate Gifting Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="mtn_cg_list" name="amount">
                        <option disabled selected>Plan</option>
                        <option value="600">MTN CG 1GB &#8358 600</option>
                        <option value="1150">MTN CG 2GB &#8358 1150</option>
                        <option value="1650">MTN CG 3GB &#8358 1650</option>
                        <option value="2100">MTN CG 4GB &#8358 2100</option>
                        <option value="2600">MTN CG 5GB &#8358 2600</option>
                        <option value="3100">MTN CG 6GB &#8358 3100</option>
                    </select>
                </div>

                <div id="airtel_plans" class="form hidden">
                    <label for="airtel_list">Airtel Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="airtel_list" name="amount">
                        <option disabled selected>Plan</option>
                        <option value="480">Airtel 1GB &#8358 480</option>
                        <option value="900">Airtel 2GB &#8358 900</option>
                        <option value="1300">Airtel 3GB &#8358 1300</option>
                        <option value="1650">Airtel 4GB &#8358 1650</option>
                        <option value="2050">Airtel 5GB &#8358 2050</option>
                        <option value="2400">Airtel 6GB &#8358 2400</option>
                    </select>
                </div>

                <div id="glo_plans" class="form hidden">
                    <label for="glo_list">GLO Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="glo_list" name="amount">
                        <option disabled selected>Plan</option>
                        <option value="470">GLO 1GB &#8358 470</option>
                        <option value="880">GLO 2GB &#8358 880</option>
                        <option value="1250">GLO 3GB &#8358 1250</option>
                        <option value="1600">GLO 4GB &#8358 1600</option>
                        <option value="2000">GLO 5GB &#8358 2000</option>
                        <option value="2350">GLO 6GB &#8358 2350</option>
                    </select>
                </div>

                <div id="mobile_plans" class="form hidden">
                    <label for="mobile_list">9Mobile Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="mobile_list" name="amount">
                        <option disabled selected>Plan</option>
                        <option value="460">9Mobile 1GB &#8358 </option>
                        <option value="860">9Mobile 2GB &#8358 860</option>
                        <option value="1200">9Mobile 3GB &#8358 1200</option>
                        <option value="1550">9Mobile 4GB &#8358 1550</option>
                        <option value="1900">9Mobile 5GB &#8358 1900</option>
                        <option value="2250">9Mobile 6GB &#8358 2250</option>
                    </select>
                </div>

                <div id="empty_plan" class="form">
                    <label for="empty_list">Plan <sup>*</sup></label><br>
                    <select class="form dashboard-inputs" id="empty_list">
                        <option disabled selected>Select Data Type First</option>
                    </select>
                </div>
                <br>
                <label for="phone_number">Mobile Phone Number</label><br>
                <input type="text" class="dashboard-inputs" name="phone_number" placeholder="Mobile Phone Number"><br>
                <label for="transaction_pin">Transaction Pin</label><br>
                <input type="password" class="dashboard-inputs" name="transaction_pin" placeholder="Transaction Pin">
                <input type="submit" class="dashboard-submits" value="Submit Transaction"><br>
            </form>
        </div> </div>

<script src="DashboardScript.js"></script>

<script>
document.getElementById("data_type").addEventListener("change", function () {
    const dataType = document.getElementById("data_type").value;
    const networkDiv = document.getElementById("network_div");
    const mtnSmePlanDiv = document.getElementById("mtn_sme_plan");
    const airtelPlansDiv = document.getElementById("airtel_plans");
    const gloPlansDiv = document.getElementById("glo_plans");
    const mobilePlansDiv = document.getElementById("mobile_plans");
    const emptyPlanDiv = document.getElementById("empty_plan");

    // Hide all plan divs initially
    networkDiv.classList.add("hidden");
    mtnSmePlanDiv.classList.add("hidden");
    airtelPlansDiv.classList.add("hidden");
    gloPlansDiv.classList.add("hidden");
    mobilePlansDiv.classList.add("hidden");
    emptyPlanDiv.classList.add("hidden");

    if (dataType === "sme") {
        // Show MTN SME plans only
        mtnSmePlanDiv.classList.remove("hidden");
    } else if (dataType === "gifting") {
        // Show network selection
        networkDiv.classList.remove("hidden");
    } else {
        // Show a default message
        emptyPlanDiv.classList.remove("hidden");
    }
});

document.getElementById("network").addEventListener("change", function () {
    const network = document.getElementById("network").value;
    const dataType = document.getElementById("data_type").value;
    const mtnSmePlanDiv = document.getElementById("mtn_sme_plan");
    const mtnCgPlanDiv = document.getElementById("mtn_cg_plan");
    const airtelPlansDiv = document.getElementById("airtel_plans");
    const gloPlansDiv = document.getElementById("glo_plans");
    const mobilePlansDiv = document.getElementById("mobile_plans");

    // Hide all plan divs
    mtnSmePlanDiv.classList.add("hidden");
    mtnCgPlanDiv.classList.add("hidden");
    airtelPlansDiv.classList.add("hidden");
    gloPlansDiv.classList.add("hidden");
    mobilePlansDiv.classList.add("hidden");

    if (dataType === "gifting") {
        if (network === "mtn") {
            mtnCgPlanDiv.classList.remove("hidden");
        } else if (network === "airtel") {
            airtelPlansDiv.classList.remove("hidden");
        } else if (network === "glo") {
            gloPlansDiv.classList.remove("hidden");
        } else if (network === "mobile") {
            mobilePlansDiv.classList.remove("hidden");
        }
    } else if (dataType === "sme" && network === "mtn") {
        mtnSmePlanDiv.classList.remove("hidden");
    }
});
</script>


</body>
</html>