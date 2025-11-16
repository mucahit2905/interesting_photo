<?php
session_start();
session_destroy();
setcookie("kullanici", "", time() - 3600, "/");
header("Location:index.php");
exit;

?>
