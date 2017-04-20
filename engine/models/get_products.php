<?php 

Class Products 
{
    public static function GetProducts($query)
    {
        $db = database::getInstance();
        $array = $query->fetchAll();
        if(count($array) > 0)
        {
            $grid = array();

            foreach($array as $row)
            {    
                //Подсчет оценки, количества просмотров и количества отзывов для списка
                $count_of_views = $row['count'];
                if ($count_of_views > 999) {
                    $count_of_views = "999+";
                }

                $id_vari = $row['products_id'];
//                $tmp = $db->prepare("SELECT COUNT(*) FROM reviews_table WHERE products_id=? AND moderation='1'");
//                $tmp->execute([$id_vari]);
//                $count_of_reviews = count($tmp->fetchColumn());
//
//                if($count_of_reviews > 999) {
//                    $count_of_reviews = "999+";
//                }

//                $tmp = $db->prepare("SELECT vote FROM reviews_table WHERE products_id=?");
//                $tmp->execute([$id_vari]);
//                $product_votes = $tmp->fetchAll();
//                    if(count($product_votes) > 0) 
//                    {
//                        $votes_count = count($product_votes);
//                        foreach ($product_votes as $cur) 
//                        {
//                            $total_votes = $total_votes + $cur['vote'];
//                        }
//                        $mark = $total_votes / $votes_count;
//                        $mark = round($mark,1);
//                    }
//                        else {
//                $mark = '<span class="no_mark">Нет оценки</span>';
//                }

                //Добавление флажка "хит","новинка" или "распродажа" (если требуется)

//                if ($row['new'] === 1) {
//                    $sales_news_popular = '<div class="sales_news_popular"><img src="/style/img/news.png" alt="image"/></div>';
//                }
//                elseif ($row['leader'] === 1) {
//                    $sales_news_popular = '<div class="sales_news_popular"><img src="/style/img/leader.png" alt="image"/></div>';
//                }
                // Изменено!
                if ($row['old_price'] != 0) {
                    $sales_news_popular = '<div class="product-tag product-tag--absolute" aria-hidden="true">%</div>';
                }
                //
                else {
                    $sales_news_popular = '';
                }
                    $image = ShopEngine::Help()->ImageResize($row["image"], 177.2, 255, $row['title'], 'px');

//                    if ($row['availability'] == 1) {
//                    $availability_vari = "Есть в наличии";
//                    }
//                    else {
//                    $availability_vari = "Нет в наличии";
//                    }
                    // Изм!
                    if($row["old_price"] != 0.00) {
                        $old_price = ShopEngine::Help()->AsPrice($row['old_price']);
                    } else {
                        $old_price = null;
                    }
                    //
                // Это не помешало бы сделать внутри запроса в контроллере. Но, увы, тогда придется писать много лишнего
                    $stmt = $db->prepare("SELECT name, category_handle FROM category WHERE category_id=?");
                    $result = $stmt ->execute([$row['category_id']]);
                    if($result) {
                        $cat = $stmt->fetch();
                        $cat_name = $cat['name'];
                        $cat_hand = $cat['category_handle'];
                     }
                    else {
                        $cat_name = 'Категория не определена';
                    }
                //

                $grid[] = array(
                    'handle'         => $row['handle'], 
                    'sales'          => $sales_news_popular, 
                    'image'          => $image, 
                    'image_lnk'      => $row['image'],
                    //'id'             => $row["products_id"], 
                    'title'          => $row["title"], 
                    'description'    => $row['description'],
                    //'mark'           => $mark, 
                    'count'          => $row['count'], 
                    //'count_of_views' => $count_of_reviews, 
                    'old_price'      => $old_price, 
                    'price'          => ShopEngine::Help()->AsPrice($row["price"]), 
                    'price_int'      => round($row["price"]),
                    //'avail'          => $availability_vari, 
                    'brand'          => $row['brand'],
                    'category'       => $cat_name,
                    'categ_lnk'      => $cat_hand
                    );

                $total_votes        = 0;
                $old_price          = NULL;
                $sales_news_popular = NULL;
                
            }
         
            return $grid;
        }
        
    }
}