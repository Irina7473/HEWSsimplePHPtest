<?php

echo '<div class="row" style="margin-right:10px;" >';
$items=News::GetNews();
foreach($items as $item)
{
    $item->DrawAll();
}
echo '</div>';
?>
