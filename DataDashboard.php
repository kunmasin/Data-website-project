<?php 
include_once ("dataDatabaseLogin.php");
if (!isset($_COOKIE['users'])){
    header('location: DataLogIn.php');
    exit;
}
$sql="SELECT * FROM `data_users` WHERE e_mail LIKE '".$_COOKIE['users']."'";
$user = array();

if($conn->query($sql) == TRUE){
    $sql="SELECT * FROM `data_users` WHERE e_mail LIKE '".$_COOKIE['users']."'";
        $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           $user = $row; 
        }
    }else{
        header('location: DataLogIn.php');
        exit;
    }
    
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}
include ('balance.php');
include ('cookie.php');
?>
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OURDATA WEBSITE</title>
    <link rel="stylesheet" href="..\Day7\DataCSSFile.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('sidebar.php') ?>
      
        <div class="container">
            <h3 style="text-transform: uppercase;">WELCOME <?=$user['names']?></h3>
            <div class="dashboard-details p-3">
               <div style="justify-content: space-between;" class="d-flex">
                <h5>Your Balance is: &#8358 <?php echo $balance ?></h5>
                <a style="width: 10%; height: 10%;" href="https://chat.whatsapp.com/J8HKx1SjAQyBezrFbYQdH1"><img style="width: 35%; height: 35%;" src="..\Day7\Day7templates\whatsapp.png.png" alt=""></a>
                </div>
                <div style="justify-content: space-between;" class="d-flex mt-2">
                <h5 style="text-transform: uppercase;">WELCOME BACK <?=$user['names']?></h5>
                <h5><a class="text-white" style="text-decoration:none;" href="#">Transaction History</a></h5>
                </div>
            </div>

            <div class="container d-flex pt-3">
                <button id="btn-wema">WEMA</button>
                <button id="btn-monniepoint">MONNIEPOINT</button>
                <button id="btn-sterling">STERLING</button>
                </div>
              
            <div class="container mt-3">
                <h3>ACCOUNT DETAILS</h3>
                <div class="dashboard-wema p-3" id="wema">
                    <div>
                    <h5>BANK NAME: WEMA BANK</h5>
                    <h5 style="text-transform: uppercase;">ACCOUNT NAME: <?=$user['names']?></h5>
                    <div class="d-flex" style="justify-content: space-between;">
                    <h5>ACCOUNT NUMBER: 1483531566</h5>
                    <h5>CHARGES: 3%</h5>
                    </div>
                    </div>
                </div>

                <br>
                   
                <div class="dashboard-sterling p-3" id="sterling">
                     <div>
                     <h5>BANK NAME: STERLING BANK</h5>
                     <h5 style="text-transform: uppercase;">ACCOUNT NAME: <?=$user['names']?></h5>
                     <div class="d-flex" style="justify-content: space-between;">
                        <h5>ACCOUNT NUMBER: 1483531566</h5>
                        <h5>CHARGES: 3%</h5>
                        </div>
                     </div>
                 </div>

                 <br>
                <div class="dashboard-monniepoint p-3" id="monniepoint">
                     <div>
                     <h5>BANK NAME: MONNIEPOINT BANK</h5>
                     <h5 style="text-transform: uppercase;">ACCOUNT NAME: <?=$user['names']?></h5>
                     <div class="d-flex" style="justify-content: space-between;">
                        <h5>ACCOUNT NUMBER: 1483531566</h5>
                        <h5>CHARGES: 3%</h5>
                        </div>
                     </div>
                 </div>
 
                
                 <!--List of Services-->
                 <div class="container" id="list-of-services">
                    <div class="d-flex">
                        <a href="..\Day7\DataDashoardAirtime.php" id="servicesa">Buy Airtime</a>
                        <a href="..\Day7\DataDashboardData.php" id="servicesa">Buy Data</a>
                        <a href="..\Day7\DataDashboardCable.php" id="servicesa">Cable Subscription</a>
                    </div>

                    <div class="d-flex">
                        <a href="..\Day7\DataDashboardUtility.php" id="servicesa">Pay Bills</a>
                        <a href="..\Day7\DataFundWallet.php" id="servicesa">Fund Wallet</a>
                        <a href="..\Day7\DataTransaction.php" id="servicesa">Transaction History</a>
                    </div>

                    <div class="d-flex">
                        <a href="" id="servicesa">Wallet 2 Wallet Funding</a>
                        <a href="..\Day7\DataAccountSetting.php" id="servicesa">Account Setting</a>
                        <button id="servicesb"><a style="text-decoration:none; color: white;" href="..\Day7\DataLogOut.php">Sign Out</a></button>
                 </div>
           
</div> <!--End of Begining-->

<script src="DataDashboard1.js"></script> 

</body>
</php>