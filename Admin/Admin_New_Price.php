<?php
include ("AdConnectLog.php");

// Redirect if not logged in
if (!isset($_COOKIE['owner'])) {
    header('location: AdminLogIn.php');
    exit;
}

// Function to update data plan prices
function updateDataPlanPrices($conn, $network, $half, $one, $two, $three, $four, $five) {
    $sql = "UPDATE data_plans
            SET {$network}_half=?, {$network}_one=?, {$network}_two=?, {$network}_three=?, {$network}_four=?, {$network}_five=?, updated_at=CURRENT_TIMESTAMP
            WHERE id=1"; // Assuming id=1 for all data plans

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $half, $one, $two, $three, $four, $five);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo ucfirst($network) . " prices updated successfully.";
    } else {
        echo "Error updating " . ucfirst($network) . " prices.";
    }
    $stmt->close();
}

// Function to update cable plan prices
function updateCablePlanPrices($conn, $planType, $price) {
    $sql = "UPDATE cable_plans
            SET {$planType}=?, updated_at=CURRENT_TIMESTAMP
            WHERE id=1"; // Assuming id=1 for all cable plans

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $price); // Assuming price is text for now, adjust if needed
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo ucfirst(str_replace('_', ' ', $planType)) . " price updated successfully.";
    } else {
        echo "Error updating " . ucfirst(str_replace('_', ' ', $planType)) . " price.";
    }
    $stmt->close();
}

// Handle MTN submission
if (isset($_POST['mtn-submit'])) {
    $mtn_half = $_POST['mtn_half'];
    $mtn_one = $_POST['mtn_one'];
    $mtn_two = $_POST['mtn_two'];
    $mtn_three = $_POST['mtn_three'];
    $mtn_four = $_POST['mtn_four'];
    $mtn_five = $_POST['mtn_five'];
    updateDataPlanPrices($conn, 'mtn', $mtn_half, $mtn_one, $mtn_two, $mtn_three, $mtn_four, $mtn_five);
}

// Handle MTN CG submission
if (isset($_POST['mtnCG-submit'])) {
    $mtnCG_half = $_POST['mtnCG_half'];
    $mtnCG_one = $_POST['mtnCG_one'];
    $mtnCG_two = $_POST['mtnCG_two'];
    $mtnCG_three = $_POST['mtnCG_three'];
    $mtnCG_four = $_POST['mtnCG_four'];
    $mtnCG_five = $_POST['mtnCG_five'];
    updateDataPlanPrices($conn, 'mtnCG', $mtnCG_half, $mtnCG_one, $mtnCG_two, $mtnCG_three, $mtnCG_four, $mtnCG_five);
}

// Handle Airtel submission
if (isset($_POST['airtel-submit'])) {
    $airtel_half = $_POST['airtel_half'];
    $airtel_one = $_POST['airtel_one'];
    $airtel_two = $_POST['airtel_two'];
    $airtel_three = $_POST['airtel_three'];
    $airtel_four = $_POST['airtel_four'];
    $airtel_five = $_POST['airtel_five'];
    updateDataPlanPrices($conn, 'airtel', $airtel_half, $airtel_one, $airtel_two, $airtel_three, $airtel_four, $airtel_five);
}

// Handle Glo submission
if (isset($_POST['glo-submit'])) {
    $glo_half = $_POST['glo_half'];
    $glo_one = $_POST['glo_one'];
    $glo_two = $_POST['glo_two'];
    $glo_three = $_POST['glo_three'];
    $glo_four = $_POST['glo_four'];
    $glo_five = $_POST['glo_five'];
    updateDataPlanPrices($conn, 'glo', $glo_half, $glo_one, $glo_two, $glo_three, $glo_four, $glo_five);
}

// Handle 9Mobile submission
if (isset($_POST['mobile-submit'])) {
    $mobile_half = $_POST['mobile_half'];
    $mobile_one = $_POST['mobile_one'];
    $mobile_two = $_POST['mobile_two'];
    $mobile_three = $_POST['mobile_three'];
    $mobile_four = $_POST['mobile_four'];
    $mobile_five = $_POST['mobile_five'];
    updateDataPlanPrices($conn, 'mobile', $mobile_half, $mobile_one, $mobile_two, $mobile_three, $mobile_four, $mobile_five);
}

// Handle GoTV submission
if (isset($_POST['gotv-submit'])) {
    $gotv_max = $_POST['gotv_max'];
    $gotv_smallie = $_POST['gotv_smallie'];
    $gotv_jinja = $_POST['gotv_jinja'];
    $gotv_jolli = $_POST['gotv_jolli'];
    updateCablePlanPrices($conn, 'gotv_max', $gotv_max);
    updateCablePlanPrices($conn, 'gotv_smallie', $gotv_smallie);
    updateCablePlanPrices($conn, 'gotv_jinja', $gotv_jinja);
    updateCablePlanPrices($conn, 'gotv_jolli', $gotv_jolli);
}

