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


<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Fontawesome CDN Link -->
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>
    <title>ADMIN SWITCH</title>
    <link rel="stylesheet" href="..\Admin\AdminSwitch.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>   
</head>
<body>
  <!-- Sidebar -->
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

  <div class="atRight"
  <div class="content">
                <div class="container"><div class="col-lg-12">
  <div class="card">
    <div class="card-header">Service switch</div>
    <div class="card-body">
      <h5 class="card-title">Switch Website Activities</h5>
      <form accept-charset="utf-8" id="service">

          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked">MTN SME</label>
                    <input class="check-input" type="checkbox"/>
                  </div>

          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked"> MTN CG</label>
              <input class="check-input" type="checkbox" id="flexSwitchCheckChecked"/>
                  </div>

          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked">Airtel CG</label>
              <input class="check-input" type="checkbox" id="flexSwitchCheckChecked" />
                  </div>

          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked" >Glo CG</label>
          <input  class="check-input" type="checkbox" id="flexSwitchCheckChecked" />
            </div>
          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked">9mobile G</label>
            <input class="check-input" type="checkbox" id="flexSwitchCheckChecked"/>
          </div>

          <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked" >GOTV</label>
          <input  class="check-input" type="checkbox" id="flexSwitchCheckChecked" />
            </div>

            <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked" >DSTV</label>
          <input  class="check-input" type="checkbox" id="flexSwitchCheckChecked" />
            </div>

            <div class="form-check form-switch">
          <label class="form-check-label" for="flexSwitchCheckChecked" >STARTIMES</label>
          <input  class="check-input" type="checkbox" id="flexSwitchCheckChecked" />
            </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit" id="uBtn" style="width: 100%"> Update</button>
          <button class="btn btn-primary" type="button" style="width: 100%; display: none" id="uBtnLoad"> Updating </button>
        </div>
      </form>
    </div>
  </div>
</div>

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