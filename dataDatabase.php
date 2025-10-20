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
/*$sql="INSERT INTO `data_users` (names, pass_word, gender, e_mail, phone_no, country, pin, image)
 VALUES
 ('$names','$pass_word','$gender','$email','$phone','$country','$pin', '$target_file')";
if($conn ->query($sql) == TRUE){
   // echo "Details Recorded Successfully";
}else{
    echo "Error: " .$sql."<br>".$conn->error;
} 
$conn ->close();
*/
?>