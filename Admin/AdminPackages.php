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
    <title>ADMIN PACKAGES</title>
    <link rel="stylesheet" href="..\Admin\AdminPackages.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
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
<div class="content">
<div class="container">    
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Packages</div>
      <div class="card-body">
          <h5 class="card-title">Create, Update, Delete Packages</h5>
          <div class="modal fade" id="cpackage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Create Package</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/config/package-config.php" method="post">
                <div class="modal-body">
                <label for="">Package Name</label>
                <br>
                  <input type="text" class="form-control" name="packageName" required>
                  <br>
                  <label for="">Airtime Discount</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Airtime Discount" aria-label="dis" aria-describedby="basic-addon1" name="airtimeDiscount">
                    <span class="input-group-text" id="basic-addon1">%</span>
                  </div>
                <br>
                  <label for="">Data Discount</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder=" Data Discount" aria-label="dis" aria-describedby="basic-addon1" name="dataDiscount">
                    <span class="input-group-text" id="basic-addon1">%</span>
                  </div>
                  <br>
                  <label for="">Price</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Activation Price" aria-label="dis" aria-describedby="basic-addon1" name="price">
                    <span class="input-group-text" id="basic-addon1">NGN</span>
                  </div>
                  <br>
                  <label for="">Visibility</label>
                <br>
                <select class="form-select" aria-label="Default select example" name="visibility">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                  <br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="create">Create Package</button>
                </div>
            </form>
              </div>
            </div>
          </div>
          <div class="general">
            <button type="button" class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#cpackage">
              Create Package
          </div>
                    <div class="modal fade" id="id1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Airtel Gifting </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/config/package-config.php" method="post">
                    <div class="modal-body">
                      <label for="">Airtime Discount</label>
                      <br>
                      <div class="input-group mb-3">
                        <input type="number" value="0" class="form-control" placeholder="Airtime Discount" aria-label="dis" aria-describedby="basic-addon1" name="airtimeDiscount">
                        <span class="input-group-text" id="basic-addon1">%</span>
                      </div>
                    <br>
                      <label for="">Data Discount</label>
                      <br>
                      <div class="input-group mb-3">
                        <input type="number" value="0" class="form-control" placeholder=" Data Discount" aria-label="dis" aria-describedby="basic-addon1" name="dataDiscount">
                        <span class="input-group-text" id="basic-addon1">%</span>
                        <input type="hidden" name="id" value="1">
                      </div>
                      <br>
                  <label for="">Price</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Activation Price" aria-label="dis" aria-describedby="basic-addon1" name="price" value="0">
                    <span class="input-group-text" id="basic-addon1">NGN</span>
                  </div>
                  <br>
                  <label for="">Visibility</label>
                <br>
                <select class="form-select" aria-label="Default select example" name="visibility">
                  <option value="1">
                    Yes                  </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <br>
                <label for="">Allow E-Pin</label>
              <br>
              <select class="form-select" aria-label="Default select example" name="voucher">
                <option value="0">
                  No                </option>
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
                  <br>
                  <label for="">Allow Data Card</label>
                <br>
                <select class="form-select" aria-label="Default select example" name="dataCard">
                  <option value="0">
                    No                  </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="update">Update Package</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        <div class="general">
       <label>Package Name: <span>Airtel Gifting </span></label>
       <br>
       <label>Airtime Discount: <span>0%</span></label>
       <br>
       <label>Data Discount: <span>0%</span></label>
       <br>
       <br>
       <button type="button" class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#id1">
        Update Package
      </button>
    </div>
          </div>
  </div>
</div>
</div>
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