// Handle DSTV submission (you'll need to add names to your DSTV input fields)
if (isset($_POST['dstv-submit'])) {
    $dstv_padi = $_POST['dstv_padi'];
    $dstv_great_wall_standalone = $_POST['dstv_great_wall_standalone'];
    $dstv_yanga = $_POST['dstv_yanga'];
    $dstv_compact = $_POST['dstv_compact'];
    updateCablePlanPrices($conn, 'dstv_padi', $dstv_padi);
    updateCablePlanPrices($conn, 'dstv_great_wall_standalone', $dstv_great_wall_standalone);
    updateCablePlanPrices($conn, 'dstv_yanga', $dstv_yanga);
    updateCablePlanPrices($conn, 'dstv_compact', $dstv_compact);
}

// Handle Startimes submission (you'll need to add names to your Startimes input fields)
if (isset($_POST['startimes-submit'])) {
    $startimes_basic = $_POST['startimes_basic'];
    $startimes_smart = $_POST['startimes_smart'];
    $startimes_nova = $_POST['startimes_nova'];
    $startimes_super = $_POST['startimes_super'];
    updateCablePlanPrices($conn, 'startimes_basic', $startimes_basic);
    updateCablePlanPrices($conn, 'startimes_smart', $startimes_smart);
    updateCablePlanPrices($conn, 'startimes_nova', $startimes_nova);
    updateCablePlanPrices($conn, 'startimes_super', $startimes_super);
}

$conn->close();
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

            <button id="closeSidebar">&times;</button> <img class="myImage" src="..\images\IMG-20240326-WA0118.jpg" alt="Admin Image">
            <div class="new"><p class="myP"><span class="fa-solid fa-home" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminDashBoard.php" >Dashboard</a></p></div>
            <div class="new"><p class="myP"><span class="fa fa-file-code-o" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminGateways.php" >Gateways</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-money-bill" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin_New_Price.php" >DataPricing</a></p></div>
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

    <form method="POST">
        <div class="container_mtn">
            <h1>MTN Data Pricing</h1>
            <label>MTN 500 MB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_half" id="mtn-500mb"><span class="span"> .00</span><br>
            <label>MTN 1.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_one" id="mtn-1gb"><span class="span"> .00</span><br>
            <label>MTN 2.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_two" id="mtn-2gb"> <span class="span"> .00</span><br>
            <label>MTN 3.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_three" id="mtn-3gb"><span class="span"> .00</span><br>
            <label>MTN 4.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_four" id="mtn-4gb"><span class="span"> .00</span><br>
            <label>MTN 5.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtn_five" id="mtn-5gb"><span class="span"> .00</span><br>
            <button type="submit" name="mtn-submit" class="click">Update MTN Prices</button>
        </div>
    </form>

    <form method="POST">
        <div class="container_mtn_cg">
            <h1>MTN CG Data Pricing</h1>
            <label>MTN CG 500 MB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_half" id="mtnCG-500mb"> <span class="span"> .00</span><br>
            <label>MTN CG 1.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_one" id="mtnCG-1gb"> <span class="span"> .00</span><br>
            <label>MTN CG 2.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_two" id="mtnCG-2gb"> <span class="span"> .00</span><br>
            <label>MTN CG 3.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_three" id="mtnCG-3gb"> <span class="span"> .00</span><br>
            <label>MTN CG 4.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_four" id="mtnCG-4gb"> <span class="span"> .00</span><br>
            <label>MTN CG 5.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mtnCG_five" id="mtnCG-5gb"> <span class="span"> .00</span><br>
            <button type="submit" name="mtnCG-submit" class="click">Update MTN CG Prices</button>
        </div>
    </form>

    <!-- Airtel Pricing -->
    <form method="POST">
        <div class="container_airtel">
            <h1>AIRTEL Data Pricing</h1>
            <label>AIRTEL 500 MB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_half" id="airtel-500mb"> <span class="span"> .00</span><br>
            <label>AIRTEL 1.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_one" id="airtel-1gb"> <span class="span"> .00</span><br>
            <label>AIRTEL 2.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_two" id="airtel-2gb"> <span class="span"> .00</span><br>
            <label>AIRTEL 3.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_three" id="airtel-3gb"> <span class="span"> .00</span><br>
            <label>AIRTEL 4.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_four" id="airtel-4gb"> <span class="span"> .00</span><br>
            <label>AIRTEL 5.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="airtel_five" id="airtel-5gb"> <span class="span"> .00</span><br>
            <button type="submit" name="airtel-submit" class="click">Update Airtel Prices</button>
        </div>
    </form>

    <!-- GLO Pricing -->
    <form method="POST">
        <div class="container_glo">
            <h1>GLO Data Pricing</h1>
            <label>GLO 500 MB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_half" id="glo-500mb"> <span class="span"> .00</span><br>
            <label>GLO 1.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_one" id="glo-1gb"> <span class="span"> .00</span><br>
            <label>GLO 2.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_two" id="glo-2gb"> <span class="span"> .00</span><br>
            <label>GLO 3.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_three" id="glo-3gb"> <span class="span"> .00</span><br>
            <label>GLO 4.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_four" id="glo-4gb"> <span class="span"> .00</span><br>
            <label>GLO 5.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="glo_five" id="glo-5gb"> <span class="span"> .00</span><br>
            <button type="submit" name="glo-submit" class="click">Update GLO Prices</button>
        </div>
    </form>

    <!-- 9Mobile Pricing -->
    <form  method="POST">
        <div class="container_mobile">
            <h1>9Mobile Data Pricing</h1>
            <label>9Mobile 500 MB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_half" id="mobile-500mb"> <span class="span"> .00</span><br>
            <label>9Mobile 1.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_one" id="mobile-1gb"> <span class="span"> .00</span><br>
            <label>9Mobile 2.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_two" id="mobile-2gb"> <span class="span"> .00</span><br>
            <label>9Mobile 3.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_three" id="mobile-3gb"> <span class="span"> .00</span><br>
            <label>9Mobile 4.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_four" id="mobile-4gb"> <span class="span"> .00</span><br>
            <label>9Mobile 5.0GB</label><br>
            <span class="span">NGN</span><input type="text" name="mobile_five" id="mobile-5gb"> <span class="span"> .00</span><br>
            <button type="submit" name="mobile-submit" class="click">Update 9Mobile Prices</button>
        </div>
    </form>

    <!-- Data Price Update Ends Here-->
    
    <!-- Butttons for accessing cable plans -->
     </div>
    <div class="cable-content">
    <div class="cables-buttons" id="cables-buttons" style="display: none;">
        <button class="button_gotv" onclick="cablesshow('container_gotv')"><b class="gotv1">GO</b>TV</b> <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_dstv" onclick="cablesshow('container_dstv')">DSTV <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
        <button class="button_startimes" onclick="cablesshow('container_startimes')">STARTIMES <i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>
    </div>
    <!-- End of cable plan button -->


   

    <!-- Cable Price Starts Here -->
    <form method="POST">
    <div class="container_gotv" id="container_gotv" style="display: none">
            <div class="gotv">
                GoTV
            </div>
            <h1>GOTV PLAN PRICING</h1>
            <label>GOTV MAX</label><br>
            <span class="span">NGN <input type="text" id="gotv_max" name="gotv_max"> .00</span>
            <br>
            <label>GOTV SMALLIE</label><br>
            <span class="span">NGN <input type="text" id="gotv-smallie" name="gotv_smallie"> .00</span>
            <br>
            <label>GOTV JINJA</label><br>
            <span class="span">NGN <input type="text" id="gotv-jinja" name="gotv_jinja"> .00</span>
            <br>
            <label>GOTV JOLLI</label><br>
            <span class="span">NGN <input type="text" id="gotv-jolli" name="gotv_jolli"> .00</span>
            <br>
            <button type="submit" class="click" name="gotv-submit"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>
