<?php
@session_start();
include_once("classes.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$item=News::fromDb($id);
if($item==null)exit();
$item->DrawContent();
?>
<br />
<hr>
<a href='../index.php'>Все новости</a>