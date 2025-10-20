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
include("../balance.php");

?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Fontawesome CDN Link -->
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>
    <title>ADMIN Edit</title>
    <link rel="stylesheet" href="..\Admin\AdminDeveloper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="AdminDeveloper.js"></script>
 
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

<!-- ------------- -->
<div class="col-lg-12">
<div class="card">
<div class="card-header"></div>
<div class="card-body">
<h5 class="card-title">Update And Review This User</h5>
<div class="mb-3">

  <?php 
  // Ensure the database connection is established
  $mysqli = new mysqli('localhost', 'root', '', 'ourdata');
  if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
  }

  // Use a prepared statement to prevent SQL injection
  $stmt = $mysqli->prepare("SELECT * FROM `admin_det_reg`");
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Check if user data was fetched
  if ($user) {
  ?>
    <label for="" class="form-label"><b>Username: </b><?php echo htmlspecialchars($user['fullName']); ?></label>
    <br />
    <label for="" class="form-label"><b>Email: </b><?php echo htmlspecialchars($user['eMail']); ?></label>
    <br />
    <label for="" class="form-label"><b>Phone Number: </b><?php echo htmlspecialchars($user['phoneNumber']); ?></label>
    <br />
    <label for="" class="form-label"><b>Pin: </b><?php echo htmlspecialchars($user['passWord']); ?></label>
    <br />
    <label for="" class="form-label"><b>Balance: </b>&#8358; <?php echo $balance;?> </label>
    <br />
    <label for="" class="form-label"><b>Package: </b>customer</label>
  <?php
  } else {
      echo "No user data found.";
  }

  // Close the statement and connection
  $stmt->close();
  $mysqli->close();
  ?>
</div>

<div style="overflow-x: auto">
<div class="btn-group">
  <button type="button" class="btn btn-success sm" data-bs-toggle="modal" data-bs-target="#add"> Add Balance</button>
  <button type="button" class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#set"> Set Balance</button>
  <button type="button" class="btn btn-danger sm" data-bs-toggle="modal" data-bs-target="#deduct">Deduct Balance</button>
  <button type="button" class="btn btn-warning sm"  data-bs-toggle="modal" data-bs-target="#package">Set Package</button>
  <button type="button" class="btn btn-danger sm" data-bs-toggle="modal" data-bs-target="#delete">Delete User</button>
  <button type="button" class="btn btn-secondary sm" id="switch">Switch User </button>
  <button type="button" class="btn btn-danger sm" data-bs-toggle="modal" data-bs-target="#change"> Change Password</button>
</div>
</div>
</div>
</div>
</div>

  </body>
  </html>