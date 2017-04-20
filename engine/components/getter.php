<?php

class Getter extends ShopEngine{
    
    public static function GetFreeData($sql, array $params = NULL, $type = true)
    {
        $db = database::getInstance();
        
        if($params)
        {
            $query  = $db->prepare($sql);
            $result = $query->execute($params);
            if($result) {
                $array = $query->fetchAll();
                if($type === true) {
                    if(count($array) === 1) {
                        return $array[0];
                    }
                    return $array;
                }
                else {
                    return $array;
                }   
            }
        }
        else {
            $query = $db->query($sql);
            if($query) {
                $array = $query->fetchAll();
                if($type === true) {
                    if(count($array) === 1) {
                        return $array[0];
                    }
                    return $array;
                }
                else {
                    return $array;
                } 
            }
        }
    }
    
    public static function GetFreeProducts($sql, $params = NULL)
    { 
        $db = database::getInstance();
        
        if($params)
        {
            try {
                $query = $db->prepare($sql);
                $result = $query->execute($params);
                include_once("engine/models/get_products.php");
                $array = Products::GetProducts($query);
                if(count($array) <= 1) {
                    return $array[0];
                }
                return $array;
            } catch(Exception $e) {
                ShopEngine::ExceptionToFile($e);
            }
        }
        else { 
            try {
            $query = $db->query($sql);
                include_once("engine/models/get_products.php");
                $array = Products::GetProducts($query);
                if(count($array) <= 1) {
                    return $array[0];
                }
                return $array;
            } catch(Exception $e) {
                ShopEngine::ExceptionToFile($e);
            }
        }
    }
   
    // Получить товары
    public static function GetProducts($sql, $params = NULL)
    { 
        Self::$sql    = $sql;
        Self::$params = $params;

        $db = database::getInstance();

        $array = Paginator::PreparePagination($sql, $params);
        $sorting_db = $array[4];
        $query_start_num = $array[1];

        // С параметрами или без них
        if($params !== NULL)
        {
            $query = $db->prepare($sql.' ORDER BY '.$sorting_db.$query_start_num);
            $query->execute($params);
        }
        else 
        {
            $query = $db->query($sql.' ORDER BY '.$sorting_db.$query_start_num);
        }

        $path = 'Последние добавленные товары';

        include_once("engine/models/get_products.php");

        return Products::GetProducts($query);

    }
    
    // Получить случайные товары по запросу
    public static function GetRandomData($sql, $count)
    {
        
        $db = database::getInstance();
        
        $second_argument = $count;
        $rows = array();
        
        $count_of_all = $db->query($sql)->fetchAll();

        if (count($count_of_all) > 0) 
        {
            $count_of_all = count($count_of_all);

            $num_of_count = $count_of_all;

            $count_array = array();
            for ($i=0; $i < $num_of_count; $i++) 
            {
                $count_array[$i] = $i;
            }

            $rand_keys = array_rand($count_array, $second_argument);
            for ($i=0;$i<=($second_argument-1);$i++) 
            {

                $random = $rand_keys[$i];

                if($second_argument > count($count_array)) 
                {
                    $second_argument = count($count_array);
                    $random_query = 'LIMIT '.$random.',1';
                }
                if (count($count_array) == 1) 
                {
                    $second_argument = count($count_array);
                    $random_query = "";
                }
                else 
                {
                    $random_query = 'LIMIT '.$random.',1';
                }

                $random_row = $db->query($sql.' '.$random_query)->fetch();
                if(count($random_row) > 0) 
                {

                    $image = ShopEngine::Help()->ImageResize($random_row["image"], 'products_img/'.$random_row["cat_id"], '80', '80', NULL);

                    if ($random_row['new'] == '1') 
                    {
                        $header = '<div class="side_header new">
                                        <p>Новинка</p>
                                    </div>';
                    }

                    if ($random_row['leader'] == '1') 
                    {
                        $header = '<div class="side_header hit">
                                        <p>Хит продаж</p>
                                    </div>';
                    }

                    if ($random_row['sale'] == '1') 
                    {
                        $header = '<div class="side_header best">
                                            <p>Распродажа</p>
                                    </div>';
                    }

                    $type_of_product = $random_row['cat_id'];

                    $cat = "SELECT * FROM category_middle_level WHERE middle_id=?";
                    $result = $db->prepare($cat);
                    if($result->execute([$type_of_product]))
                    {
                        $type_row = $result->fetch();
                    }

                    if(!empty($random_row["old_price"])) 
                    {
                        $old_price = ShopEngine::Help()->NumberRank($random_row["old_price"]).'&#8381;';
                    }

                    else 
                    {
                        $old_price = "";
                    }

                    $rows[] = array(
                        'header'    => $header, 
                        'title'     => $random_row["title"], 
                        'count'     => $count_of_all, 
                        'image'     => $image, 
                        'type'      => $type_row["middle_disp_name"], 
                        'old_price' => $old_price, 
                        'price'     => $random_row['price'], 
                        'id'        => $random_row["products_id"]
                    );
                }
            }
            return $rows;
        }
    }
}
