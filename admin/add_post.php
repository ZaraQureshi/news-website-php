<?php
include "header.php";
?>
<form action="save_post.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Enter title"/>
    <input type="text" name="desc" placeholder="Enter description"/>
    <select name="category">
        <?php
            include "config.php";

            $sql="SELECT * FROM category";
            $query=mysqli_query($conn,$sql) or die("Unsuccessfull");
            if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){
                echo "<option value='{$row['c_id']}'>{$row['c_name']}</option>";
            }
            }
        ?>
    </select>
    <input type="file" name="image" />
    <button type="submit" name="postBtn">POST</button>
</form>