<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ourdata";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
echo "Connected Successfully <br>";

// =================================================================================
// Function to safely insert/update data plans
// =================================================================================
function insertOrUpdateDataPlans($conn, $mtn_half, $mtn_one, $mtn_two, $mtn_three, $mtn_four, $mtn_five,
                                  $mtnCG_half, $mtnCG_one, $mtnCG_two, $mtnCG_three, $mtnCG_four, $mtnCG_five,
                                  $airtel_half, $airtel_one, $airtel_two, $airtel_three, $airtel_four, $airtel_five,
                                  $glo_half, $glo_one, $glo_two, $glo_three, $glo_four, $glo_five,
                                  $mobile_half, $mobile_one, $mobile_two, $mobile_three, $mobile_four, $mobile_five) {
    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO data_plans (
    mtn_half, mtn_one, mtn_two, mtn_three, mtn_four, mtn_five,
    mtnCG_half, mtnCG_one, mtnCG_two, mtnCG_three, mtnCG_four, mtnCG_five,
    airtel_half, airtel_one, airtel_two, airtel_three, airtel_four, airtel_five,
    glo_half, glo_one, glo_two, glo_three, glo_four, glo_five,
    mobile_half, mobile_one, mobile_two, mobile_three, mobile_four, mobile_five
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            ON DUPLICATE KEY UPDATE 
                mtn_half = ?, mtn_one = ?, mtn_two = ?, mtn_three = ?, mtn_four = ?, mtn_five = ?,
                mtnCG_half = ?, mtnCG_one = ?, mtnCG_two = ?, mtnCG_three = ?, mtnCG_four = ?, mtnCG_five = ?,
                airtel_half = ?, airtel_one = ?, airtel_two = ?, airtel_three = ?, airtel_four = ?, airtel_five = ?,
                glo_half = ?, glo_one = ?, glo_two = ?, glo_three = ?, glo_four = ?, glo_five = ?,
                mobile_half = ?, mobile_one = ?, mobile_two = ?, mobile_three = ?, mobile_four = ?, mobile_five = ?,
                updated_at = CURRENT_TIMESTAMP"; // added updated_at for consistency


    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die("Error preparing statement: " . mysqli_error($conn)); //Handle errors
    }
   mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssssss",  // 32 's' for 32 string parameters
    $mtn_half, $mtn_one, $mtn_two, $mtn_three, $mtn_four, $mtn_five,
    $mtnCG_half, $mtnCG_one, $mtnCG_two, $mtnCG_three, $mtnCG_four, $mtnCG_five,
    $airtel_half, $airtel_one, $airtel_two, $airtel_three, $airtel_four, $airtel_five,
    $glo_half, $glo_one, $glo_two, $glo_three, $glo_four, $glo_five,
    $mobile_half, $mobile_one, $mobile_two, $mobile_three, $mobile_four, $mobile_five
);


    if (mysqli_stmt_execute($stmt)) {
        echo "Data plan details recorded/updated successfully <br>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt) . "<br>";
    }

    mysqli_stmt_close($stmt);
}



