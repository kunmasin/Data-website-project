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
#$conn->close();

?>