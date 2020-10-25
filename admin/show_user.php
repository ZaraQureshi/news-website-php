
<?php
include "header.php";
    include "config.php";
    
    if($_SESSION['u_role']=='0'){
        header("Location: {$hostname}/admin/post.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Show User</h2>
    <a href="add_user.php">Add user</a>
    <a href="show_user.php">users</a>
    <table >
        <thead>
            <th>Sr no.</th>
            <th>Full name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <?php
            
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }
            $limit=3;
            
            $offset=(($page-1)*$limit);
            echo $sql="SELECT * FROM user ORDER BY u_id DESC LIMIT {$offset},{$limit} ";
            
            $query=mysqli_query($conn,$sql) or die("Unsuccessfull");
            if(mysqli_num_rows($query) > 0){
                ?>
                <tbody>
                    <?php
                        while($row=mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td><?php echo $row['u_id']; ?></td>
                                <td><?php echo $row['u_fname']." ".$row['u_lname']; ?></td>   
                                <td><?php echo $row['u_username']; ?></td>
                                <td>
                                    <?php 
                                        if($row['u_role']==1){
                                            echo"Admin";
                                        }else{
                                            echo "User";
                                        }    
                                    ?> 
                                </td>
                                <td><a href="edit_user.php?id=<?php echo $row['u_id'];?>">EDIT</a></td>
                                <td><a href="delete_user.php?id=<?php echo $row['u_id'];?>">DELETE</a></td>
                            </tr>
                            <?php
                            }
                        ?>
                    
                </tbody>
            <?php
            }
        ?>
    </table>
    <div>
        <?php

            include "config.php";
            $sql1="SELECT * FROM user";
            $query1=mysqli_query($conn,$sql1) or die("Unsuccessfull paging");
            if(mysqli_num_rows($query1)>0){
                $total_page=mysqli_num_rows($query1);
               $limit=3;
                $pages=ceil($total_page / $limit);
                echo '<ul name="paging">';
                if($page>1){
                    echo'<li ><a href="'.($pages-1).'">Prev</a></li>';
                }
                
                for($i=1;$i<=$pages;$i++){

                    echo'<li><a href="show_user.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($pages > $page){
                    echo'<li><a href="'.($pages+1).'">Next</a></li>';
                }else{
                    echo'';
                }
                
                echo'</ul>';
            }
        ?>
        
            
        </ul>
    </div>
</body>
</html>