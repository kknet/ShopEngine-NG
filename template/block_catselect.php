<div id="cat_select">
    <p id="p_category">Вид:</p>
    <strong class="style_grid"><img src="style/img/grid-passive.png" /></strong>
    <strong class="style_list"><img src="style/img/list-passive.png" /></strong>
    <p id="p_sort">Сортировать: <span><?= GetSortingName() ?></span></p>
    <ul id="style_sort" class="sort_passive">
        <?php ShopEngine::Help()->GetSorting() ?>
    </ul>
</div>