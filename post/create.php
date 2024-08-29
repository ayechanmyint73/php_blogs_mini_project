<?php

    // echo "<pre>";
    // print_r($_POST);

    require_once("../db/db_connection.php");

    $error = [
        'titleRequireStatus' => false ,
        'descriptionRequireStatus' => false ,
        'imageRequireStatus' => false ,
        'categoryRequireStatus' => false ,
    ];

    $error['titleRequireStatus'] = $_POST['title'] == "" ? true : false ;
    $error['descriptionRequireStatus'] = $_POST['description'] == "" ? true : false ;
    $error['imageRequireStatus'] = $_FILES['image']['name'] == "" ? true : false ;
    $error['categoryRequireStatus'] = $_POST['category'] == "" ? true : false ;

    if(!$error['titleRequireStatus'] && !$error['descriptionRequireStatus'] && !$error['imageRequireStatus'] && !$error['categoryRequireStatus']){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category'];

        // echo $title . $description . $category_id;

        // echo "<pre>";
        // print_r($_FILES);

        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $target_file = "../image/" .  $image_name;

        move_uploaded_file($tmp_name, $target_file);

        $sql = "insert into post (title, description, image, category_id) values (?,?,?,?)";
        $res = $pdo->prepare($sql);
        $res->execute([$title, $description, $image_name, $category_id]);

        header("Location:list.php");
    }
    
    