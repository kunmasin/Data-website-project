<!DOCTYPE html> 
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="..\Admin\AdminReg.css">
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
//Input variables set to empty for both error and normal  variables.
$fullName_Err = $phoneNumberErr = $eMailErr = $passWord_Err = "";
$fullName = $phoneNumber = $eMail = $passWord =""; //NOTE i added $target_file here
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["fullName"])){
        $names_Err= "FullName is required";
    }else{
        $fullName= test_input($_POST["fullName"]);
        //Check if name format is valid
        if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
        $fullName_Err = "Only letters and white space allowed";
      }
    }
  
    if (empty($_POST["phoneNumber"])){
        $phoneNumberErr="Phone is required";
    }else{
        $phoneNumber= test_input($_POST["phoneNumber"]);
    }
    if (empty($_POST["eMail"])){
        $emailErr="email is required";
    }else{
        $eMail= test_input($_POST["eMail"]);
        //Check if the e-mail format is correct 
        if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
        $eMailErr = "Invalid email format";
      }
    }
    
    if (empty($_POST["passWord"])){    
        $passWord_Err="Password is required";
    }else{
        $passWord= test_input($_POST["passWord"]);
    }

}
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<center> 
    <div class="container">
    <h2>REGISTERATION</h2>

<form action="AdminReg.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input  class="username" name="fullName" type="text" placeholder="ENTER YOUR NAME" value="<?php echo $fullName; ?>">
<span class="error">*<?php echo $fullName_Err ?> </span>
<br>

<input class="username" name="eMail" type="email" placeholder="ENTER YOUR EMAIL ADDRESS" value="<?php echo $eMail; ?>">
<span class="error">*<?php echo $eMailErr ?> </span>
<br>

<input class="username" name="phoneNumber" type="tel" placeholder="ENTER YOUR PHONE NUMBER" maxlength="15" value="<?php echo $phoneNumber; ?>">
<span class="error">*<?php echo $phoneNumberErr ?> </span>
<br>

<input class="username" name="passWord" type="password" placeholder="ENTER YOUR 9 digits password" value="<?php echo $passWord; ?>"  maxlength="15">
<span class="error">*<?php echo $passWord_Err ?> </span>
<br>
<p>Already Registered ? <a href="..\Admin\AdminLogin.php">Login</a></p>
<button id="submit" class="register" type="submit" name="submit">Register</button>
</form>
</div>
<script>
    document.getElementById("registered").onclick = function () {
        alert("Registered Succesfully");
    }
</script>

<?php
include "AdConnectReg.php";
?>
    </div>
    <span style="color: white";>
    <p style=>&copy;  Fruitful_Code 2024 [Abdullahi Oniye]
<?php
//date_default_timezone_set("Africa/Lagos");
//echo  date(" l - M - 2024"). date("/ l").date("h:i:sa ");
?></span> </p>


</center>
</body>
</html>