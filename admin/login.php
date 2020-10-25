
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" placeholder="Enter username" name="uname"/>
        <input type="password" placeholder="Enter password" name="pass"/>
        <button type="submit" name="loginBtn">Login</button>
    </form>
    <?php
    if(isset($_POST['loginBtn'])){
        include "config.php";
        $uname=mysqli_real_escape_string($conn,$_POST['uname']);
        $pass=md5($_POST['pass']);
        $sql="SELECT u_id,u_username,u_role FROM user WHERE u_username='{$uname}' AND u_pass='{$pass}'" ;
        $query=mysqli_query($conn,$sql) or die("Unsuccessfull login");
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){
                session_start();
                $_SESSION['u_id']=$row['u_id'];
                $_SESSION['u_username']=$row['u_username'];
                $_SESSION['u_role']=$row['u_role'];
                header("Location: {$hostname}/admin/post.php");

            }
        }else{
            echo '<h3>Credentials invalid</h3>';
        }

    }
        
    ?>
    <?php
    include "config.php";
    session_start();
   if(isset($_SESSION['u_username'])){
       header("Location: {$hostname}/admin/post.php");
   }
?>
</body>
</html>