<?php
 include "header.php";
 include "config.php";
 if(isset($_POST['postBtn'])){
    if(isset($_FILES['image'])){
        $errors=array();

        $file_name=$_FILES['image']['name'];
        $file_size=$_FILES['image']['size'];
        $file_tmp=$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$file_name)));
        $extensions=array("jpeg","png","jpg");
        if(in_array($file_ext,$extensions)===FALSE){
            $errors[]="invalid extension. Include jpg,jpeg or png.";
        }
        if($file_size>2097152){
            $errors[]="file should be 2MB";
        }
        if(empty($errors)==TRUE){
            move_uploaded_file($file_tmp,"upload/".$file_name);
        }else{
            print_r($errors);
            die();
        }
    }
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $description=mysqli_real_escape_string($conn,$_POST['desc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $date=date("d M, Y");

    $author=$_SESSION['u_id'];
 }
 $sql="INSERT INTO post (p_title,p_description,p_image,p_date,p_category,p_author) 
        VALUES('{$title}','{$description}','{$file_name}','{$date}','{$category}','{$author}');";
 $sql .="UPDATE category SET c_post=c_post+1 WHERE c_id={$category}";
 if(mysqli_multi_query($conn,$sql)){
    header("Location: {$hostname}/admin/post.php");
 }
?>