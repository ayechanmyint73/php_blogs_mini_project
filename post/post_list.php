<?php

    require_once("../db/db_connection.php");

    if(isset ($_GET['category'])){
        $sql = "select post.id, post.title, post.description, post.image, post.category_id, category.name as category_name 
        from post
        left join category 
        on 
        category.id = post.category_id 
        where post.category_id=?
        order by post.created_at";
        $res = $pdo->prepare($sql);
        $res->execute([$_GET['category']]);

        $data = $res->fetchAll(PDO::FETCH_ASSOC);
    } else{
        $sql = "select post.id, post.title, post.description, post.image, post.category_id, category.name as category_name from post
        left join 
        category on 
        category.id = post.category_id 
        order by post.created_at";
        $res = $pdo->prepare($sql);
        $res->execute();

        $data = $res->fetchAll(PDO::FETCH_ASSOC);
    }