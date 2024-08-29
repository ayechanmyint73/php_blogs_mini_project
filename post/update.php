<?php 

    require_once("../db/db_connection.php");

    $error = [
        'titleRequireStatus' => false ,
        'descriptionRequireStatus' => false ,
    ];

    $error['titleRequireStatus'] = $_POST['title'] == "" ? true : false ;
    $error['descriptionRequireStatus'] = $_POST['description'] == "" ? true : false ;

    
    if(!$error['titleRequireStatus'] && !$error['descriptionRequireStatus']){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category'];

        if($_FILES['image']['name'] == ""){ //when user doesn't updated the image
            $sql = "update post set title=? , description=? , category_id=? where id=? ";
            $res = $pdo->prepare($sql);
            $res->execute([$title, $description, $category_id, $id]);

        } else{
            $sql_photo = 'select image from post where id=?';
            $res_photo = $pdo->prepare($sql_photo);
            $res_photo->execute([$id]);

            $data = $res_photo->fetch(PDO::FETCH_ASSOC);

            // delete existing image
            unlink("../image/" . $data['image']);

            $image_name = uniqid() . $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $target_file = "../image/" .  $image_name;

            move_uploaded_file($tmp_name, $target_file);

            $sql = "update post set title=? , description=? , image=?, category_id=? where id=? ";
            $res = $pdo->prepare($sql);
            $res->execute([$title, $description, $image_name, $category_id, $id]);
        }

        header("Location:list.php");
    }