// =================================================================================
// Function to safely insert/update cable plans
// =================================================================================
function insertOrUpdateCablePlans($conn, $gotv_max, $gotv_smallie, $gotv_jinja, $gotv_jolli,
                                    $dstv_padi, $dstv_great_wall_standalone, $dstv_yanga, $dstv_compact,
                                    $startimes_basic, $startimes_smart, $startimes_nova, $startimes_super) {
    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO cable_plans (
                gotv_max, gotv_smallie, gotv_jinja, gotv_jolli,
                dstv_padi, dstv_great_wall_standalone, dstv_yanga, dstv_compact,
                startimes_basic, startimes_smart, startimes_nova, startimes_super
            ) VALUES (
                ?, ?, ?, ?,
                ?, ?, ?, ?,
                ?, ?, ?, ?
            )
            ON DUPLICATE KEY UPDATE
                gotv_max = ?, gotv_smallie = ?, gotv_jinja = ?, gotv_jolli = ?,
                dstv_padi = ?, dstv_great_wall_standalone = ?, dstv_yanga = ?, dstv_compact = ?,
                startimes_basic = ?, startimes_smart = ?, startimes_nova = ?, startimes_super = ?,
                updated_at = CURRENT_TIMESTAMP";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
          die("Error preparing statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssssssssssssssss", // Added type string
        $gotv_max, $gotv_smallie, $gotv_jinja, $gotv_jolli,
        $dstv_padi, $dstv_great_wall_standalone, $dstv_yanga, $dstv_compact,
        $startimes_basic, $startimes_smart, $startimes_nova, $startimes_super,
        $gotv_max, $gotv_smallie, $gotv_jinja, $gotv_jolli,
        $dstv_padi, $dstv_great_wall_standalone, $dstv_yanga, $dstv_compact,
        $startimes_basic, $startimes_smart, $startimes_nova, $startimes_super
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Cable plan details recorded/updated successfully <br>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt) . "<br>";
    }

    mysqli_stmt_close($stmt);
}



// =================================================================================
//  MAIN SCRIPT
// =================================================================================

// Assuming these variables are coming from a form submission (POST request)
//  ALWAYS sanitize and validate data from user input!  Use mysqli_real_escape_string
$mtn_half = isset($_POST['mtn_half']) ? mysqli_real_escape_string($conn, $_POST['mtn_half']) : '';
$mtn_one = isset($_POST['mtn_one']) ? mysqli_real_escape_string($conn, $_POST['mtn_one']) : '';
$mtn_two = isset($_POST['mtn_two']) ? mysqli_real_escape_string($conn, $_POST['mtn_two']) : '';
$mtn_three = isset($_POST['mtn_three']) ? mysqli_real_escape_string($conn, $_POST['mtn_three']) : '';
$mtn_four = isset($_POST['mtn_four']) ? mysqli_real_escape_string($conn, $_POST['mtn_four']) : '';
$mtn_five = isset($_POST['mtn_five']) ? mysqli_real_escape_string($conn, $_POST['mtn_five']) : '';

