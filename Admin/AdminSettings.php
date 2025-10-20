<?php 
include ("AdConnectLog.php");
if (!isset($_COOKIE['owner'])){
    header('location: AdminLogIn.php');
    exit;
}
$sql="SELECT * FROM `admin_det_reg` WHERE eMail LIKE '".$_COOKIE['owner']."'";
$user = array();

if($conn->query($sql) == TRUE){
    $sql="SELECT * FROM `admin_det_reg` WHERE eMail LIKE '".$_COOKIE['owner']."'";
        $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           $user = $row; 
        }
    }else{
        header('location: AdminLogIn.php');
        exit;
    }
    
}else{
    echo "Error: " .$sql."<br>".$conn->error;
}
$conn->close();

?>


<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Fontawesome CDN Link -->
    <script src="https://kit.fontawesome.com/c5355fa9b1.js" crossorigin="anonymous"></script>
    <title>ADMIN SETTINGS</title>
    <link rel="stylesheet" href="../Admin/AdminSetting.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet"/>
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet"/>
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet"/>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet"/>
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet"/>
</head>
<body>
<!-- Sidebar -->
<nav class="navbar navbar-expand-xl navbar-white bg-white">
        <button type="button" id="sidebarCollapse" class="btn btn-primary icon">
            <i class="fas fa-bars"></i>
        </button>
        <div id="inDline"> 

            <button id="closeSidebar">&times;</button> <!-- Close icon -->
                <img class="myImage" src="..\images\IMG-20240326-WA0118.jpg" alt="Admin Image">
            <div class="new"><p class="myP"><span class="fa-solid fa-home" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminDashBoard.php" >Dashboard</a></p></div>
            <div class="new"><p class="myP"><span class="fa fa-file-code-o" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminGateways.php" >Gateways</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-money-bill" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin_New_Price.php" >Pricing</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-user-friends" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminUsers.php" >Users</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-users-between-lines" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminPackages.php" >Packages</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-history" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminTransaction.php" >Transaction History</a></p></div>
            <div class="new"><p class="myP"><span class="fas fa-code" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminDeveloper.php">Developer</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-toggle-on" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminSwitch.php" >Service Switch</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-gear" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminSettings.php" >Settings</a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-gear" aria-hidden="true"></span> <a class="myA" href="..\Admin\AdminCheckUpdate.php" >Check for Update </a></p></div>
            <div class="new"><p class="myP"><span class="fa-solid fa-right-from-bracket" aria-hidden="true"></span> <a class="myA" href="..\Admin\Admin.php" >Log Out</a></p></div>
        </div>    
    </nav>


<div class="atRight">
<h3 class="mt-3">Settings</h3>

<ul class="list-group list-group-horizontal" id="myList" role="tablist">
  <li class="list-group-item active" data-target="content1">
    <a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false"> General </a>
  </li>
  <li class="list-group-item" data-target="content2">
    <a class="nav-link" id="system-tab" data-bs-toggle="tab" href="#system" role="tab" aria-controls="system" aria-selected="false"> Contact</a>
  </li>
  <li class="list-group-item" data-target="content3">
    <a class="nav-link" id="email-tab" data-bs-toggle="tab" href="#email" role="tab" aria-controls="email"aria-selected="false">Email</a>
  </li>
  <li class="list-group-item" data-target="content4">
    <a class="nav-link" id="appearance-tab" data-bs-toggle="tab" href="#appearance" role="tab" aria-controls="appearance" aria-selected="false">Appearance</a>
  </li>
  <li class="list-group-item" data-target="content5">
    <a class="nav-link" id="integrator-tab" data-bs-toggle="tab" href="#integrator" role="tab" aria-controls="integrator" aria-selected="false">Integrator</a>
  </li>
  <li class="list-group-item" data-target="content6">
    <a class="nav-link" id="payment-tab" data-bs-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payments</a>
  </li>
  <li class="list-group-item" data-target="content7">
    <a class="nav-link" id="attributions-tab" data-bs-toggle="tab" href="#attributions" role="tab" aria-controls="attributions" aria-selected="false">Attributions</a>
  </li>
</ul>


