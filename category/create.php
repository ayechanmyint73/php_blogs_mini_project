<?php

    // require_once("../db/db_connection.php");

    // $category = $_POST['category'];

    // if ($category != "") {
    //     $sql = "insert into category (name) values (?)";
    //     $res = $pdo->prepare($sql);
    //     $res->execute([$category]);

    //     header("Location:list.php");
    // } else{
    //     header("Location:list.php");
    // }

    $categoryRequireStatus = false;

    if( $_REQUEST['category'] != ""){
        require_once("../db/db_connection.php");

        $category = $_POST['category'];

        $sql = "insert into category (name) values (?)";
        $res = $pdo->prepare($sql);
        $res->execute([$category]);

        $categoryRequireStatus = false;

        header("Location:list.php");
    }else{
        $categoryRequireStatus = true;
    }      
