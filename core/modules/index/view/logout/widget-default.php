<?php

if (!session_id()) session_start();

// -- eliminamos el usuario
if (isset($_SESSION['sisgauser_cedula'])) {
    //UserData::updateEnLinea($_SESSION['sisgauser_cedula']);
    unset($_SESSION['sisgauser_cedula']);
}
session_destroy();
print "<script>window.location='index.php';</script>";
?>

