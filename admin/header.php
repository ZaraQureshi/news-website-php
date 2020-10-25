<?php
include "config.php";
    session_start();
    if(!isset($_SESSION['u_username'])){
        header("Location: {$hostname}/admin/login.php");
    }
?>