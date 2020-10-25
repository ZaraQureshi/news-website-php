<?php
    include "config.php";
    $id=$_GET['id'];
    $sql="SELECT post.p_id,post.p_title,post.p_description,post.p_image,post.p_date,category.c_name,user.u_username,user.u_role FROM post
            LEFT JOIN category ON post.p_category=category.c_id
            LEFT JOIN user ON post.p_author=user.u_id
            WHERE p_id='{$id}'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($query)){?>
        <div>
        <h3><?php echo $row['p_title'];?></h3>
            <img src="admin/upload/<?php echo $row['p_image'];?>">
            <p><?php echo $row['p_description'];?></p>
            <p><?php echo $row['c_name'];?></p>
            <p><?php echo $row['p_date'];?></p>
            <p><?php echo $row['u_username'];?></p>
        </div>
    <?php }
?>