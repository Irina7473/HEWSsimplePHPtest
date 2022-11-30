<?php
include_once("classes.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

echo $id;
$item=News::fromDb(1);
if($item==null)exit();
$item->DrawContent();
?>
<br />
<hr>
<a href='news.php'>Все новости >></a>


