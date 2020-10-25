<?php
include "header.php";
    include "config.php";
    if(isset($_POST['submitBtn'])){
        $id=mysqli_real_escape_string($conn,$_POST['id']);
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $uname=mysqli_real_escape_string($conn,$_POST['uname']);
        $role=mysqli_real_escape_string($conn,$_POST['role']);
    
        $sql_update="UPDATE user SET u_fname='{$fname}',u_lname='{$lname}',u_username='{$uname}',u_role='{$role}' WHERE u_id='{$id}'";
        $query=mysqli_query($conn,$sql_update) or die("Unsuccessfull");
        header("Location: {$hostname}/admin/show_user.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Modify user</h2>
    <?php

        $id=$_GET['id'];
        $sql="SELECT * FROM user WHERE u_id={$id}";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) > 0){
    ?>
    <form action="edit.php" method="POST">
        <?php
            while($row=mysqli_fetch_assoc($query)){
        ?>
        <input type="hidden" name="id" value="<?php echo $row['u_id']?>"/>
        <input type="text" name="fname"value="<?php echo $row['u_fname']?>"/>
        <input type="text" name="lname"value="<?php echo $row['u_lname']?>"/>
        <input type="text" name="uname"value="<?php echo $row['u_username']?>"/>
        <select name="role">
            <?php 
                if($row['u_role']==1){
                    ?>
                    <option value="1" selected>Admin</option>
                    <option value="0">User</option>
                    <?php
                }else{
                    ?>
                    <option value="1">Admin</option>
                    <option value="0" selected>User</option>
                    <?php
                }
            ?>
            
        </select>
        <button type="submit" name="submitBtn">Save</button>
            <?php
            }
            ?>
    </form>
    <?php
        }
    ?>
</body>
</html>