</div>
</div>
</div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const listItems = document.querySelectorAll('.list-group-item');
    const contents = document.querySelectorAll('.tab-content');

    listItems.forEach(item => {
      item.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior

        // Remove active class from all list items and content
        listItems.forEach(i => {
          i.classList.remove('active');
        });
        contents.forEach(content => content.classList.remove('active', 'show'));

        // Add active class to the clicked list item
        this.classList.add('active');

        // Show the content corresponding to the clicked list item
        const targetId = this.getAttribute('data-target');
        const targetContent = document.getElementById(targetId);
        if (targetContent) {
          targetContent.classList.add('active', 'show');
        }
      });
    });
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('inDline');
    const button = document.getElementById('sidebarCollapse');
    const closeButton = document.getElementById('closeSidebar');
    
    // Toggle sidebar visibility on button click
    button.addEventListener('click', function() {
        if (sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        } else {
            sidebar.classList.add('show');
        }
    });
    
    // Close sidebar on close button click
    closeButton.addEventListener('click', function() {
        sidebar.classList.remove('show');
    });
});

</script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>


    <script type="text/javascript">
  $(document).ready(function () {
    $("#saveGen").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/settings.php",
        data: {
          saveGen: "saveGen",
          siteName: $("#site_name").val(),
          siteTitle: $("#site_title").val(),
          siteDesc: $("#site_description").val(),
          head: $("#head").val(),
        },
        beforeSend: function () {
          $("#saveGen").hide();
          $("#genLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Settings Updated Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              location.reload();
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#saveGen").show();
          $("#genLoad").hide();
        },
      });
    });
  });

  // --------
  $(document).ready(function () {
    $("#saveCon").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/settings.php",
        data: {
          saveCon: "saveCon",
          notify: $("#notify").val(),
          cEmail: $("#cEmail").val(),
          phone: $("#phone").val(),
          address: $("#address").val(),
        },
        beforeSend: function () {
          $("#saveCon").hide();
          $("#conLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Settings Updated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#saveCon").show();
          $("#conLoad").hide();
        },
      });
    });
  });

  // ----------
  $(document).ready(function () {
    $("#createMail").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/create-email.php",
        data: {
          createMail: "createMail",
          username: $("#newEmail").val(),
          password: $("#password").val(),
          cpassword: $("#cpassword").val(),
        },
        beforeSend: function () {
          $("#createMail").hide();
          $("#cmailLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Email Created Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              location.reload();
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#createMail").show();
          $("#cmailLoad").hide();
        },
      });
    });
  });

  // ------
  $(document).ready(function () {
    $("#saveEmail").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/create-email.php",
        data: {
          saveEmail: "saveEmail",
          passResetType: $("#passResetType").val(),
          emailVerification: $("#emailVerification").val(),
          smtpHost: $("#smtpHost").val(),
          smtpSecurity: $("#security").val(),
          smtpEmail: $("#smtpEmail").val(),
          smtpPort: $("#smtp_port").val(),
          smtpPassword: $("#smtpPassword").val(),
        },
        beforeSend: function () {
          $("#saveEmail").hide();
          $("#smailLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Settings Saved Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#saveEmail").show();
          $("#smailLoad").hide();
        },
      });
    });
  });

  // -------

  $(document).ready(function () {
    $("#logoForm").on("submit", function (event) {
      event.preventDefault();
      var logoForm = $("#logoForm")[0];
      var formData = new FormData(logoForm);
      $.ajax({
        url: "../config/upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $("#logoBtn").hide();
          $("#logoBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Website Logo Changed Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#createLogo").load(location.href + " #createLogo");
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#logoBtn").show();
          $("#logoBtnLoad").hide();
        },
      });
    });
  });
  // ----------

  $(document).ready(function () {
    $("#faviconForm").on("submit", function (event) {
      event.preventDefault();
      var faviconForm = $("#faviconForm")[0];
      var formData = new FormData(faviconForm);
      $.ajax({
        url: "../config/upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $("#favBtn").hide();
          $("#favBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Website Favicon Changed Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#createFav").load(location.href + " #createFav");
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#favBtn").show();
          $("#favBtnLoad").hide();
        },
      });
    });
  });
  // -----------

  $(document).ready(function () {
    $("#logoDel").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/upload.php",
        data: {
          logoDel: "logoDel",
          crLogo: $("#crLogo").val(),
        },
        beforeSend: function () {
          $("#logoDel").hide();
          $("#logoDelLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Logo Deleted Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#createLogo").load(location.href + " #createLogo");
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#logoDel").show();
          $("#logoDelLoad").hide();
        },
      });
    });
  });

  // ----------
  $(document).ready(function () {
    $("#favDel").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/upload.php",
        data: {
          favDel: "favDel",
          crFavicon: $("#crFavicon").val(),
        },
        beforeSend: function () {
          $("#favDel").hide();
          $("#favDelLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Logo Deleted Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#createFav").load(location.href + " #createFav");
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#favDel").show();
          $("#favDelLoad").hide();
        },
      });
    });
  });

  // ----------
  $(document).ready(function () {
    $("#tempBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/template.php",
        data: {
          tempBtn: "tempBtn",
          homeTemp: $("#homeTemp").val(),
        },
        beforeSend: function () {
          $("#tempBtn").hide();
          $("#tempBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Template Updated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#tempBtn").show();
          $("#tempBtnLoad").hide();
        },
      });
    });
  });
  // -------------
  $(document).ready(function () {
    $("#landBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/template.php",
        data: {
          landBtn: "landBtn",
          landTemp: $("#landTemp").val(),
        },
        beforeSend: function () {
          $("#landBtn").hide();
          $("#landBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Landing Page Type Set Successfully.. Kindly Reload The Page And Set Up Your Files Here....",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#landBtn").show();
          $("#landBtnLoad").hide();
        },
      });
    });
  });
  // -----------
  $(document).ready(function () {
    $("#themeBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/landing.php",
        data: {
          setup: "logoDel",
          landHtml: $("#landHtml").val(),
          landCss: $("#landCss").val(),
          landJs: $("#landJs").val(),
        },
        beforeSend: function () {
          $("#themeBtn").hide();
          $("#themeBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Homepage Saved Successfully",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#setLand").load(location.href + " #setLand");
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#themeBtn").show();
          $("#themeBtnLoad").hide();
        },
      });
    });
  });
  // ---------------------

  $(document).ready(function () {
    $("#paymentForm").on("submit", function (event) {
      event.preventDefault();
      var Form = $("#paymentForm")[0];
      var formData = new FormData(Form);
      $.ajax({
        url: "../config/payment.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          $("#payBtn").hide();
          $("#payBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Payment Settings Saved Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#payBtn").show();
          $("#payBtnLoad").hide();
        },
      });
    });
  });

  // ================

  // ==============/
  // integrator

  $(document).ready(function () {
    $("#airtimeIntBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/integrator.php",
        data: {
          vtu: "logoDel",
          airtimeVendor: $("#airtimeVendor").val(),
        },
        beforeSend: function () {
          $("#airtimeIntBtn").hide();
          $("#airtimeIntBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Airtime Vendor Integrated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#airtimeIntBtn").show();
          $("#airtimeIntBtnLoad").hide();
        },
      });
    });
  });

  $(document).ready(function () {
    $("#dataIntBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/integrator.php",
        data: {
          data: "logoDel",
          dataVendor: $("#dataVendor").val(),
        },
        beforeSend: function () {
          $("#dataIntBtn").hide();
          $("#dataIntBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Data Vendor Integrated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#dataIntBtn").show();
          $("#dataIntBtnLoad").hide();
        },
      });
    });
  });

  $(document).ready(function () {
    $("#voucherIntBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/integrator.php",
        data: {
          voucher: "logoDel",
          voucherVendor: $("#voucherVendor").val(),
        },
        beforeSend: function () {
          $("#voucherIntBtn").hide();
          $("#voucherIntBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Bill Vendor Integrated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#voucherIntBtn").show();
          $("#voucherIntBtnLoad").hide();
        },
      });
    });
  });

  $(document).ready(function () {
    $("#cardIntBtn").click(function () {
      $.ajax({
        type: "POST",
        url: "../config/integrator.php",
        data: {
          cable: "logoDel",
          cableVendor: $("#cableVendor").val(),
        },
        beforeSend: function () {
          $("#cardIntBtn").hide();
          $("#cardIntBtnLoad").show();
        },
        success: function (response) {
          if (response == "success") {
            swal({
              title: "Success!!!",
              text: "Cable Vendor Integrated Successfully",
              icon: "success",
              button: "Ok",
            });
          } else {
            swal({
              title: "error!!!",
              text: response,
              icon: "error",
              button: "Retry",
            });
          }
          $("#cardIntBtn").show();
          $("#cardIntBtnLoad").hide();
        },
      });
    });
  });
  // ==========----======
  function show1() {
    let myEmail, collEmail, allEmails, createBtn, stopBtn, createEmail;
    myEmail = document.querySelector("#all_email");
    collEmail = document.querySelector("#collapse_email");
    allEmails = document.querySelector("#allEmails");
    createBtn = document.querySelector("#create_email");
    stopBtn = document.querySelector("#stop_email");
    createEmail = document.querySelector("#createEmail");
    myEmail.style.display = "none";
    collEmail.style.display = "inline";
    allEmails.style.display = "block";
    createBtn.style.display = "inline";
    stopBtn.style.display = "none";
    createEmail.style.display = "none";
  }

  function hide1() {
    let myEmail, collEmail, allEmails;
    myEmail = document.querySelector("#all_email");
    collEmail = document.querySelector("#collapse_email");
    allEmails = document.querySelector("#allEmails");
    myEmail.style.display = "inline";
    collEmail.style.display = "none";
    allEmails.style.display = "none";
  }

  function show2() {
    let createBtn, stopBtn, createEmail, myEmail, collEmail, allEmails;
    createBtn = document.querySelector("#create_email");
    stopBtn = document.querySelector("#stop_email");
    createEmail = document.querySelector("#createEmail");
    myEmail = document.querySelector("#all_email");
    collEmail = document.querySelector("#collapse_email");
    allEmails = document.querySelector("#allEmails");
    createBtn.style.display = "none";
    stopBtn.style.display = "inline";
    createEmail.style.display = "block";
    myEmail.style.display = "inline";
    collEmail.style.display = "none";
    allEmails.style.display = "none";
  }

  function hide2() {
    let createBtn, stopBtn, createEmail;
    createBtn = document.querySelector("#create_email");
    stopBtn = document.querySelector("#stop_email");
    createEmail = document.querySelector("#createEmail");
    createBtn.style.display = "inline";
    stopBtn.style.display = "none";
    createEmail.style.display = "none";
  }

  function show3() {
    let showLogo, hideLogo, createLogo, createFav, showFav, hideFav;
    showLogo = document.querySelector("#showLogo");
    hideLogo = document.querySelector("#hideLogo");
    createLogo = document.querySelector("#createLogo");
    createFav = document.querySelector("#createFav");
    showFav = document.querySelector("#showFav");
    hideFav = document.querySelector("#hideFav");
    showLogo.style.display = "none";
    hideLogo.style.display = "inline";
    createLogo.style.display = "block";
    showFav.style.display = "inline";
    hideFav.style.display = "none";
    createFav.style.display = "none";
  }

  function hide3() {
    let showLogo, hideLogo, createLogo;
    showLogo = document.querySelector("#showLogo");
    hideLogo = document.querySelector("#hideLogo");
    createLogo = document.querySelector("#createLogo");
    showLogo.style.display = "inline";
    hideLogo.style.display = "none";
    createLogo.style.display = "none";
  }

  function show4() {
    let createFav, showFav, hideFav, showLogo, hideLogo, createLogo;
    createFav = document.querySelector("#createFav");
    showFav = document.querySelector("#showFav");
    hideFav = document.querySelector("#hideFav");
    showLogo = document.querySelector("#showLogo");
    hideLogo = document.querySelector("#hideLogo");
    createLogo = document.querySelector("#createLogo");
    showFav.style.display = "none";
    hideFav.style.display = "inline";
    createFav.style.display = "block";
    showLogo.style.display = "inline";
    hideLogo.style.display = "none";
    createLogo.style.display = "none";
  }

  function hide4() {
    let createFav, showFav, hideFav;
    createFav = document.querySelector("#createFav");
    showFav = document.querySelector("#showFav");
    hideFav = document.querySelector("#hideFav");
    showFav.style.display = "inline";
    hideFav.style.display = "none";
    createFav.style.display = "none";
  }

  function show5() {
    let showLand, hideLand, setLand;
    showLand = document.querySelector("#showLand");
    hideLand = document.querySelector("#hideLand");
    setLand = document.querySelector("#setLand");
    showLand.style.display = "none";
    hideLand.style.display = "inline";
    setLand.style.display = "block";
  }

  function hide5() {
    let showLand, hideLand, setLand;
    showLand = document.querySelector("#showLand");
    hideLand = document.querySelector("#hideLand");
    setLand = document.querySelector("#setLand");
    showLand.style.display = "inline";
    hideLand.style.display = "none";
    setLand.style.display = "none";
  }

  function checkPass() {
    let password = document.querySelector("#password").value;
    let checkStatus = document.querySelector("#checkStatus");
    if (!/[A-Z]/.test(password)) {
      checkStatus.style.color = "red";
      checkStatus.style.display = "block";
      checkStatus.innerHTML = "Atleast One Uppercase";
    } else {
      if (!/[a-z]/.test(password)) {
        checkStatus.style.color = "red";
        checkStatus.style.display = "block";
        checkStatus.innerHTML = "Atleast One Lowercase";
      } else {
        if (!/[0-9]/.test(password)) {
          checkStatus.style.color = "red";
          checkStatus.style.display = "block";
          checkStatus.innerHTML = "Atleast One Number";
        } else {
          if (!/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password)) {
            checkStatus.style.color = "red";
            checkStatus.style.display = "block";
            checkStatus.innerHTML = "Atleast One Special Character";
          } else {
            if (password.length < 8) {
              checkStatus.style.color = "red";
              checkStatus.style.display = "block";
              checkStatus.innerHTML = "The Password should be upto 8 character";
            } else {
              checkStatus.style.display = "none";
            }
          }
        }
      }
    }
  }

  function confirmPass() {
    let password = document.querySelector("#password").value;
    let cpassword = document.querySelector("#cpassword").value;
    let createBtn = document.querySelector("#createMail");
    let checkStatus = document.querySelector("#checkStatus");
    let newEmail = document.querySelector("#newEmail").value;
    if (cpassword !== password) {
      checkStatus.style.color = "red";
      checkStatus.style.display = "block";
      checkStatus.innerHTML = "The Two Passwords Are Not Matching";
      createBtn.disabled = true;
    } else {
      if (newEmail !== " " && newEmail.length > 4) {
        if (cpassword.length > 8) {
          checkStatus.style.display = "none";
          createBtn.disabled = false;
        } else {
          checkStatus.style.display = "none";
        }
      } else {
        checkStatus.style.color = "red";
        checkStatus.style.display = "block";
        checkStatus.innerHTML = "The Email Should Be More Than 3 Characters";
        createBtn.disabled = true;
      }
    }
  }
  function viewPass1() {
    let password = document.querySelector("#password");
    let vi1 = document.querySelector("#vi1");
    let hi1 = document.querySelector("#hi1");
    password.type = "text";
    vi1.style.display = "none";
    hi1.style.display = "inline";
  }

  function hidePass1() {
    let password = document.querySelector("#password");
    let vi1 = document.querySelector("#vi1");
    let hi1 = document.querySelector("#hi1");
    password.type = "password";
    vi1.style.display = "inline";
    hi1.style.display = "none";
  }

  function viewPass2() {
    let cpassword = document.querySelector("#cpassword");
    let vi2 = document.querySelector("#vi2");
    let hi2 = document.querySelector("#hi2");
    cpassword.type = "text";
    vi2.style.display = "none";
    hi2.style.display = "inline";
  }

  function hidePass2() {
    let cpassword = document.querySelector("#cpassword");
    let vi2 = document.querySelector("#vi2");
    let hi2 = document.querySelector("#hi2");
    cpassword.type = "password";
    vi2.style.display = "inline";
    hi2.style.display = "none";
  }
</script>
</body>
</html>