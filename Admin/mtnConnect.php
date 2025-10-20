<?php
$servername= "localhost";
$username="root";
$password="";
$dbname="our_data";

//create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);
//check connection
if(!$conn){
    die("Connection Failed: " .mysqli_connect_error());
}
echo "Connected Successfully ";
$sql="INSERT INTO `pricing` (mtnhalf, mtn_1gb, mtn_2gb, mtn_3gb, mtn_4gb,	mtn_5gb, mtn_cg_half, mtn_cg_1gb, mtn_cg_2gb, mtn_cg_3gb, mtn_cg_4gb, mtn_cg_5gb, airtel_half, airtel_1gb,	airtel_2gb,	airtel_3gb,	airtel_4gb,	airtel_5gb,	glo_half, glo_1gb, glo_2gb,	glo_3gb, glo_4gb, glo_5gb, mobile_half, mobile_1gb, mobile_2gb, mobile_3gb, mobile_4gb, mobile_5gb) VALUES 
('$mtn_half', '$mtn_1gb', '$mtn_2gb',	'$mtn_3gb',	'$mtn_4gb',	'$mtn_5gb',	'$mtn_cg_half',	'$mtn_cg_1gb',	'$mtn_cg_2gb',	'$mtn_cg_3gb',	'$mtn_cg_4gb',	'$mtn_cg_5gb',	'$airtel_half',	'$airtel_1gb',	'$airtel_2gb',	'$airtel_3gb',	'$airtel_4gb',	'$airtel_5gb',	'$glo_half',	'$glo_1gb',	'$glo_2gb',	'$glo_3gb',	'$glo_4gb',	'$glo_5gb',	'$mobile_half',	'$mobile_1gb',	'$mobile_2gb', '$mobile_3gb',	'$mobile_4gb', '$mobile_5gb')";
if($conn ->query($sql) == TRUE){
    echo "Details Recorded Successfully";
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}
$conn ->close();
?>