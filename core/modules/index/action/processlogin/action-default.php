<?php
if (!session_id()) session_start();
if (isset($_POST['btn-login'])) {
    $ucedula = $_POST['txtCedula'];
    $upass = $_POST['txtPassword'];

    if (UserData::getLogin($ucedula, $upass)) {
        print "<script>window.location='./'</script>";

    } else {
         print "<script>window.location='./'</script>";
        $error = "Acceso fallido !";
    }
}


?>