<div id="right_sidebar">
	<div id="cat_menu">
		<?php GetTheMenu();?>
	</div>
	<div id="search_header">
		<p>Поиск по параметрам</p>
	</div>
	<div id="search_block">
		<form id="search_select" action="/filter/" method="GET">
			<p id="p_type">Тип</p>
				<select id="select_type" size="1" name="select_type">
					<?php GetCategories(); ?>
				</select><br/>
			<p id="p_model">Производитель</p>
				<div id="select_model_block">
					<?php GetBrands();?>
				</div>
			<p id="p_price">Диапазон цен</p>

			<div class="price_block"><p class="from_to">От</p><input type="text" name="from" id="from" placeholder="5000" value="<?php ValueFrom(); ?>" /><p class="rub">руб.</p></div><br/>
			<div class="price_block"><p class="from_to">До</p><input type="text" name="to" id="to" placeholder="15000" value="<?php ValueTo(); ?>" /><p class="rub">руб.</p></div><br/>
			<input type="submit" name="search_button" id="search_button" value="Поиск"/>
		</form>
	</div>
</div>