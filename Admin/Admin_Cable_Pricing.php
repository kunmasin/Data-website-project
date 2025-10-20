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
    <button type="submit" class="click"><i class="fa-solid fa-check"></i> Update Price</button>
</div>
</form>



<form method="POST">
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