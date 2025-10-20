<!DOCTYPE html>
<html lang="en">
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

    <style>
        body{
            background: linear-gradient(rgb(20, 40, 50), rgb(10, 20, 30));
            background-repeat: no-repeat;
            color: white;
        }
    </style>
</head>
<body>
<?php

include ("dataDatabase.php");
//Input variables set to empty for both error and normal  variables.
$names_Err = $phoneErr = $emailErr = $pinErr = $password_Err = $countryErr = $genderErr = $imageErr= "";
$names = $phone = $email = $pin= $pass_word = $country = $gender = $image = $target_file = "" ; //NOTE i added $target_file here
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["names"])){
        $names_Err= "Name is required";
    }else{
        $names= test_input($_POST["names"]);
        //Check if name format is valid
        if (!preg_match("/^[a-zA-Z ]*$/",$names)) {
        $names_Err = "Only letters and white space allowed";
      }
    }
  
    if (empty($_POST["phone"])){
        $phoneErr="Phone is required";
    }else{
        $phone= test_input($_POST["phone"]);
    }
    if (empty($_POST["email"])){
        $emailErr="Phone is required";
    }else{
        $email= test_input($_POST["email"]);
        //Check if the e-mail format is correct 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }
    if (empty($_POST["pin"])) {
        $pinErr="Pin is required";
    }else{
        $pin=test_input($_POST["pin"]);
    }
    if (empty($_POST["pass_word"])){    
        $password_Err="Password is required";
    }else{
        $pass_word= test_input($_POST["pass_word"]);
    }
    if(empty($_POST["country"])){
        $countryErr="Country is required";
    }else{
        $country= test_input($_POST["country"]);
    }
    if(empty($_POST["gender"])){
        $genderErr="Gender is required";
    }else{
    $gender= test_input($_POST["gender"]);
    }

//Sending Uploaded into the upload folder
    $target_dir = "profileUploads/";
    $image_name= time(). '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file ". $image_name. " has been uploaded.');</script>";
        }
        else {
            // Generate a unique name for the file
            $newFileName = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir.$newFileName;
        }
    }}

    $sql="INSERT INTO `data_users` (names, pass_word, gender, e_mail, phone_no, country, pin, image)
 VALUES
 ('$names','$pass_word','$gender','$email','$phone','$country','$pin', '$target_file')";
if($conn ->query($sql) == TRUE){
   // echo "Details Recorded Successfully";
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>



    <div class="container text-center pt-5">
        <h1 class="text-primary">REGISTERATION</h1>
        <form action="..\Day7\DataRegisteration.php" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input class="input" type="text" name="names" id="" placeholder="Enter Your Full Name"><br>
            <input class="input" type="tel" name="phone" id="" maxlength="15" placeholder="Enter Your Phone Number"><br>
            <input class="input" type="file" name="image"><br>
            <input class="input" type="email" name="email" id="" placeholder="Enter Your Email-Address"><br>
            <input class="input" type="password" name="pin" id="" maxlength="4" placeholder="Enter Your Four Digits Pin"><br>
            <input class="input" type="password" name="pass_word" id="" maxlength="9" placeholder="Enter Your 9 Digits Password"><br>
            <select class="input" name="country" id="country">
                <option value="Select Your Country" selected disabled>Select Your Country</option>
                <option value="Nigeria" >Nigeria</option>
                <option value="USA" >USA</option>
                <option value="Ghanna">Ghanna</option>
                <option value="Cameroon" >Cameroon</option>
                <option value="Portugal" >Portugal</option>
                <option value="South-Korea" >South-Korea</option>
                <option value="North-Korea" >North-Korea</option>
                <option value="Poland" >Poland</option>
                <option value="Canada" >Canada</option>
                <option value="South Africa" >South Africa</option>
                <option value="Pakistan" >Pakistan</option>
                <option value="India" >India</option>
                <option value="China" >China</option>
            </select><br>
            <select class="input" name="gender" id="gender">
                <option value="Select Your Gender" selected disabled>Select Your Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
            </select><br>           
            <p>Incase You Have Registered Before Click the next text <a href="..\Day7\DataLogIn.php">LogIn</a></p>
            <button class="submit mb-5" type="submit" name="register" id="register" value="SUBMIT">SUBMIT</button>
        </form>
    </div>

    <footer class="text-center mt-3">
        <p>&#169; OURDATA <?php echo $year = date('Y') ?> All Right Reserved, Developed by FruitfulCode</p>
    </footer>
  
</body>
</html>