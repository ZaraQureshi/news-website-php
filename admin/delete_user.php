<?php
    $id=$_GET['id'];
    include "config.php";
    $sql="DELETE FROM user WHERE u_id='{$id}'";
    $query=mysqli_query($conn,$sql) or die("Unsuccessfull");
    header("Location: {$hostname}/admin/show_user.php");
    
?>