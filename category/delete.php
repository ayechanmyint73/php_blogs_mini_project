<?php

require_once("../db/db_connection.php");

$id = $_GET['id'];

$sql = "delete from category where id=?";
$res = $pdo->prepare($sql);

$res->execute([$id]);

header("Location:list.php");