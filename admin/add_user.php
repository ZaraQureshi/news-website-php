<?php 
include "header.php";
if(isset($_POST['submitBtn'])){
    include "config.php";
    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
    $uname=mysqli_real_escape_string($conn,$_POST['uname']);
    $pass=mysqli_real_escape_string($conn,md5($_POST['pass']));
    $role=mysqli_real_escape_string($conn,$_POST['role']);

    $sql="SELECT u_username FROM user WHERE u_username='{$uname}'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo"<p>Username exists</p>";
    }else{
        $sql1="INSERT INTO user (u_fname,u_lname,u_username,u_pass,u_role) VALUES 
        ('{$fname}','{$lname}','{$uname}','{$pass}','{$role}')";
        $query=mysqli_query($conn,$sql1) or die("Unsuccesssfull");
        header("Location: {$hostname}/admin/show_user.php");
    }
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
    <h1>Add User</h1>
    <form method="POST" action="add_user.php">
        <input type="text" name="fname" placeholder="Enter first name"/>
        <input type="text" name="lname" placeholder="Enter last name"/>
        <input type="text" name="uname" placeholder="Enter username"/>
        <select name="role">
            <option value="0">user</option>
            <option value="1">Admin</option>
        </select>
        <input type="password" name="pass" placeholder="Enter password"/>
        <button type="submit" name="submitBtn">Submit</button>
    </form>
</body>
</html>