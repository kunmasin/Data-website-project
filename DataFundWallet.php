<?php
include("dataDatabaseLogin.php");
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

// Fetch the current total balance before funding
$previous_total_balance = 0;
$sql_current_balance = "SELECT SUM(current_balance) AS total_balance FROM `wallet_balance` WHERE user_id = ?";
$stmt_current_balance = $conn->prepare($sql_current_balance);
$stmt_current_balance->bind_param("i", $userId);
$stmt_current_balance->execute();
$result_current_balance = $stmt_current_balance->get_result();
if ($result_current_balance->num_rows > 0) {
    $row_current_balance = $result_current_balance->fetch_assoc();
    $previous_total_balance = $row_current_balance['total_balance'] ?? 0;
}
$stmt_current_balance->close();

$amountErr = " ";
$amount = "";
$new_balance = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['amount'])) {
        $amountErr = "Amount is required";
    } else {
        $amount = test_input($_POST['amount']);
        $funded_amount = $amount; // Store the initially funded amount
        $deduction_percentage = 0.03;
        $deduction_amount = $funded_amount * $deduction_percentage;
        $new_balance = $funded_amount - $deduction_amount + $previous_total_balance;

        // **IMPORTANT: You need a transaction_reference here!**
        // In the ideal Paystack flow, this reference comes from the Paystack callback.
        // For demonstration purposes, if you MUST keep this direct POST,
        // you'd generate a placeholder reference, but this is NOT secure for real payments.
        // Let's assume you're moving this block to `verify_paystack.php`
        // where `$reference` would be available from Paystack's response.
        $transaction_reference = "DIRECT_FUND_" . time() . "_" . uniqid(); // Placeholder - DO NOT USE FOR REAL PAYSTACK!

        // Prepare and bind the SQL statement to insert into wallet_balance
        // Added 'transaction_reference' column and 's' for string type
        $stmt_insert = $conn->prepare("INSERT INTO wallet_balance (user_id, previous_balance, funded_amount, deduction_amount, current_balance, transaction_reference) VALUES (?, ?, ?, ?, ?, ?)");

        // Type definition string now includes 's' for the new string parameter
        // 'idddds' -> integer, double, double, double, double, string
        $stmt_insert->bind_param("idddds", $userId, $previous_total_balance, $funded_amount, $deduction_amount, $new_balance, $transaction_reference);

        if ($stmt_insert->execute()) {
            // Success message
            // You might want to set a session variable and redirect to prevent re-submission on refresh
            // $_SESSION['message'] = "Wallet Funded Successfully!";
            // header("Location: DataDashboard.php");
            // exit();
        } else {
            // Log the error for debugging, don't just echo to user in production
            error_log("Database Error: " . $stmt_insert->error);
            // Echo a user-friendly message
            echo "Error funding wallet. Please try again or contact support.";
        }
        $stmt_insert->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// Close the database connection after all operations.  It's good practice to close it here.
//mysqli_close($conn);  // Removed closing the connection here.  You should close it in cookie.php, as you indicated in a comment.
include('balance.php');
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
    <script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>
        <?php include('sidebar.php') ?>

        <div class="container">
            <h4 class="text-center pt-3">FUND WALLET</h4>
           <!-- <h5>Previous Balance: <?php  echo htmlspecialchars($previous_total_balance); ?></h5> -->
            <h5>Balance: <?php echo htmlspecialchars($balance) ?></h5>
            <h5>TRANSACTION HISTORY</h5>
            <div class="p-3 focus-ring border bg-white text-left rounded-4">
                    <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h4>Fund Your Wallet with Paystack</h4>
                    <div class="form-group">
                        <label for="onlineAmountPaystack">Enter Amount (NGN)</label>
                        <input type="number" class="form-control" name="amount" id="onlineAmountPaystack" placeholder="e.g., 5000" min="100" step="any" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 form-control" onclick="payWithPaystack()">Pay with Paystack</button>
                    </form>
                </div>

        </div>
    </div>
    <script src="DashboardScript.js"></script>
    <script>
    // Ensure this gets the logged-in user's email correctly
    const customerEmail = "<?php echo $loggedInUserEmail; ?>";
    const customerName = "<?php echo $loggedInUserName; ?>"; // Now correctly passed from PHP

    console.log("Logged in User Email:", customerEmail);
    console.log("Logged in User Name:", customerName);


    function payWithPaystack() {
        const onlineAmountInput = document.getElementById('onlineAmountPaystack');
        let transactionAmountNaira = parseFloat(onlineAmountInput.value);

        if (isNaN(transactionAmountNaira) || transactionAmountNaira <= 0) {
            alert('Please enter a valid positive amount for Paystack payment.');
            onlineAmountInput.focus();
            return;
        }

        const transactionAmountKobo = Math.round(transactionAmountNaira * 100);

        const transactionReference = "PS_TRX_" + Math.floor((Math.random() * 1000000000) + 1);

        console.log("Initiating Paystack payment with amount:", transactionAmountKobo, "kobo, email:", customerEmail, "ref:", transactionReference);

        var handler = PaystackPop.setup({
            key: 'pk_test_9c4a8d837047eee472dd51553e048f1538a694a6', // Your Paystack Public Test Key (keep safe)
            email: customerEmail,
            amount: transactionAmountKobo,
            ref: transactionReference,
            metadata: {
                custom_fields: [
                    {
                        display_name: "Customer Name",
                        variable_name: "customer_name",
                        value: customerName // Pass customerName to Paystack metadata
                    },
                    {
                        display_name: "Payment Description",
                        variable_name: "payment_description",
                        value: "Car Rental Payment"
                    }
                ]
            },
            onClose: function() {
                alert('Paystack payment window closed or cancelled.');
            },
            callback: function(response) {
                console.log("Paystack callback response:", response);
                if (response.status === 'success') {
                    verifyPaystackTransaction(response.reference);
                } else {
                    alert('Paystack payment failed or cancelled.');
                }
            }
        });
        handler.openIframe();
    }

    function verifyPaystackTransaction(reference) {
        console.log("Verifying Paystack transaction with reference:", reference);
        fetch('verify_paystack.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ reference: reference }) // Ensure key is 'reference'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log("Paystack verification response from backend:", data);
            if (data.status === 'success') {
                alert('Paystack Payment Verified! Your car booking will be processed.');
                document.getElementById('onlineAmountPaystack').value = '';
                // Optional: reload page or redirect to a success page
                // window.location.reload();
            } else {
                alert('Paystack Payment Verification Failed: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error during Paystack verification:', error);
            alert('An error occurred during Paystack verification: ' + error.message);
        });
    }
    </script>
</body>
</html>
