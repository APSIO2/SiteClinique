<?php

// Deconnexion
session_start();
unset($_SESSION['services']);
unset($_SESSION['id']);
header("Location: ../index.php");

?>