<?php defined('shopengine') or die('something wrong'); 
	class search_engine {

		public function __construct() {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$search = strtolower(clear_string($_POST['text']));

				$result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1'");

				if(mysql_num_rows($result) > 0) {
					$result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' LIMIT 5");
					$row = mysql_fetch_array($result);
					do {
						$title = $row['title'];
						echo "<li><a href='/search/?search=".$title."'>".$title."</a></li>";
					}
					while ($row = mysql_fetch_array($result));
					}
				}
	}
}
?>