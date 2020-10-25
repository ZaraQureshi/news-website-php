<?php
    //include "header.php";
    include "config.php";
    $limit=3;
    $sql="SELECT post.p_id,post.p_title,post.p_image,post.p_date FROM post
    
    ORDER BY post.p_id DESC LIMIT {$limit}";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($query)){
?>
    <h5><?php echo $row['p_title'];?></h5>
    <img src="admin/upload/".<?php echo $row['p_image'];?>>
    <p><?php echo $row['p_date'];?></p>
    <a href="single.php?id=<?php echo $row['p_id'];?>"></a>
    <?php } ?>