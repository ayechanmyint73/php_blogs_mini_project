<?php

    require_once("../db/db_connection.php");

    $category = $_GET['category'];
    $id = $_GET['id'];

    if($category != ""){
        $sql = "update category set name=? where id=?";
        $res = $pdo->prepare($sql);
        $res->execute([$category, $id]);

        header("Location:list.php");
    }else{
        header("Location:list.php");
    }

// echo "<pre>";
// print_r($_GET);
