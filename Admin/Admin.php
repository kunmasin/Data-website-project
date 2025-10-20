<?php
setcookie('reseller_user', '', time() - 3600, "/");
header("Location: AdminLogin.php");
exit();
?>
