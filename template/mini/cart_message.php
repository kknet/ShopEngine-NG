<p id="cart_title">Следующий товар был добавлен в корзину:</p>
<div id="cart_m_image"><?php echo $image; ?></div>
<div id="cart_m_title">
<p class="cart_m_name"><?php echo $row["title"]; ?></p>
<p class="cart_m_price"><?php echo number_rank($row["price"]);?>₽</p><span class="cart_m_avail"><?php echo $availability_vari; ?></span>
</div>
<a id="cart_to_order" href="/cart/">Перейти в корзину</a>