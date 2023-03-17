<?php

// Deconnexion
session_start();
unset($_SESSION['role']);
unset($_SESSION['id']);
header("Location: ../index.php");

?>