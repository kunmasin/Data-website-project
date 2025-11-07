<?php
$servername= "localhost";
$username="root";
$password="";
$dbname="ourdata";

//create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);
//check connection
if(!$conn){
    die("Connection Failed: " .mysqli_connect_error());
}
//echo "Connected Successfully ";
$sql="INSERT INTO `admin_det_reg` (fullName, eMail, phoneNumber, passWord) VALUES ('$fullName', '$eMail', '$phoneNumber', '$passWord')";
if($conn ->query($sql) == TRUE){
    //echo "Details Recorded Successfully";
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}
$conn ->close();
?>