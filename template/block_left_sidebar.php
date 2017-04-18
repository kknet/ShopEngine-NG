<div id="left_sidebar">
    <?php $array = GetLeftSidebar(); 
    foreach ($array as $row) { ?>
        <div class="side_block" cooo="<?php echo $row['count']; ?>">
            <?php echo $row['header']; ?>
            <div class="side_image">
                <?php echo $row['image']; ?>
            </div>
                <p class="side_type"><?php echo $row['type']; ?></p>
            <div class="side_name"><a href="/product/<?php echo $row['id']; ?>" /><?php echo $row['title']; ?></a></div>
            <div class="side_price">
                <p><span class="old_price"><?php echo ShopEngine::Help()->NumberRank($row['old_price']); ?></span><?php echo ShopEngine::Help()->NumberRank($row['price']); ?><span>&#8381;</span></p>
                <a class="js_product_to_cart" brid="<?php echo $row['id']; ?>"></a>
            </div>
        </div>
    <?php } ?>
</div>
<div style="clear:both;"></div>