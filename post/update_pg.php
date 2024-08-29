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
<body>

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

        $sql_category = "select * from category";
        $res_category = $pdo->prepare($sql_category);
        $res_category->execute();

        $category_data = $res_category->fetchAll(PDO::FETCH_ASSOC);

        if (isset ($_POST ['create_btn'])) {
            require_once("./update.php");
        }
    ?>


    <div class="container mt-5">
        <a href="../post/list.php" style="text-decoration: none; color:black;"><i class="fa fa-arrow-left" style="margin-right: 10px; color:black;"></i>Back</a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-4">
                    <img src="../image/<?php echo $data['image'] ?>" alt="" class="img-thumbnail" id="output">
                    <input type="file" name="image"  class="form-control" onchange="loadFile(event)">
                </div>
                <div class="col-8">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <h4>Title</h4>
                    <input type="text" name="title" id="" class="form-control " value="<?php echo $_POST['title'] ?? $data['title'] ?>">
                    <?php
                        if (isset ($_POST['create_btn'])) {
                            if ($error['titleRequireStatus']) {
                                echo '<span class="text-danger">Title name is required **</span>';
                            }
                        }
                    ?>

                    <h4 class="mt-4">Description</h4>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control "><?php echo $_POST['description'] ?? $data['description'] ?></textarea>
                    <?php
                        if (isset ($_POST['create_btn'])) {
                            if ($error['descriptionRequireStatus']) {
                                echo '<span class="text-danger">Description is required **</span>';
                            }
                        }
                    ?>

                    <h4 class="mt-4">Category Name</h4>
                    <select name="category" id="" class="form-control ">
                        <?php
                            foreach ($category_data as $posts) {
                                if($posts['name'] == $data['category_name']){
                                    echo '<option value="'.$posts['id'].'" selected>'.$posts['name'].'</option>';
                                }else{
                                    echo '<option value="'.$posts['id'].'">'.$posts['name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <div class="mt-3">
                        <input type="submit" value="Update" class="btn btn-primary mt-4 w-100" name="create_btn">
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>
<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="../js/imagePreview.js"></script>
</html>