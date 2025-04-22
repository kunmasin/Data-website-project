<?php
setcookie('data_users', '', time() - 3600, "/");
header("Location: DataLogin.php");
exit();
?>
