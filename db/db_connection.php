<?php

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=blogs_mini_project_db","root","Chan7Tae7$");
    }catch(PDOException $exp){
        echo "Connection error - " . $exp->getMessage();
    }