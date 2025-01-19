<?php
session_start();

if (isset($_SESSION['idConta'])) {
    
    session_unset();
    session_destroy();
}


header("Location: home.php");
exit;
?>