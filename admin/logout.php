<?php
    include "config.php";
    session_start();
    session_unset();
    session_destroy();
    header("Location: {$hostname}/admin/admin_login.php");
?>