<?php
    include "config.php";
    include "header.php";
    include "recent.php";
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
    $limit=3;
    
    $offset=($page-1)*$limit;
     $sql="SELECT post.p_author,post.p_id,post.p_title,post.p_description,post.p_image,post.p_date,category.c_name,user.u_username,user.u_role,post.p_category FROM post
            LEFT JOIN category ON post.p_category=category.c_id
            LEFT JOIN user ON post.p_author=user.u_id
            ORDER BY post.p_id DESC LIMIT {$offset},{$limit}" ;

    $query=mysqli_query($conn,$sql) or die("unsuccessful");
    if(mysqli_num_rows($query)>0){
    while($row=mysqli_fetch_assoc($query)){?>
        <div class="post_container">
            <h3><?php echo $row['p_title'];?></h3>
            <img src="admin/upload/<?php echo $row['p_image'];?>">
            <p><?php echo substr($row['p_description'],0,5)."...";?></p>
            <?php echo "<p><a href='category.php?catid={$row['p_category']}'>{$row['c_name']}</a></p>";?>
            <p><?php echo $row['p_date'];?></p>
            <?php echo "<p><a href='author.php?uid={$row['p_author']}'>{$row['u_username']}</a></p>";?>
            <a href="single.php?id=<?php echo $row['p_id']?>">Read more</a>
        </div>
<?php
    }}

    $sql1="SELECT * FROM post";
    $result=mysqli_query($conn,$sql1);
    $total=mysqli_num_rows($result);
    $pages=ceil($total/$limit);
    echo"<ul>";
    
        for($i=1;$i<=$pages;$i++){
            echo"<li ><a href='?page=".$i."'>".$i."</a></li>";
        }
    
    echo "</ul>";
?>
