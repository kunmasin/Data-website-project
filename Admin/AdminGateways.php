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
        // output data of each row
        while($row = $result->fetch_assoc()) {
           $user = $row; 
        }
    }else{
        header('location: AdminLogIn.php');
        exit;
    }
    
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN GATEWAYS</title>
    <link rel="stylesheet" href="..\Admin\AdminGateway.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>   
    <script src="AdminGateway.js"></script> 

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
            <div class="new"><p class="myP"><span class="fa-solid fa-money-bill" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin_New_Price.php" >Pricing</a></p></div>
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
            Gateways
        </div>
        <br>
        <div class="nav-buttons">
            <button class="button-airtime" onclick="showContainer('container_airtime')">Airtime</button>
            <button class="button-data" onclick="showContainer('container_data')">Data</button>
            <button class="button-bill" onclick="showContainer('container_bill')">Bill</button>
            <button class="button-cables" onclick="showContainer('container_cables')">Cable</button>
        </div>
        <hr>

            <div id="container_airtime" class="container">
            <div class="airtime">
                Airtime Gateways
            </div>
            <h1>Airtime Settings and Documentation</h1>
            <label>Airtime Staus</label><br>
            <select name="" id="">
                <option value="">Active</option>
                <option value="">Activate</option>
                <option value="">Deactivate</option>
            </select>
            <br>
            <label>Airtime API URL</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Header Authorization</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Service Parameters</label><br>
            <span class="span">Amount Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Amount">
            <br>
            <span class="span">Phone Number /Id</span><input class="input1 type="text" id="mtn-4gb" value="Mobile Number">
            <br>
            <span class="span">Network Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Network">
            <br>
            <span class="span">Request Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Request Id">
            <br>
            <label>Service Ids</label><br>
            <span class="span">MTN</span><input class="input1 type="text" id="mtn-4gb" value="1">
            <br>
            <span class="span">AIRTEL</span><input class="input1 type="text" id="mtn-4gb" value="2">
            <br>
            <span class="span">GLO</span><input class="input1 type="text" id="mtn-4gb" value="3">
            <br>
            <span class="span">9MOBILE</span><input class="input1 type="text" id="mtn-4gb" value="4">
            <br>
            <button type="button" class="click" onclick="updateMtnPrices()"><i class="fa-solid fa-check"></i> Save Settings</button>
        </div>


        <div id="container_data" class="container">
        <div class="data">
                Data Gateways
            </div>
            <h1>Data Settings and Documentations....</h1>
            <label>Data Staus</label><br>
            <select name="" id="">
                <option value="">Active</option>
                <option value="">Activate</option>
                <option value="">Deactivate</option>
            </select>
            <br>
            <label>Data API URL</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Header Authorization</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Service Parameters</label><br>
            <span class="span">Amount Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Amount">
            <br>
            <span class="span">Phone Number /Id</span><input class="input1 type="text" id="mtn-4gb" value="Mobile Number">
            <br>
            <span class="span">Network Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Network">
            <br>
            <span class="span">Request Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Request Id">
            <br>
            <label>Service Ids</label><br>
            <span class="span">MTN</span><input class="input1 type="text" id="mtn-4gb" value="1">
            <br>
            <span class="span">AIRTEL</span><input class="input1 type="text" id="mtn-4gb" value="2">
            <br>
            <span class="span">GLO</span><input class="input1 type="text" id="mtn-4gb" value="3">
            <br>
            <span class="span">9MOBILE</span><input class="input1 type="text" id="mtn-4gb" value="4">
            <br>
            <button type="button" class="click" onclick="updateMtnPrices()"><i class="fa-solid fa-check"></i> Save Settings</button>
</div>

<div id="container_bill" class="container">
        <div class="bill">
                Bill Payment Gateways
            </div>
            <h1>Bill Payment and Documentations....</h1>
            <label>Bill Staus</label><br>
            <select name="" id="">
                <option value="">Active</option>
                <option value="">Activate</option>
                <option value="">Deactivate</option>
            </select>
            <br>
            <label>Data API URL</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Header Authorization</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Service Parameters</label><br>
            <span class="span">Amount Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Amount">
            <br>
            <span class="span">Meter Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Meter Number">
            <br>
            <span class="span">Meter Type Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Meter Type">
            <br>
            <span class="span">Dsico Name Id</span><input class="input1 type="text" id="mtn-4gb" value="Disco_name">
            <br>
            <button type="button" class="click" onclick="updateMtnPrices()"><i class="fa-solid fa-check"></i> Save Settings</button>
</div>


<div id="container_cables" class="container">
        <div class="cables">
                Cable Gateways
            </div>
            <h1>Cable Settings and Documentations....</h1>
            <label>Cable Staus</label><br>
            <select name="" id="">
                <option value="">Active</option>
                <option value="">Activate</option>
                <option value="">Deactivate</option>
            </select>
            <br>
            <label>Cable API URL</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Header Authorization</label><br>
            <input class="input1 type="text" >
            <br>
            <label>Service Parameters</label><br>
            <span class="span">Cable Name Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="Cable name">
            <br>
            <span class="span">Cable Plan Attribute /Id</span><input class="input1 type="text" id="mtn-4gb" value="cable plan">
            <br>
            <span class="span">Smart Card Id</span><input class="input1 type="text" id="mtn-4gb" value="smart_card_number">
            <br>
            <button type="button" class="click" onclick="updateMtnPrices()"><i class="fa-solid fa-check"></i> Save Settings</button>
</div>

        <!-- Cable Price Ends Here -->
    </div> <!-- End of The basic conatiner -->
    <script src="AdminGateway.js"></script>
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