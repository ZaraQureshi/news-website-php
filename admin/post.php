<?php
include "header.php";
?>
<h1>POST Page</h1>
<a href="logout.php">Hello <?php echo $_SESSION['u_username']?>,Logout</a>
<?php
    
    if($_SESSION['u_role']=='1'){
        echo'<a href="show_user.php">user</a>
        <a href="category.php">Category</a>';
    }
?>
<a href="add_post.php">Add Post</a>

<table>

    <thead>
        <th>Sr no.</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
    <?php 
        include "config.php";
        if(isset($_GET['page'])){
        $page=$_GET['page'];
        }else{
            $page=1;
        }
        $limit=3;
        $offset=($page-1)*$limit;
        if($_SESSION['u_role']==='1'){
            $sql="SELECT post.p_id,post.p_title,post.p_date,category.c_name,user.u_username,post.p_category FROM post
                    LEFT JOIN category ON post.p_category=category.c_id
                    LEFT JOIN user ON post.p_author=user.u_id
                    ORDER BY p_id DESC LIMIT {$offset},{$limit}";
        }elseif ($_SESSION['u_role']==='0') {
            $sql="SELECT post.p_id,post.p_title,post.p_date,category.c_name,user.u_username FROM post
                    LEFT JOIN category ON post.p_category=category.c_id
                    LEFT JOIN user ON post.p_author=user.u_id
                    WHERE post.p_author={$_SESSION['u_id']}
                    ORDER BY p_id DESC LIMIT {$offset},{$limit}";
        }
        $query=mysqli_query($conn,$sql);
        //if(mysqli_num_rows($query)>0){?>
            <!-- <tr> -->
                <?php 
                    while($row=mysqli_fetch_assoc($query)){?>
                    <tr>
                        <td><?php echo $row['p_id'];?></td>
                        <td><?php echo $row['p_title'];?></td>
                        <td><?php echo $row['u_username'];?></td>
                        
                        <td><?php echo $row['c_name'];?></td>
                        <td><?php echo $row['p_date'];?></td>
                        <td><a href="update_post.php?id=<?php echo $row['p_id'];?>">Edit</a></td>
                        <td><a href="delete_post.php?id=<?php echo $row['p_id'];?>&catid=<?php echo $row['p_category'];?>">Delete</a></td>
                        </tr>
                        <?php
                    
                    }
                ?>
            <!-- </tr><br> -->
    <?php
   // }?>
    </tbody>
</table>
<?php
    $sql1="SELECT * FROM post";
    $result=mysqli_query($conn,$sql1) or die("Unsuccessfull");
    $total_page=mysqli_num_rows($result);
    $limit=3;
    $pages=ceil($total_page/$limit);
    echo"<ul>";
    for($i=1;$i<=$pages;$i++){
        echo"<li value=".$i."><a href='post.php?page=".$i."'>".$i."</a></li>
        </ul>";
    }
?>

<link rel="stylesheet" href="style.css">