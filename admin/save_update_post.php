<?php
    include "header.php";
    include "config.php";
    if(empty($_FILES['image_new']['name'])){
        $file_name=$_POST['old_img'];
    }else{
        $errors=array();

        $file_name=$_FILES['image_new']['name'];
        $file_size=$_FILES['image_new']['size'];
        $file_tmp=$_FILES['image_new']['tmp_name'];
        $file_type=$_FILES['image_new']['type'];
        $file_ext=end(explode('.',$file_name));
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

    echo $sql="UPDATE post SET p_title='{$_POST['title']}',p_description='{$_POST['desc']}',p_category='{$_POST['category']}',p_image='{$file_name}' 
        WHERE p_id='{$_POST['id']}'";
    if($_POST['old_cat']!=$_POST['category']){
        $sql.="UPDATE category SET c_post=c_post-1 WHERE c_id={$_POST['old_cat']};";
        $sql.="UPDATE category SET c_post=c_post+1 WHERE c_id={$_POST['category']};";
        
        
    }

    $query=mysqli_query($conn,$sql) or die("Unsuccessfull");
    
    header("Location: {$hostname}/admin/post.php");
?>