<?php
@session_start();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
include_once("pages/classes.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НОВОСТИ</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h1>Новости</h1>
<div class="container-fluid">
    <hr>
    <div class="row">
        <div class="col-12">
            <?php include_once("pages/news.php"); ?>
        </div>
    </div>
</div>
</body>
</html>