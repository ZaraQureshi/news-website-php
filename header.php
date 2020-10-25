<?php
    include "config.php";
    
    // echo "<pre>";
    // print_r(basename($_SERVER['PHP_SELF']));
    // echo "</pre>";
    $page=basename($_SERVER['PHP_SELF']);
    //switch($page){
        if ($page=='single.php'){
            
            if(isset($_GET['id'])){
                echo $_GET['id'];
                $sql_title="SELECT * FROM post WHERE p_id='{$_GET['id']}'";
                $query_title=mysqli_query($conn,$sql_title) or die("unsuccess");
                $row_title=mysqli_fetch_assoc($query_title);
                $page_title=$row_title['p_title'];
            }else{
                $page_title="Not found";
            }
        }
    //     break;
    //     case "author.php":
    //         if(isset($_GET['id'])){
    //             $sql_title="SELECT * FROM user WHERE u_id={$_GET['uid']}";
    //             $query_title=mysqli_query($conn,$sql_title) or die("unsuccess");
    //             $row_title=mysqli_fetch_assoc($query_title);
    //             $page_title=$row_title['u_username'];
    //         }else{
    //             $page_title="Not found";
    //         }
    //     break;
    // }
     if(isset($_GET['catid'])){
         $cat_id=$_GET['catid'];
     }
     else{
         $cat_id=0;
     }
    //$cat_id=$_GET['catid'];
    $sql="SELECT * FROM category WHERE c_post > 0";
    $result=mysqli_query($conn,$sql) or die("unsuccessfull");
   
?><html>
    <head><title><?php echo $page_title; ?></title></head>
    <body>
        <div>
            <ul>
            <?php 
            echo "<li ><a  href='{$hostname}'>Home</a></li>";
            while($row=mysqli_fetch_assoc($result)){
                
                if($row['c_id']==$cat_id){
                    $active="active";
                }else{
                    $active="";
                }
               echo "<li ><a class='{$active}' href='category.php?catid={$row['c_id']}'>{$row['c_name']}</a></li>";
            } ?>
            </ul>
            <?php $sql1="SELECT * FROM post";
                $query=mysqli_query($conn,$sql1);
                $row1=mysqli_fetch_assoc($query);?>
            <form action="search.php" action="POST">
            <input type="text" name="search">
            <button type="submit"><a>Submit</a></button>
            </form>
                <?php ?>
        </div>
   </body>
</html>