<?php
    include "header.php";
    include "config.php";
    $id=$_GET['id'];
    $catid=$_GET['catid'];
    $sql1="SELECT * FROM post WHERE p_id={$id}";
    $result=mysqli_query($conn,$sql1) or die("unsuccessful query");
    $row=mysqli_fetch_assoc($result);
    
     unlink("upload/".$row['p_image']);
    
    $sql="DELETE FROM post WHERE p_id={$id};";
    $sql.="UPDATE category SET c_post=c_post-1 WHERE c_id={$catid}";
    mysqli_multi_query($conn,$sql) or die("unsuccessfull");
    header("Location: {$hostname}/admin/post.php");
?>