<?php

session_start();  
session_destroy();  
header("location:../vista/log.php");  
// header("location:index.php?action=login");  
?>