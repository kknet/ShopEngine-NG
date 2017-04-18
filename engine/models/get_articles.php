<?php defined('shopengine') or die('something wrong');
	class Footer extends Model {
		public function GetArticles() {
			$block = mysql_query("SELECT * FROM article_blocks");
			$block_row = mysql_fetch_array($block);
			do {
				$id = $block_row['id'];
			echo '<div>
				<p>'.$block_row["title"].'</p>
					<ul>';
					$result = mysql_query("SELECT * FROM articles WHERE block_id='$id'",$link);
						$row = mysql_fetch_array($result);
						do {
							echo '<li><a href="/badum/'.$row["id"].'">'.$row['name'].'</a></li>';
						}
						while($row = mysql_fetch_array($result));
				echo'</ul>
			</div>';
			}
			while ($block_row = mysql_fetch_array($block));
		}
	}
?>