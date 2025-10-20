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
</head>
<body>
        <?php include('sidebar.php') ?>
    
        <div class="container">
            <h4 class="text-center pt-3">ACCOUNT SETTINGS</h4>
            <form action="">
                <label for="">Email-Address</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Email-Address"><br>
                <label for="">Full Name</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Full Name"><br>
                <label for="">Phone Number</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Phone Number"><br>
                <label for="">Transaction Pin</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Transaction Pin"><br>
                <label for="">Password</label><br>
                <input type="text" class="dashboard-inputs" placeholder="Password"><br>
                <input type="submit" class="dashboard-submits" value="Update Account"><br>
            </form>
</div> <!--End of Begining-->
<script src="DashboardScript.js"></script>
</body>
</html>