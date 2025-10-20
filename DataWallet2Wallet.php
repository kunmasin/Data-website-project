<?php 
include ("dataDatabaseLogin.php");
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
$conn->close();
include ('balance.php');
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
            <h4 class="text-center pt-3">WALLET TO WALLET</h4>
            <h5>BALANCE: &#8358 <?php echo $balance ?></h5>
            <H5>TRANSACTION HISTORY</H5>
            <form action="">
                <label for="">Amount to Send</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Amount"><br>
                <label for="">Name of receiver</label><br>
                <input type="email" class="dashboard-inputs" placeholder="Enter the receiver Email-Address"><br>
                <input type="submit" class="dashboard-submits" value="Fund Wallet"><br>
            </form>
</div> <!--End of Begining-->
<script src="DashboardScript.js"></script>
</body>
</php>