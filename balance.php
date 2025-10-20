<?php
include('dataDatabaseLogin.php');

// Redirect if user is not logged in
if (!isset($_COOKIE['users'])) {
    header('location: DataLogIn.php');
    exit;
}

$loggedInUserEmail = $_COOKIE['users'];

// Retrieve user ID
$sql = "SELECT id FROM `data_users` WHERE e_mail = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Error preparing user email statement: " . $conn->error);
    header('location: DataLogIn.php'); // Or display an error to the user
    exit;
}
$stmt->bind_param("s", $loggedInUserEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $userId = $user['id'];
} else {
    // User not found or multiple users with the same email (shouldn't happen with unique emails)
    header('location: DataLogIn.php');
    exit;
}
$stmt->close();

// --- REFINED getUserBalance FUNCTION ---
function getUserBalance($conn, $userId) {
    // Assuming 'id' is an auto-incrementing primary key in wallet_balance
    // or you have a 'timestamp' column to determine the latest entry.
    // If you have a 'timestamp' column, use ORDER BY timestamp DESC.
    $sql_balance = "SELECT current_balance FROM wallet_balance WHERE user_id = ? ORDER BY id DESC";
    // If you have a 'created_at' or 'transaction_date' timestamp column:
    // $sql_balance = "SELECT current_balance FROM wallet_balance WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";

    $stmt_balance = $conn->prepare($sql_balance);
    if (!$stmt_balance) {
        error_log("Error preparing balance statement: " . $conn->error);
        return 0.00; // Return float 0.00 for currency
    }

    $stmt_balance->bind_param("i", $userId);
    $stmt_balance->execute();
    $result = $stmt_balance->get_result();
    $stmt_balance->close();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ensure the balance is treated as a float
        return is_numeric($row['current_balance']) ? (float)$row['current_balance'] : 0.00;
    }

    return 0.00; // Default balance if no transactions found
}

// Set $balance using the function
$balance = getUserBalance($conn, $userId);

// You can now display $balance wherever needed in your HTML
// Example:
// echo "Current Balance: &#x20A6;" . number_format($balance, 2);

// Close the database connection when all operations are done.
// If dataDatabaseLogin.php doesn't close it, do it here or in a centralized footer.
// mysqli_close($conn);

?>