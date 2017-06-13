<?php 
		if ($_GET["sort"]) {

			if ($page != 1) {
				$pstr_prev = '<li><a class="pstr_prev" href="'.$main_page.'sort='.$sorting.'&page='.($page - 1).'">&#60;</a></li>';
			}
			if ($page != $total) {
				$pstr_next = '<li><a class="pstr_next" href="'.$main_page.'sort='.$sorting.'&page='.($page + 1).'">&#62;</a></li>';
			}

			if($page - 5 > 0) $page5left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 5).'&sort='.$sorting.'">'.($page-5).'</a></li>';
			if($page - 4 > 0) $page4left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 4).'&sort='.$sorting.'">'.($page-4).'</a></li>';
			if($page - 3 > 0) $page3left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 3).'&sort='.$sorting.'">'.($page-3).'</a></li>';
			if($page - 2 > 0) $page2left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 2).'&sort='.$sorting.'">'.($page-2).'</a></li>';
			if($page - 1 > 0) $page1left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 1).'&sort='.$sorting.'">'.($page-1).'</a></li>';

			if($page + 5 <= $total) $page5right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 5).'&sort='.$sorting.'">'.($page+5).'</a></li>';
			if($page + 4 <= $total) $page4right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 4).'&sort='.$sorting.'">'.($page+4).'</a></li>';
			if($page + 3 <= $total) $page3right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 3).'&sort='.$sorting.'">'.($page+3).'</a></li>';
			if($page + 2 <= $total) $page2right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 2).'&sort='.$sorting.'">'.($page+2).'</a></li>';
			if($page + 1 <= $total) $page1right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 1).'&sort='.$sorting.'">'.($page+1).'</a></li>';

			if ($page+5 < $total) {
				$strtotal = '<li><p class="nav-point">...</p></li><li><a href="'.$main_page.'sort='.$sorting.'&page='.$total.'">'.$total.'</a></li>';
			}
			else {
				$strtotal = "";
			}

			if ($total > 1) {
					echo '
						<ul>';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left.'<li><a class="page_active" href="'.$main_page.'&sort='.$sorting.'&page='.$page.'">'.$page.'</a></li>'.$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
						echo '
						</ul>';
			}
		}

		else {
			if ($page != 1) {
				$pstr_prev = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 1).'">&#60;</a></li>';
			}
			if ($page != $total) {
				$pstr_next = '<li><a class="pstr_next" href="'.$main_page.'page='.($page + 1).'">&#62;</a></li>';
			}

			if($page - 5 > 0) $page5left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 5).'">'.($page-5).'</a></li>';
			if($page - 4 > 0) $page4left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 4).'">'.($page-4).'</a></li>';
			if($page - 3 > 0) $page3left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 3).'">'.($page-3).'</a></li>';
			if($page - 2 > 0) $page2left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 2).'">'.($page-2).'</a></li>';
			if($page - 1 > 0) $page1left = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page - 1).'">'.($page-1).'</a></li>';

			if($page + 5 <= $total) $page5right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 5).'">'.($page+5).'</a></li>';
			if($page + 4 <= $total) $page4right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 4).'">'.($page+4).'</a></li>';
			if($page + 3 <= $total) $page3right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 3).'">'.($page+3).'</a></li>';
			if($page + 2 <= $total) $page2right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 2).'">'.($page+2).'</a></li>';
			if($page + 1 <= $total) $page1right = '<li><a class="pstr_prev" href="'.$main_page.'page='.($page + 1).'">'.($page+1).'</a></li>';

			if ($page+5 < $total) {
				$strtotal = '<li><p class="nav-point">...</p></li><li><a href="'.$main_page.'page='.$total.'">'.$total.'</a></li>';
			}
			else {
				$strtotal = "";
			}

			if ($total > 1) {
					echo '
						<ul>';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left.'<li><a class="page_active" href="'.$main_page.'&sort='.$sorting.'&page='.$page.'">'.$page.'</a></li>'.$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
						echo '
						</ul>';
	}


			}
?>