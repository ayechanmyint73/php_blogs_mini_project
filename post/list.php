<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs | Lists Page</title>

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/83dfd2d6e1.js" crossorigin="anonymous"></script>
</head>
<body style="margin: 20px 0; background-color: #adcdc6;">
    <?php

        require_once("../db/db_connection.php");

        require("./post_list.php");

        $sql_category = "select * from category";
        $res_category = $pdo->prepare($sql_category);
        $res_category->execute();

        $category_data = $res_category->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['create_btn'])) {
            require_once("./create.php");


            $sql_category = "select * from category";
            $res_category = $pdo->prepare($sql_category);
            $res_category->execute();

            $category_data = $res_category->fetchAll(PDO::FETCH_ASSOC);

        }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-2 offset-5">
                <a href="../category/list.php" style="text-decoration: none; color: black; font-size: 18px; font-weight: bold;">Category</a> | 
                <a href="../post/list.php" style="text-decoration: none; color: black; font-size: 18px; font-weight: bold;">Post</a>
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-3">
                        <img src="" id="output" class="w-100">
                    </div>
                    <div class="mt-3">
                        <input type="file" name="image" id="" class="form-control" onchange="loadFile(event)" value="<?php echo $_POST['image'] ?? ""; ?>">
                        <?php
                            if (isset ($_POST['create_btn'])) {
                                if ($error['imageRequireStatus']) {
                                    echo '<span class="text-danger">Image is required **</span>';
                                }
                            }
                        ?>
                    </div>

                    <div class="mt-3">
                        <input type="text" name="title" id="" class="form-control" placeholder="Enter Title..." value="<?php echo $_POST['title'] ?? ""; ?>">
                        <?php
                            if (isset ($_POST['create_btn'])) {
                                if ($error['titleRequireStatus']) {
                                    echo '<span class="text-danger">Title name is required **</span>';
                                }
                            }
                        ?>
                    </div>

                    <div class="mt-3">
                        <textarea type="text" name="description" id="" class="form-control" placeholder="Enter Description..." cols="30" rows="10" value="<?php echo $_POST['description'] ?? ""; ?>"></textarea>
                        <?php
                            if (isset ($_POST['create_btn'])) {
                                if ($error['descriptionRequireStatus']) {
                                    echo '<span class="text-danger">Description is required **</span>';
                                }
                            }
                        ?>
                    </div>

                    <div class="mt-3">
                        <select name="category" class="form-control">
                            <option value="<?php echo $_POST['category'] ?? ""; ?>">Choose Category...</option>
                            <?php
                                foreach ($category_data as $posts) {
                                    echo '<option value="'.$posts['id'].'">'.$posts['name'].'</option>';
                                }
                            ?>
                        </select>
                        <?php
                            if (isset ($_POST['create_btn'])) {
                                if ($error['categoryRequireStatus']) {
                                    echo '<span class="text-danger">Category name is required **</span>';
                                }
                            }
                        ?>                        
                    </div>

                    <div class="mt-3">
                        <input type="submit" value="Create" class="btn btn-success" name="create_btn">
                        <input type="reset" value="Clear" class="btn btn-danger">
                    </div>
                </form>
            </div>

            <div class="col">
                <div class="mt-5">
                    <a href="list.php"><button class="btn btn-secondary btn-sm btn-rounded mx-1">All</button></a>
                    <?php
                        foreach($category_data as $item){
                            echo '<a href="list.php?category='.$item['id'].'"><button class="btn btn-secondary btn-sm btn-rounded mx-1">'.$item['name'].'</button></a>';
                        }
                    ?>
                </div>
                <div class="row row-cols-3 row-cols-md-3 g-4" style="margin-top: 10px;">
                    <?php
                        foreach ($data as $item) {
                            echo '  <div class="col">
                                        <div class="card h-100" style="width: 18rem; padding:0;">
                                            <img src="../image/'.$item['image'].'" class="card-img-top" style="height:250px; width: 100%;">
                                            <div class="card-body">
                                                <h5 class="card-title">'.$item["title"].'</h5>
                                                <p class="card-text">'.mb_strimwidth($item['description'],0,100,'...').'</p>
                                                <p class="card-text" style="color:grey; font-weight: bold;">'.$item['category_name'].'</p>
                                                <a href="detail.php?id='.$item['id'].'" style="text-decoration: none; color: black; margin-right: 25px;">See more <i class="fas fa-arrow-right"></i></a>

                                                <a href="update_pg.php?id='.$item['id'].'" class="text-warning"><i class="fas fa-solid fa-edit" style="margin: 0 10px; font-size: 20px;"></i></a>
                                                <a href="delete.php?id='.$item['id'].'" class="text-danger"><i class="fa fa-solid fa-trash" style="margin: 0 10px; font-size: 20px;"></i></a>
                                                
                                            </div>
                                        </div>
                                    </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


    
</body>
    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="../js/imagePreview.js"></script>
</html>