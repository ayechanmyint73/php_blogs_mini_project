<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs | Lists Page</title>

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="margin: 20px 0; background-color: #adcdc6;">
    <?php
        require_once("../db/db_connection.php");

        $sql_read = "select * from category";
        $res_read = $pdo->prepare($sql_read);
        $res_read->execute();

        $data = $res_read->fetchAll(PDO::FETCH_ASSOC);

    ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-2 offset-5">
                <a href="../category/list.php" style="text-decoration: none; color: black; font-size: 18px; font-weight: bold;">Category</a> | 
                <a href="../post/list.php" style="text-decoration: none; color: black; font-size: 18px; font-weight: bold;">Post</a>
            </div>
        </div>

        <div class="row">
            <?php
                if (isset($_POST['create_btn'])) {
                    require_once("./create.php");

                    $sql_read = "select * from category";
                    $res_read = $pdo->prepare($sql_read);
                    $res_read->execute();

                    $data = $res_read->fetchAll(PDO::FETCH_ASSOC);
                }
            ?>
            <div class="col-4 p-5">
                <form action="" method="post">
                    <div class="">
                        <input type="text" name="category" id="" class="form-control" placeholder="Enter Category name...">
                        <?php
                            if (isset ($_POST['create_btn'])) {
                                if ($categoryRequireStatus) {
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
                <?php
                    foreach($data as $lists){
                        echo '
                            <div class="row p-4 shadow-sm">
                                <div class="col-7">
                                    <div class="">
                                        <h4>'.$lists['name'].'</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    
                                    <a href="update_pg.php?id='.$lists['id'].'"><button class="btn btn-success">Update</button></a>
                                    <a href="delete.php?id='.$lists['id'].'"><button class="btn btn-danger">Delete</button></a>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>


    
</body>
    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>