$mtnCG_half = isset($_POST['mtnCG_half']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_half']) : '';
$mtnCG_one = isset($_POST['mtnCG_one']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_one']) : '';
$mtnCG_two = isset($_POST['mtnCG_two']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_two']) : '';
$mtnCG_three = isset($_POST['mtnCG_three']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_three']) : '';
$mtnCG_four = isset($_POST['mtnCG_four']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_four']) : '';
$mtnCG_five = isset($_POST['mtnCG_five']) ? mysqli_real_escape_string($conn, $_POST['mtnCG_five']) : '';

$airtel_half = isset($_POST['airtel_half']) ? mysqli_real_escape_string($conn, $_POST['airtel_half']) : '';
$airtel_one = isset($_POST['airtel_one']) ? mysqli_real_escape_string($conn, $_POST['airtel_one']) : '';
$airtel_two = isset($_POST['airtel_two']) ? mysqli_real_escape_string($conn, $_POST['airtel_two']) : '';
$airtel_three = isset($_POST['airtel_three']) ? mysqli_real_escape_string($conn, $_POST['airtel_three']) : '';
$airtel_four = isset($_POST['airtel_four']) ? mysqli_real_escape_string($conn, $_POST['airtel_four']) : '';
$airtel_five = isset($_POST['airtel_five']) ? mysqli_real_escape_string($conn, $_POST['airtel_five']) : '';

$glo_half = isset($_POST['glo_half']) ? mysqli_real_escape_string($conn, $_POST['glo_half']) : '';
$glo_one = isset($_POST['glo_one']) ? mysqli_real_escape_string($conn, $_POST['glo_one']) : '';
$glo_two = isset($_POST['glo_two']) ? mysqli_real_escape_string($conn, $_POST['glo_two']) : '';
$glo_three = isset($_POST['glo_three']) ? mysqli_real_escape_string($conn, $_POST['glo_three']) : '';
$glo_four = isset($_POST['glo_four']) ? mysqli_real_escape_string($conn, $_POST['glo_four']) : '';
$glo_five = isset($_POST['glo_five']) ? mysqli_real_escape_string($conn, $_POST['glo_five']) : '';

$mobile_half = isset($_POST['mobile_half']) ? mysqli_real_escape_string($conn, $_POST['mobile_half']) : '';
$mobile_one = isset($_POST['mobile_one']) ? mysqli_real_escape_string($conn, $_POST['mobile_one']) : '';
$mobile_two = isset($_POST['mobile_two']) ? mysqli_real_escape_string($conn, $_POST['mobile_two']) : '';
$mobile_three = isset($_POST['mobile_three']) ? mysqli_real_escape_string($conn, $_POST['mobile_three']) : '';
$mobile_four = isset($_POST['mobile_four']) ? mysqli_real_escape_string($conn, $_POST['mobile_four']) : '';
$mobile_five = isset($_POST['mobile_five']) ? mysqli_real_escape_string($conn, $_POST['mobile_five']) : '';

//Cable
$gotv_max = isset($_POST['gotv_max']) ? mysqli_real_escape_string($conn, $_POST['gotv_max']) : '';
$gotv_smallie = isset($_POST['gotv_smallie']) ? mysqli_real_escape_string($conn, $_POST['gotv_smallie']) : '';
$gotv_jinja = isset($_POST['gotv_jinja']) ? mysqli_real_escape_string($conn, $_POST['gotv_jinja']) : '';
$gotv_jolli = isset($_POST['gotv_jolli']) ? mysqli_real_escape_string($conn, $_POST['gotv_jolli']) : '';

$dstv_padi = isset($_POST['dstv_padi']) ? mysqli_real_escape_string($conn, $_POST['dstv_padi']) : '';
$dstv_great_wall_standalone = isset($_POST['dstv_great_wall_standalone']) ? mysqli_real_escape_string($conn, $_POST['dstv_great_wall_standalone']) : '';
$dstv_yanga = isset($_POST['dstv_yanga']) ? mysqli_real_escape_string($conn, $_POST['dstv_yanga']) : '';
$dstv_compact = isset($_POST['dstv_compact']) ? mysqli_real_escape_string($conn, $_POST['dstv_compact']) : '';

$startimes_basic = isset($_POST['startimes_basic']) ? mysqli_real_escape_string($conn, $_POST['startimes_basic']) : '';
$startimes_smart = isset($_POST['startimes_smart']) ? mysqli_real_escape_string($conn, $_POST['startimes_smart']) : '';
$startimes_nova = isset($_POST['startimes_nova']) ? mysqli_real_escape_string($conn, $_POST['startimes_nova']) : '';
$startimes_super = isset($_POST['startimes_super']) ? mysqli_real_escape_string($conn, $_POST['startimes_super']) : '';



// Insert/Update Data Plans
insertOrUpdateDataPlans(
    $conn,
    $mtn_half, $mtn_one, $mtn_two, $mtn_three, $mtn_four, $mtn_five,
    $mtnCG_half, $mtnCG_one, $mtnCG_two, $mtnCG_three, $mtnCG_four, $mtnCG_five,
    $airtel_half, $airtel_one, $airtel_two, $airtel_three, $airtel_four, $airtel_five,
    $glo_half, $glo_one, $glo_two, $glo_three, $glo_four, $glo_five,
    $mobile_half, $mobile_one, $mobile_two, $mobile_three, $mobile_four, $mobile_five
);

// Insert/Update Cable Plans
insertOrUpdateCablePlans(
    $conn,
    $gotv_max, $gotv_smallie, $gotv_jinja, $gotv_jolli,
    $dstv_padi, $dstv_great_wall_standalone, $dstv_yanga, $dstv_compact,
    $startimes_basic, $startimes_smart, $startimes_nova, $startimes_super
);

mysqli_close($conn);
?>
