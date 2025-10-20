<?php
include ("AdConnectLog.php");
if (!isset($_COOKIE['owner'])){
    header('location: AdminLogIn.php');
    exit;
}

$sql="SELECT * FROM `admin_det_reg` WHERE eMail LIKE '".$_COOKIE['owner']."'";
$user = array();

if($conn->query($sql) == TRUE){
    $sql="SELECT * FROM `admin_det_reg` WHERE eMail LIKE '".$_COOKIE['owner']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $user = $row;
        }
    } else {
        header('location: AdminLogIn.php');
        exit;
    }
} else {
    echo "Error: " .$sql."<br>".$conn->error;
}
$conn->close();
?>

<?php
// Error variables (you might want to display these on the page)
$errors = [
    'mtn' => [],
    'mtnCG' => [],
    'airtel' => [],
    'glo' => [],
    'mobile' => []
];

// Store values (you might want to repopulate the form with these)
$prices = [
    'mtn' => [],
    'mtnCG' => [],
    'airtel' => [],
    'glo' => [],
    'mobile' => []
];

include ("Admin_pricing_conn.php"); // Ensure this establishes $conn

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Process MTN pricing if MTN button is clicked
    if (isset($_POST['mtn-submit'])) {
        $prices['mtn']['500mb'] = test_input($_POST['mtn-500mb']);
        $prices['mtn']['1gb'] = test_input($_POST['mtn-1gb']);
        $prices['mtn']['2gb'] = test_input($_POST['mtn-2gb']);
        $prices['mtn']['3gb'] = test_input($_POST['mtn-3gb']);
        $prices['mtn']['4gb'] = test_input($_POST['mtn-4gb']);
        $prices['mtn']['5gb'] = test_input($_POST['mtn-5gb']);

        $valid = true;
        foreach ($prices['mtn'] as $price) {
            if (!is_numeric($price)) {
                $errors['mtn'][] = "Please enter numeric values for MTN prices.";
                $valid = false;
                break; // No need to check further if one is invalid
            }
        }

        if ($valid) {
            // Construct the SQL UPDATE query (replace 'pricing_table' and column names)
            $sql_mtn = "UPDATE pricing_table SET
                        mtn_500mb_price = ?,
                        mtn_1gb_price = ?,
                        mtn_2gb_price = ?,
                        mtn_3gb_price = ?,
                        mtn_4gb_price = ?,
                        mtn_5gb_price = ?
                        WHERE service_type = 'mtn_sme'"; // Assuming 'mtn_sme' identifies MTN SME

            // Use prepared statement for security
            $stmt_mtn = $conn->prepare($sql_mtn);
            if ($stmt_mtn) {
                $stmt_mtn->bind_param("dddddd",
                    $prices['mtn']['500mb'],
                    $prices['mtn']['1gb'],
                    $prices['mtn']['2gb'],
                    $prices['mtn']['3gb'],
                    $prices['mtn']['4gb'],
                    $prices['mtn']['5gb']
                );

                if ($stmt_mtn->execute()) {
                    echo "<script>alert('MTN prices updated successfully!');</script>";
                    // Optionally redirect: header('location: Admin_Pricing.php');
                } else {
                    echo "<script>alert('Error updating MTN prices: " . $stmt_mtn->error . "');</script>";
                }
                $stmt_mtn->close();
            } else {
                echo "<script>alert('Error preparing MTN update statement: " . $conn->error . "');</script>";
            }
        } else {
            // Display errors for MTN (you'll need a way to show these in your HTML)
            foreach ($errors['mtn'] as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }

    // Process MTN CG pricing if MTN CG button is clicked
    if (isset($_POST['mtnCG-submit'])) {
        $prices['mtnCG']['500mb'] = test_input($_POST['mtn-500mb']); // Note: You're using the same name as MTN SME
        $prices['mtnCG']['1gb'] = test_input($_POST['mtn-1gb']);     // Ensure correct names in your HTML
        $prices['mtnCG']['2gb'] = test_input($_POST['mtn-2gb']);
        $prices['mtnCG']['3gb'] = test_input($_POST['mtn-3gb']);
        $prices['mtnCG']['4gb'] = test_input($_POST['mtn-4gb']);
        $prices['mtnCG']['5gb'] = test_input($_POST['mtn-5gb']);

        $valid_cg = true;
        foreach ($prices['mtnCG'] as $price) {
            if (!is_numeric($price)) {
                $errors['mtnCG'][] = "Please enter numeric values for MTN CG prices.";
                $valid_cg = false;
                break;
            }
        }

        if ($valid_cg) {
            $sql_mtn_cg = "UPDATE pricing_table SET
                           mtn_cg_500mb_price = ?,
                           mtn_cg_1gb_price = ?,
                           mtn_cg_2gb_price = ?,
                           mtn_cg_3gb_price = ?,
                           mtn_cg_4gb_price = ?,
                           mtn_cg_5gb_price = ?
                           WHERE service_type = 'mtn_cg'"; // Assuming 'mtn_cg' identifies MTN CG

            $stmt_mtn_cg = $conn->prepare($sql_mtn_cg);
            if ($stmt_mtn_cg) {
                $stmt_mtn_cg->bind_param("dddddd",
                    $prices['mtnCG']['500mb'],
                    $prices['mtnCG']['1gb'],
                    $prices['mtnCG']['2gb'],
                    $prices['mtnCG']['3gb'],
                    $prices['mtnCG']['4gb'],
                    $prices['mtnCG']['5gb']
                );

                if ($stmt_mtn_cg->execute()) {
                    echo "<script>alert('MTN CG prices updated successfully!');</script>";
                } else {
                    echo "<script>alert('Error updating MTN CG prices: " . $stmt_mtn_cg->error . "');</script>";
                }
                $stmt_mtn_cg->close();
            } else {
                echo "<script>alert('Error preparing MTN CG update statement: " . $conn->error . "');</script>";
            }
        } else {
            foreach ($errors['mtnCG'] as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }

    // Process Airtel pricing if Airtel button is clicked
    if (isset($_POST['airtel-submit'])) {
        // Similar logic as MTN, retrieve and validate Airtel prices
        $airtel_500mb = test_input($_POST['airtel-500mb']);
        $airtel_1gb = test_input($_POST['airtel-1gb']);
        $airtel_2gb = test_input($_POST['airtel-2gb']); // Corrected ID
        $airtel_3gb = test_input($_POST['airtel-3gb']); // Corrected ID
        $airtel_4gb = test_input($_POST['airtel-4gb']); // Corrected ID
        $airtel_5gb = test_input($_POST['airtel-5gb']); // Corrected ID

        $prices['airtel'] = [$airtel_500mb, $airtel_1gb, $airtel_2gb, $airtel_3gb, $airtel_4gb, $airtel_5gb];
        $valid_airtel = true;
        foreach ($prices['airtel'] as $price) {
            if (!is_numeric($price)) {
                $errors['airtel'][] = "Please enter numeric values for Airtel prices.";
                $valid_airtel = false;
                break;
            }
        }

        if ($valid_airtel) {
            $sql_airtel = "UPDATE pricing_table SET
                            airtel_500mb_price = ?,
                            airtel_1gb_price = ?,
                            airtel_2gb_price = ?,
                            airtel_3gb_price = ?,
                            airtel_4gb_price = ?,
                            airtel_5gb_price = ?
                            WHERE service_type = 'airtel'"; // Assuming 'airtel' identifies Airtel

            $stmt_airtel = $conn->prepare($sql_airtel);
            if ($stmt_airtel) {
                $stmt_airtel->bind_param("dddddd", ...$prices['airtel']);
                if ($stmt_airtel->execute()) {
                    echo "<script>alert('Airtel prices updated successfully!');</script>";
                } else {
                    echo "<script>alert('Error updating Airtel prices: " . $stmt_airtel->error . "');</script>";
                }
                $stmt_airtel->close();
            } else {
                echo "<script>alert('Error preparing Airtel update statement: " . $conn->error . "');</script>";
            }
        } else {
            foreach ($errors['airtel'] as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }

    // Process Glo pricing if Glo button is clicked (you'll need to adjust the button type to submit)
    if (isset($_POST['glo-submit'])) {
        $glo_500mb = test_input($_POST['glo-500mb']); // Make sure your HTML has name="glo-500mb" etc.
        $glo_1gb = test_input($_POST['glo-1gb']);
        $glo_2gb = test_input($_POST['glo-2gb']);
        $glo_3gb = test_input($_POST['glo-3gb']);
        $glo_4gb = test_input($_POST['glo-4gb']);
        $glo_5gb = test_input($_POST['glo-5gb']);

        $prices['glo'] = [$glo_500mb, $glo_1gb, $glo_2gb, $glo_3gb, $glo_4gb, $glo_5gb];
        $valid_glo = true;
        foreach ($prices['glo'] as $price) {
            if (!is_numeric($price)) {
                $errors['glo'][] = "Please enter numeric values for GLO prices.";
                $valid_glo = false;
                break;
            }
        }

        if ($valid_glo) {
            $sql_glo = "UPDATE pricing_table SET
                         glo_500mb_price = ?,
                         glo_1gb_price = ?,
                         glo_2gb_price = ?,
                         glo_3gb_price = ?,
                         glo_4gb_price = ?,
                         glo_5gb_price = ?
                         WHERE service_type = 'glo'"; // Assuming 'glo' identifies GLO

            $stmt_glo = $conn->prepare($sql_glo);
            if ($stmt_glo) {
                $stmt_glo->bind_param("dddddd", ...$prices['glo']);
                if ($stmt_glo->execute()) {
                    echo "<script>alert('GLO prices updated successfully!');</script>";
                } else {
                    echo "<script>alert('Error updating GLO prices: " . $stmt_glo->error . "');</script>";
                }
                $stmt_glo->close();
            } else {
                echo "<script>alert('Error preparing GLO update statement: " . $conn->error . "');</script>";
            }
        } else {
            foreach ($errors['glo'] as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }

    // Process 9Mobile pricing if 9Mobile button is clicked (you'll need to adjust the button type to submit)
    if (isset($_POST['mobile-submit'])) {
        $mobile_500mb = test_input($_POST['mobile-500mb']); // Make sure your HTML has name="mobile-500mb" etc.
        $mobile_1gb = test_input($_POST['mobile-1gb']);
        $mobile_2gb = test_input($_POST['mobile-2gb']);
        $mobile_3gb = test_input($_POST['mobile-3gb']);
        $mobile_4gb = test_input($_POST['mobile-4gb']);
        $mobile_5gb = test_input($_POST['mobile-5gb']);

        $prices['mobile'] = [$mobile_500mb, $mobile_1gb, $mobile_2gb, $mobile_3gb, $mobile_4gb, $mobile_5gb];
        $valid_mobile = true;
        foreach ($prices['mobile'] as $price) {
            if (!is_numeric($price)) {
                $errors['mobile'][] = "Please enter numeric values for 9Mobile prices.";
                $valid_mobile = false;
                break;
            }
        }

        if ($valid_mobile) {
            $sql_mobile = "UPDATE pricing_table SET
                            ninemobile_500mb_price = ?,
                            ninemobile_1gb_price = ?,
                            ninemobile_2gb_price = ?,
                            ninemobile_3gb_price = ?,
                            ninemobile_4gb_price = ?,
                            ninemobile_5gb_price = ?
                            WHERE service_type = '9mobile'"; // Assuming '9mobile' identifies 9Mobile

            $stmt_mobile = $conn->prepare($sql_mobile);
            if ($stmt_mobile) {
                $stmt_mobile->bind_param("dddddd", ...$prices['mobile']);
                if ($stmt_mobile->execute()) {
                    echo "<script>alert('9Mobile prices updated successfully!');</script>";
                } else {
                    echo "<script>alert('Error updating 9Mobile prices: " . $stmt_mobile->error . "');</script>";
                }
                $stmt_mobile->close();
            } else {
                echo "<script>alert('Error preparing 9Mobile update statement: " . $conn->error . "');</script>";
            }
        } else {
            foreach ($errors['mobile'] as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PRICING</title>
    <link rel="stylesheet" href="..\Admin\Admin_Pricing.css">
    <script src="admin.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>   

</head>
<body>
<nav class="navbar navbar-expand-xl navbar-white bg-white">
        <button type="button" id="sidebarCollapse" class="btn btn-primary icon">
            <i class="fas fa-bars"></i>
        </button>
        <div id="inDline"> 

            <button id="closeSidebar">&times;</button> <!-- Close icon -->
                <img class="myImage" src="..\images\IMG-20240326-WA0118.jpg" alt="Admin Image">
            <div class="new"><p class="myP"><span class="fa-solid fa-home" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminDashBoard.php" >Dashboard</a></p></div>
            <div class="new"><p class="myP"><span class="fa fa-file-code-o" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminGateways.php" >Gateways</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-money-bill" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin_Pricing.php" >Pricing</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-user-friends" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminUsers.php" >Users</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-users-between-lines" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminPackages.php" >Packages</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-history" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminTransaction.php" >Transaction History</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-code" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminDeveloper.php">Developer</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-toggle-on" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminSwitch.php" >Service Switch</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-gear" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminSettings.php" >Settings</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-gear" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminCheckUpdate.php" >Check for Update </a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-right-from-bracket" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin.php" >Log Out</a></p></div>
        </div>    
    </nav>
    <div class="atRight">
    <div class="main-container">
        <div class="pricing">
            Pricing
        </div>
        <br>
        <div class="nav-buttons">
        <button class="button-data" onclick="showData()">DATA</button>
        <button class="button-cable" onclick="showCable()">Cable</button>
        </div>
        <hr>
    <div class="data-content">
    <div class="data-buttons">
        <button class="button_mtn" onclick="showMTNContainers()">MTN <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_airtel" onclick="showAIRTELContainers('container_airtel')">AIRTEL <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_glo" onclick="showGLOContainers('container_glo')">GLO <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_mobile" onclick="showMobileContainers('container_mobile')">9 MOBILE <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
    </div>
            <div class="container_mtn">
            <div class="mtn">
                MTN SME
            </div>
<form method="POST" action="Admin_Pricing.php">
    <h1>MTN Data Pricing</h1>
    <label>MTN 500 MB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-500mb" id="mtn-500mb"><span class="span">.00</span><br>
    <label>MTN 1.0GB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-1gb" id="mtn-1gb"><span class="span">.00</span><br>
    <label>MTN 2.0GB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-2gb" id="mtn-2gb"><span class="span">.00</span><br>
    <label>MTN 3.0GB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-3gb" id="mtn-3gb"><span class="span">.00</span><br>
    <label>MTN 4.0GB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-4gb" id="mtn-4gb"><span class="span">.00</span><br>
    <label>MTN 5.0GB</label><br>
    <span class="span">NGN</span><input type="text" name="mtn-5gb" id="mtn-5gb"><span class="span">.00</span><br>
    <button type="submit" name="mtn-submit" class="click"><i class="fa-solid fa-check"></i> Update MTN Price</button>

        </div>

        <div class="container_mtn_cg">
        <div class="mtn_cg">
            MTN CG
        </div>
        <h1>MTN CG Data Pricing</h1>
        <label>MTN 500 MB</label><br>
        <span class="span">NGN</span> <input type="text"  name="mtn-500mb" id="mtnCG-500mb"> <span class="span"> .00</span>
        <br>
        <label>MTN 1.0GB</label><br>
        <span class="span">NGN</span> <input type="text"  name="mtn-1gb" id="mtnCG-1gb"><span class="span"> .00</span>
        <br>
        <label>MTN 2.0GB</label><br>
        <span class="span">NGN</span><input type="text"  name="mtn-2gb" id="mtnCG-2gb"><span class="span"> .00</span>
        <br>
        <label>MTN 3.0GB</label><br>
        <span class="span">NGN</span><input type="text"  name="mtn-3gb" id="mtnCG-3gb"><span class="span"> .00</span>
        <br>
        <label>MTN 4.0GB</label><br>
        <span class="span">NGN</span> <input type="text"  name="mtn-4gb" id="mtnCG-4gb"><span class="span"> .00</span>
        <br>
        <label>MTN 5.0GB</label><br>
        <span class="span">NGN</span> <input type="text"  name="mtn-5gb" id="mtnCG-5gb"><span class="span"> .00</span>
        <br>

        <button type="submit" class="click" onclick="updateMtnCGPrices()"><i class="fa-solid fa-check"></i> Update Price</button>
</div>

        <div class="container_airtel">
            <div class="airtel">
                AIRTEL
            </div>
            <h1>AIRTEL Data Pricing</h1>
            <label>AIRTEL 500 MB</label><br>
            <span class="span">NGN <input type="text" name="airtel-500mb" id="airtel-500mb"> .00</span>
            <br>
            <label>AIRTEL 1.0GB</label><br>
            <span class="span">NGN <input type="text" name="airtel-1gb" id="airtel-1gb"> .00</span>
            <br>
            <label>AIRTEL 2.0GB</label><br>
            <span class="span">NGN <input type="text" name="airtel-1gb" id="airtel-2gb"> .00</span>
            <br>
            <label>AIRTEL 3.0GB</label><br>
            <span class="span">NGN <input type="text" name="airtel-1gb" id="airtel-3gb"> .00</span>
            <br>
            <label>AIRTEL 4.0GB</label><br>
            <span class="span">NGN <input type="text" name="airtel-1gb" id="airtel-4gb"> .00</span>
            <br>
            <label>AIRTEL 5.0GB</label><br>
            <span class="span">NGN <input type="text" name="airtel-1gb" id="airtel-5gb"> .00</span>
            <br>
            <button type="submit" class="click" onclick="updateAirtelPrices()"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>

        <div class="container_glo">
            <div class="glo">
                GLO
            </div>
            <h1>GLO Data Pricing</h1>
            <label>GLO 500 MB</label><br>
            <span class="span">NGN <input type="text" id="glo-500mb"> .00</span>
            <br>
            <label>GLO 1.0GB</label><br>
            <span class="span">NGN <input type="text" id="glo-1gb"> .00</span>
            <br>
            <label>GLO 2.0GB</label><br>
            <span class="span">NGN <input type="text" id="glo-2gb"> .00</span>
            <br>
            <label>GLO 3.0GB</label><br>
            <span class="span">NGN <input type="text" id="glo-3gb"> .00</span>
            <br>
            <label>GLO 4.0GB</label><br>
            <span class="span">NGN <input type="text" id="glo-4gb"> .00</span>
            <br>
            <label>GLO 5.0GB</label><br>
            <span class="span">NGN <input type="text" id="glo-5gb"> .00</span>
            <br>
            <button type="button" class="click_glo_mobile" onclick="updateGloPrices()"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>

        <div class="container_mobile">
            <div class="mobile">
                9 MOBILE
            </div>
            <h1>9MOBILE Data Pricing</h1>
            <label>9 MOBILE 500 MB</label><br>
            <span class="span">NGN <input type="text" id="mobile-500mb"> .00</span>
            <br>
            <label>9 MOBILE 1.0GB</label><br>
            <span class="span">NGN <input type="text" id="mobile-1gb"> .00</span>
            <br>
            <label>9 MOBILE 2.0GB</label><br>
            <span class="span">NGN <input type="text" id="mobile-2gb"> .00</span>
            <br>
            <label>9 MOBILE 3.0GB</label><br>
            <span class="span">NGN <input type="text" id="mobile-3gb"> .00</span>
            <br>
            <label>9 MOBILE 4.0GB</label><br>
            <span class="span">NGN <input type="text" id="mobile-4gb"> .00</span>
            <br>
            <label>9 MOBILE 5.0GB</label><br>
            <span class="span">NGN <input type="text" id="mobile-5gb"> .00</span>
            <br>
            <button type="button" class="click_glo_mobile" onclick="updateMobilePrices()"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>
</div>

    <!-- Data Price Update Ends Here-->
    
    <!-- Butttons for accessing cable plans -->
     <div class="cable-content">
    <div class="cables-buttons" id="cables-buttons" style="display: none;">
        <button class="button_gotv" onclick="cablesshow('container_gotv')"><b class="gotv1">GO</b>TV</b> <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_dstv" onclick="cablesshow('container_dstv')">DSTV <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_startimes" onclick="cablesshow('container_startimes')">STARTIMES <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
    </div>
    <!-- End of cable plan button -->
</form>
    <!-- Cable Price Starts Here -->
    <div class="container_gotv" id="container_gotv" style="display: none">
            <div class="gotv">
                GoTV
            </div>
            <h1>GOTV PLAN PRICING</h1>
            <label>GOTV MAX</label><br>
            <span class="span">NGN <input type="text" id="gotv_max"> .00</span>
            <br>
            <label>GOTV SMALLIE</label><br>
            <span class="span">NGN <input type="text" id="gotv-smallie"> .00</span>
            <br>
            <label>GOTV JINJA</label><br>
            <span class="span">NGN <input type="text" id="gotv-jinja"> .00</span>
            <br>
            <label>GOTV JOLLI</label><br>
            <span class="span">NGN <input type="text" id="gotv-jolli"> .00</span>
            <br>
            <button type="button" class="click" onclick="updateGoTVPrice()"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>

        <div class="container_dstv" id="container-dstv" style="display: none">
        <div class="dstv">
            DSTV
        </div>
        <h1>DSTV PLAN PRICING</h1>
        <label>DSTV PADI</label><br>
        <span class="span">NGN <input type="text"> .00</span>
        <br>
        <label>DSTV GREAT WALL STANDALONE</label><br>
        <span class="span">NGN <input type="text"> .00</span>
        <br>
        <label>DSTV YANGA</label><br>
        <span class="span">NGN <input type="text"> .00</span>
        <br>
        <label>DSTV COMPACT</label><br>
        <span class="span">NGN <input type="text"> .00</span>
        <br>
        <button type="button" class="click"><i class="fa-solid fa-check"></i> Update Price</button>
</div>

        <div class="container_startimes" id="container-startimes" style="display: none">
            <div class="startimes">
                STARTIMES
            </div>
            <h1>STARTIMES PLAN PRICING</h1>
            <label>BASIC</label><br>
            <span class="span">NGN <input type="text" id="startimes-basic"> .00</span>
            <br>
            <label>SMART</label><br>
            <span class="span">NGN <input type="text" id="startimes-smart"> .00</span>
            <br>
            <label>NOVA</label><br>
            <span class="span">NGN <input type="text" id="startimes-nova"> .00</span>
            <br>
            <label>SUPER</label><br>
            <span class="span">NGN <input type="text" id="startimes-super"> .00</span>
            <br>
            <button type="button" class="click"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>

    <!-- Cable Price Ends Here -->
    </div> <!-- End of The basic conatiner -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('inDline');
    const button = document.getElementById('sidebarCollapse');
    const closeButton = document.getElementById('closeSidebar');
    
    // Toggle sidebar visibility on button click
    button.addEventListener('click', function() {
        if (sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        } else {
            sidebar.classList.add('show');
        }
    });
    
    // Close sidebar on close button click
    closeButton.addEventListener('click', function() {
        sidebar.classList.remove('show');
    });
});

    </script>
</body>
</html>