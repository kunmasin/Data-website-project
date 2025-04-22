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
            height: 100vh;
            color: white;
        }
    </style>
</head>
<body>

<?php
    $email =$pass_word ="";
    $email_Err = $pass_word_Err = "";
    if (empty($_POST["email"])){
        $email_Err="E-mail is required";
    }else{
        $email= test_input($_POST["email"]);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_Err = "Invalid email format";
      }
     if(empty($_POST["pass_word"])){
        $pass_word_Err="Password is not correct";
     } else{
        $pass_word=test_input($_POST["pass_word"]);
     }

    function test_input($data){
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    ?>

    <div class="container text-center pt-5">
        <h1 class="text-primary">LOGIN</h1>
        <form action="DataLogIn.php" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input class="input" type="email" name="email" id="" placeholder="Enter Your Email-Address"><br>
            <input class="input" type="password" name="pass_word" id="" autocomplete="off"  placeholder="Enter Your Password"><br>
            <p>Incase You Have Registered Before Click the next text <a href="..\Day7\DataRegisteration.php">Register</a></p>
            <button class="submit mb-5" type="submit" name="" id="">LogIn</button>
        </form>
    </div>
    <footer class="text-center mt-5">
        <p>&#169; OURDATA 2024 All Right Reserved, Developed by Oniye Abdullahi</p>
    </footer>



<p class="text-center">
    <?php 
    if (!empty($_POST)){
         $servername= "localhost";
        $username= "root";
        $password= "";
        $dbname= "ourdata";
        $conn= mysqli_connect($servername,$username,$password,$dbname);
        $sql= "SELECT * FROM `data_users` WHERE e_mail  LIKE '$email' AND pass_word LIKE '$pass_word'";
    if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}else{
    
}
                if($conn->query($sql) == TRUE){
                    $sql= "SELECT * FROM `data_users` WHERE e_mail  LIKE '$email' AND pass_word LIKE '$pass_word'";
                    
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Login Successful for :<br>"."Line ". $row["id"]."<br>". " - Name: " . $row["names"];
                    setcookie('users', $row["e_mail"], time() + (3000), "/");
                    header('location: DataDashboard.php');
                    exit;
                }
            }else{
                echo "Invalid Username and Password";
            }
            
        }else{
            echo "Error: " .$sql."<br>".$conn->error;
        }
        $conn->close();
    }
    ?>
    </p>
</body>
</html>