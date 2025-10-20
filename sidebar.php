  <!-- Sidebar -->
<nav class="navbar navbar-expand-xl navbar-white bg-white">
        <button type="button" id="sidebarCollapse" class="btn btn-primary icon">
            <i class="fas fa-bars"></i>
        </button>
        <div id="inDline"> 

            <button id="closeSidebar">&times;</button> <!-- Close icon -->
                <img class="myImage" src="..\Day7\Images\IMG-20240326-WA0118.jpg" alt="Admin Image">
            <div class=""><p class="myP"><span class="fa-solid fa-home" aria-hidden="true"></span> <a class="myA" href="DataDashboard.php" >Dashboard</a></p></div>
            <div class=""><p class="myP"><span class="fa fa-file-code-o" aria-hidden="true"></span> <a class="myA" href="DataDashboardAirtime.php" >Buy Airtime</a></p></div>
            <div class=""><p class="myP"><span class="fa-solid fa-money-bill" aria-hidden="true"></span> <a class="myA" href="DataDashboardData.php" >Buy Data</a></p></div>
            <div class=""><p class="myP"><span class="fas fa-user-friends" aria-hidden="true"></span> <a class="myA" href="DataDashboardCable.php" >Cable Subscription</a></p></div>
            <div class=""><p class="myP"><span class="fa-solid fa-users-between-lines" aria-hidden="true"></span> <a class="myA" href="DataDashboardUtility.php" >Utility Bills</a></p></div>
            <div class=""><p class="myP"><span class="fas fa-history" aria-hidden="true"></span> <a class="myA" href="DataTransaction.php" >Transaction History</a></p></div>
            <div class=""><p class="myP"><span class="fas fa-code" aria-hidden="true"></span> <a class="myA" href="DataFundWallet.php">Fund Wallet</a></p></div>
            <div class=""><p class="myP"><span class="fa-solid fa-toggle-on" aria-hidden="true"></span> <a class="myA" href="DataAccountSetting.php" >Settings</a></p></div>
            <div class=""><p class="myP"><span class="fa-solid fa-right-from-bracket" aria-hidden="true"></span> <a class="myA" href="DataLogOut.php" >Log Out</a></p></div>
        </div>    
    </nav>
 
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