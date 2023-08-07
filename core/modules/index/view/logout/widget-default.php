<?php

if (!session_id()) session_start();

// -- eliminamos el usuario
if (isset($_SESSION['user_id'])) {
    //UserData::updateEnLinea($_SESSION['sisgauser_cedula']);
    unset($_SESSION['user_id']);
}
session_destroy();
print "<script>window.location='index.php';</script>";
?>

