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
    <style>
        .block {
            height: 200px;
            background-color: #000;
        }
    </style>
</head>

<body>
<h1>Новости</h1>
<hr>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php include_once("pages/news.php");?>

            <?php
/*            echo '<div class="row" style="margin-right:10px;" >';
            $items=News::GetNews();
            foreach($items as $item)
            {
                $item->DrawAll();
            }
            echo '</div>';
            */?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

        </div>
    </div>
</div>
</body>

</html>