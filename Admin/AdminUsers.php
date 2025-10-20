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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ourdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, names, e_mail, country, pin, gender, phone_no FROM data_users";
$result = $conn->query($sql);
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
    <title>Admin Users</title>
    <link rel="stylesheet" href="../Admin/AdminUsers.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../Admin/AdminUsers.js"></script>
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

<div class="content">
<div class="container"><div class="page-title">
  <h3>Users</h3>
</div>
<div class="box box-primary">
  <div class="box-body">
    <table width="100%" class="table table-hover" id="dataTables-example">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Country</th>
          <th>Pin</th>
          <th>Gender</th>
          <th>Phone Number</th>
        </tr>
      </thead>
      <tbody>
          <tr>
          <?php
          $sn = 1;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $sn++ . "</td>";
        echo "<td>" . $row["names"]. "</td>";
        echo "<td>" . $row["e_mail"]. "</td>";
        echo "<td>" . $row["country"]. "</td>";
        echo "<td>" . $row["pin"]. "</td>";
        echo "<td>" . $row["gender"]. "</td>";
        echo "<td>" . $row["phone_no"]. "</td>";
    }
    } else {
      echo "<tr><td colspan='3'>No users found</td></tr>";
    }
    ?>  <a
              href="..\Admin\AdminEnter.php"
              class="btn btn-outline-info btn-rounded"
              ><i class="fas fa-pen"></i
            ></a>
            <a href="..\Admin\AdminEnter.php" class="btn btn-outline-danger btn-rounded"
              ><i class="fas fa-trash"></i
            ></a>
          </td>
        </tr>
             
      
        </tbody>
    </table>
    <div class="col-sm-12 col-md-7 align-item-center">
        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
        <ul class="pagination">
        <li class="paginate_button page-item previous disabled" id="dataTables-example_previous">
         <a href="#" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
        <li class="paginate_button page-item active"><a href="#" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
        <li class="paginate_button page-item "><a href="#" aria-controls="dataTables-example" data-dt-idx="7" tabindex="0" class="page-link">7</a></li>
        <li class="paginate_button page-item next" id="dataTables-example_next"><a href="#" aria-controls="dataTables-example" data-dt-idx="8" tabindex="0" class="page-link">Next</a></li>
    </ul>
</div>
</div>
  </div>
</div>
</div>
</div>
</div>
</div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>