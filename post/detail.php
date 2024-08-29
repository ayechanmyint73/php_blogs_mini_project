<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs | Details Page</title>

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/83dfd2d6e1.js" crossorigin="anonymous"></script>
</head>
<body style="margin: 30px 80px; background-color: #adcdc6;>

    <?php
        require_once("../db/db_connection.php");

        $id = $_GET['id'];

        $sql = "select post.id, post.title, post.description, post.image, post.category_id, category.name as category_name from post
                left join 
                category on 
                category.id = post.category_id where post.id=?";
        $res = $pdo->prepare($sql);
        $res->execute([$id]);

        $data = $res->fetch(PDO::FETCH_ASSOC);

        // echo "<pre>";
        // print_r($data);
    ?>


    <div class="container mt-5">
        <a href="../post/list.php" style="text-decoration: none;"><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>Back</a>
        <div class="row mt-3">
            <div class="col-4">
                <img src="../image/<?php echo $data['image'] ?>" alt="" class="img-thumbnail">
            </div>
            <div class="col-8">
                <h4><?php echo $data['title'] ?></h4>
                <p><?php echo $data['description'] ?></p>
                <h5 style="color: grey; font-weight: bold;">Category <?php echo $data['category_name'] ?></h5>
            </div>
        </div>
    </div>
    
</body>
<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>