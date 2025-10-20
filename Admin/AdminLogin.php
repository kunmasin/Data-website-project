<!DOCTYPE html> 
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Log In</title>
        <link rel="stylesheet" href="..\Admin\AdminLogIn.css">
        <link rel="stylesheet" href="c:\Users\HP\Documents\PROJECTS_AT_PLAT\fontawesome-free-6.4.2-web">
	      <link rel="stylesheet" href="c:\Users\HP\Documents\PROJECTS_AT_PLAT\bootstrap-icons-1.11.1">
	      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	      <script src="c:\Users\HP\Documents\PROJECTS_AT_PLAT\fontawesome-free-6.4.2-web\js\all.js"></script>
        <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>    
        <style>
/*body{
    color: white;
    background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnLW94CyeqyLwbhze7nSD6cMq-9cwt0LWSDuafPRx1rQ&s');
    background-size: 1550px 30000px;
    background-repeat: no-repeat;
}*/
</style>
    </head>
    <body>
    <?php
    $eMail =$passWord ="";
    $eMail_Err = $passWord_Err = "";
    if (empty($_POST["eMail"])){
        $eMail_Err="E-mail is required";
    }else{
        $eMail= test_input($_POST["eMail"]);
    }
    if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
        $eMail_Err = "Invalid email format";
      }
     if(empty($_POST["passWord"])){
        $passWord_Err="Password is not correct";
     } else{
        $passWord=test_input($_POST["passWord"]);
     }

    function test_input($data){
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    ?>
<center>
<div class="container">
<h2>ADMIN LOGIN</h2>
<form action="AdminLogin.php" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input class="username" name="eMail" type="email" placeholder="Enter Your E-mail Address" autocomplete="on" value="<?php echo $eMail; ?>"  required width="100px">
<Span class="error">*<?php echo $eMail_Err; ?> </span>
<br>

<input class="password" name="passWord" type="password" placeholder="Password"  maxlength="15" width="100px" autocomplete="on" value="<?php echo $passWord; ?>" required>
<span class="error">*<?php echo $passWord_Err; ?> </span>
<br>
<p>Forget Password ? <a href="..\Data_Reseller\retrieve.php">Retrieve Password</a> </p>

<button id="loggedIN" class="login">Log In</button>
</form>
</div>

<script>
    document.getElementById("loggedIN").onclick = function () {
        alert("Logged In Succesfully");
    }
</script>
<center>
    <?php 
    if (!empty($_POST)){
         $servername= "localhost";
        $username= "root";
        $password= "";
        $dbname= "ourdata";
        $conn= mysqli_connect($servername,$username,$password,$dbname);
        $sql= "SELECT * FROM `admin_det_reg` WHERE eMail  LIKE '$eMail' AND passWord LIKE '$passWord'";
    if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}else{
    
}
                if($conn->query($sql) == TRUE){
                    $sql= "SELECT * FROM `admin_det_reg` WHERE eMail  LIKE '$eMail' AND passWord LIKE '$passWord'";
                    
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Login Successful for :<br>"."Line ". $row["id"]."<br>". " - Name: " . $row["fullName"];
                    setcookie('owner', $row["eMail"], time() + (2000), "/");
                    header('location: AdminDashBoard.php');
                    exit;
                }
            }else{
                echo " Invalid Username and Password";
            }
            
        }else{
            echo "Error: " .$sql."<br>".$conn->error;
        }
        $conn->close();
    }
    ?>
    </center>
        <p style='color: white'>&#169; OURDATA <?php echo $year = date('Y') ?> All Right Reserved, Developed by FruitfulCode</p>
</center>
    </body>
</html>