</form>



<form method="POST">
        <div class="container_dstv" id="container-dstv" style="display: none">
        <div class="dstv">
            DSTV
        </div>
        <h1>DSTV PLAN PRICING</h1>
        <label>DSTV PADI</label><br>
        <span class="span">NGN <input type="text" name="dstv_padi"> .00</span>
        <br>
        <label>DSTV GREAT WALL STANDALONE</label><br>
        <span class="span">NGN <input type="text" name="dstv_great_wall_standalone"> .00</span>
        <br>
        <label>DSTV YANGA</label><br>
        <span class="span">NGN <input type="text" name="dstv_yanga"> .00</span>
        <br>
        <label>DSTV COMPACT</label><br>
        <span class="span">NGN <input type="text" name="dstv_compact"> .00</span>
        <br>
        <button type="submit" class="click" name="dstv-submit"><i class="fa-solid fa-check"></i> Update Price</button>
</div>
</form>



<form method="POST">
        <div class="container_startimes" id="container-startimes" style="display: none">
            <div class="startimes">
                STARTIMES
            </div>
            <h1>STARTIMES PLAN PRICING</h1>
            <label>BASIC</label><br>
            <span class="span">NGN <input type="text" id="startimes-basic" name="startimes_basic"> .00</span>
            <br>
            <label>SMART</label><br>
            <span class="span">NGN <input type="text" id="startimes-smart" name="startimes_smart"> .00</span>
            <br>
            <label>NOVA</label><br>
            <span class="span">NGN <input type="text" id="startimes-nova" name="startimes_nova"> .00</span>
            <br>
            <label>SUPER</label><br>
            <span class="span">NGN <input type="text" id="startimes-super" name="startimes_super"> .00</span>
            <br>
            <button type="submit" class="click" name="startimes-submit"><i class="fa-solid fa-check"></i> Update Price</button>
        </div>
</form>
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
    <script src="admin.js"></script>
</body>
</html>