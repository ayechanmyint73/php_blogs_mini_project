<?php

    // echo $_GET['id'];
    require_once("../db/db_connection.php");

    $id = $_GET['id'];

    $sql_select = "select image from post where id=?";
    $res_select = $pdo->prepare($sql_select);
    $res_select->execute([$id]);

    $data = $res_select->fetch(PDO::FETCH_ASSOC);

    $delect_image_name = $data['image'];

    // echo "<pre>";
    // print_r($delect_image_name);

    $sql = 'delete from post where id=?';
    $res = $pdo->prepare($sql);
    $res->execute([$id]);

    // delete image from the local project folder
    unlink("../image/$delect_image_name");

    header("Location:list.php");