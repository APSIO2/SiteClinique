<?php

session_start();
unset($_SESSION['services']);
header("Location: ../index.php");

?>