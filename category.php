<?php
    include "config.php";
    include "header.php";
    if(isset($_GET['catid'])){
        $cat_id=$_GET['catid'];
    }
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
    $limit=3;
    
    $offset=($page-1)*$limit;
     $sql="SELECT post.p_id,post.p_title,post.p_description,post.p_image,post.p_date,category.c_name,user.u_username,user.u_role FROM post
            LEFT JOIN category ON post.p_category=category.c_id
            LEFT JOIN user ON post.p_author=user.u_id
            WHERE category.c_id={$cat_id}
            ORDER BY post.p_id DESC LIMIT {$offset},{$limit}" ;

    $query=mysqli_query($conn,$sql) or die("unsuccessful");
    if(mysqli_num_rows($query)>0){
    while($row=mysqli_fetch_assoc($query)){?>
        <h1><?php echo $row['c_name'];?></h1>
        <div class="post_container">
            <h3><?php echo $row['p_title'];?></h3>
            <img src="admin/upload/<?php echo $row['p_image'];?>">
            <p><?php echo substr($row['p_description'],0,5)."...";?></p>
            <p><?php echo $row['c_name'];?></p>
            <p><?php echo $row['p_date'];?></p>
            <p><?php echo $row['u_username'];?></p>
            <a href="single.php?id=<?php echo $row['p_id']?>">Read more</a>
        </div>
<?php
    }}

    $sql1="SELECT c_post FROM category WHERE c_id={$cat_id}";
    $result=mysqli_query($conn,$sql1) or die("unsuccess");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
    $total=$row['c_post'];
    $pages=ceil($total/$limit);
    echo"<ul>";
    
        for($i=1;$i<=$pages;$i++){
            echo"<li ><a href='?catid=".$cat_id."&page=".$i."'>".$i."</a></li>";
        }
    
    echo "</ul>";
    }
?>
