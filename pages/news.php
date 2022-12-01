<?php
$db = Tools::connect();
// user input
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 5;
// positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
// query
$items = $db->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM news.news ORDER BY idate DESC LIMIT {$start}, {$perPage}");
$items->execute();
$items = $items->fetchAll(PDO::FETCH_ASSOC);
// pages
$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
$pages = ceil($total / $perPage);
?>

<div class="col-md-12">
    <?php foreach ($items as $item): ?>
        <div class="artilce">
            <div>
                <span class='idate'>
                    <?php echo date("d.m.Y", $item['idate']) ?>
                </span>
                <?php echo "<a href='pages/view.php?id=" . $item['id'] . "' >";
                    echo $item['title']; ?>
                </a>
                <p> <?php echo $item['announce'] ?> </p>
            </div>
        </div>
    <?php endforeach ?>
</div>
<hr>
<div class="col-md-12">
    <div class="well well-sm">
        <h4>Страницы:</h4>
        <div class="paginate">
            <?php for ($x = 1; $x <= $pages; $x++): ?>
                <ul class="pagination">
                    <li>
                        <a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage; ?>" >
                            <?php echo $x; ?>
                        </a>
                    </li>
                </ul>
            <?php endfor; ?>
        </div>
    </div>
</div>

<?php
// Код без пагинатора
/*
echo '<div class="row" style="margin-right:10px;" >';
$items=News::GetNews();
foreach($items as $item)
{
    $item->DrawAll();
}
echo '</div>';
*/ ?>
