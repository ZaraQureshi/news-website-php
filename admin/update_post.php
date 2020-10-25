<?php
    if($_SESSION['u_role']==0){
        include "config.php";
        $post_id=$_GET['id'];
        $sql2="SELECT author FROM post WHERE p_id={$post_id}";
        $query2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($query2);
        if($row2['author']!=$_SESSION['u_id']){
            hedaer("Location: {$hostname}/admin/post.php");
        }

    }
    include "config.php";
    $id=$_GET['id'];
    $sql="SELECT post.p_id,post.p_title,post.p_description,post.p_image,post.p_category,category.c_name 
    FROM post LEFT JOIN category ON post.p_category=category.c_id 
    LEFT JOIN user ON post.p_author=user.u_id WHERE post.p_id={$id} ";
    $query=mysqli_query($conn,$sql) or die("unsucesfull");

?>
<html>
<body>
<form action="save_update_post.php" method="POST" enctype="multipart/form-data">
    <?php while($row=mysqli_fetch_assoc($query)){?>
        <input type="hidden" value="<?php echo $row['p_id'];?>" name="id">
        <input type="text" value="<?php echo $row['p_title'];?>" name="title">
        <input type="text" value="<?php echo $row['p_description'];?>" name="desc">
        <?php
            $sql1="SELECT * FROM category";
            $query1=mysqli_query($conn,$sql1);
            echo "<select name='category'>";
            while($row1=mysqli_fetch_assoc($query1)){
                if($row[p_category]==$row1[c_id]){
                    $select="selected";
                }else{
                    $select="";
                }
                echo"<option {$select} value='{$row1['c_id']}'>{$row1['c_name']}</option>";}
        echo"</select>"; ?>
        <input type="file" name="image_new">
        <img src="upload/<?php echo $row['p_image']?>" height="150px">
        <input type="hidden" value="<?php echo $row['p_image']?>" name="old_img">
        <input type="hidden" value="<?php echo $row['p_category']?>" name="old_cat">
    <?php }?>
    <input type="submit">
</form>
</body>
</html>