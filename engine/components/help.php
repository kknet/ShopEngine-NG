<?php

class Help 
{ 
    public function GenerateToken()
    {
        if(!isset($_SESSION['token'])) {
            $_SESSION['token'] = sha1(uniqid(rand(), true));
        }
        return $_SESSION['token'];
    }
    
    public function ValidateToken($token) 
    {
        if(isset($_SESSION['token']) AND $_SESSION['token']  === $token) {
            return true;
        }
        return false;
    }
    
    public function GenerateCheckoutToken()
    {
        if(!isset($_SESSION['checkout_token'])) {
            $_SESSION['checkout_token'] = sha1(uniqid(rand(), true));
        }
        return $_SESSION['checkout_token'];
    }
    
    public function ValidateCheckoutToken($token) 
    {
        if($_SESSION['checkout_token'] === $token) {
            return true;
        }
    }
    
    public function Clear($str)
    {
        // Simple and insecure
        return htmlspecialchars(strip_tags(trim($str)));
    }
    
    public function ImageResize($row, $oNwidth, $oNheight, $title, $e = "px", $class = "default_se_image")
    {
        if ($row != "" && file_exists($row) && !is_dir($row)) {
            $img_path = $row;
        }
        else {
            $img_path = "img/no_image.gif";
        }
            if($oNheight !== null AND $oNwidth !== null) { 
                $max_width = $oNwidth;
                $max_height = $oNheight;
                list($width, $height) = getimagesize($img_path);
                $ratioh = $max_height/$height;
                $ratiow = $max_width/$width;
                $ratio = min($ratioh, $ratiow);
                $width = intval($ratio*$width);
                $height = intval($ratio*$height);
            } else {
                $width  = "";
                $height = "";
                $e      = "";
            }
            $image = '<img src="/'.$img_path.'" class="'.$class.'" title="'.$title.'" width="'.$width.$e.'" height="'.$height.$e.'" alt="'.$title.'"/>';
            //$image = '<img src="/'.$img_path.'" title="'.$title.'" alt="'.$title.'"/>';
            return $image;
    }
    
    public function AsSimplePrice($num)
    {
        if(!$num) {
            return '0.00';
        }
        
        return number_format($num, 2, '.', ',');
    }
    
    public function AsPrice($num)
    {
        if(!$num) {
            return '0.00 р.';
        }
        
        return number_format($num, 2, '.', ',').' р.';
    }
    
    public function SendMail($from,$to,$subject,$body)
    {
        $charset  = 'utf-8';
        mb_language("ru");
        $headers  = "MIME-version: 1.0 \n";
        $headers .= "From: <".$from."> \n";
        $headers .= "Reply-To: <".$from."> \n";
        $headers .= "Content-Type: text/html; charset=$charset \n";

        $subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';

        mail($to,$subject,$body,$headers);
    }
    
    public function GeneratePassword()
    {
        $number = 11;

        $arr = array('a','b','c','d','e','f',

             'g','h','i','j','k','l',

             'm','n','o','p','r','s',

             't','u','v','x','y','z',

             '1','2','3','4','5','6',

             '7','8','9','0');

        $password = "";

        for($i = 0; $i < $number; $i++)
        {
            $index = rand(0, count($arr) - 1);
            $password .= $arr[$index];
        }

        return $password;
    }
    
    public function Count($sql, $params = NULL)
    {
        
        $db = database::getInstance();
        
        if($params === NULL)
        {
            $array = $db->query($sql)->fetchAll();
        }
        else 
        {
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $array = $stmt->fetchAll();
        }
        return count($array);
    }
    
    public function Sorting()
    {
        $uri = $this->Clear($_SERVER['REQUEST_URI']);
        $uri  = '/'.substr($uri, 1);

        if(array_key_exists("sort", $_GET)) { 
            $sorting = $this->Clear($_GET["sort"]);
        } 
        else {
            $sorting = null;
        }

        switch ($sorting) { 
            case 'price-asc';
            $sorting_db = 'price ASC';
            $sort_name = 'Цена: по возрастанию';
            $uri = substr($uri,0,-15);
            break;

            case 'price-desc';
            $sorting_db = 'price DESC';
            $sort_name = 'Цена: по убыванию';
            $uri = substr($uri,0,-16);
            break;

            case 'popular';
            $sorting_db = 'count DESC';
            $sort_name = 'Популярное';
            $uri = substr($uri,0,-13);
            break;

            case 'news';
            $sorting_db = 'datetime DESC';
            $sort_name = 'Новинки';
            $uri = substr($uri,0,-10);
            break;

            case 'brand';
            $sorting_db = 'brand';
            $sort_name = 'От А до Я';
            $uri = substr($uri,0,-11);
            break;

            default:
            $sorting_db = 'viewed DESC';
            $sort_name = 'Без сортировки';
            break;
        }
        return array('sorting_db' => $sorting_db, 'sort_name' => $sort_name, 'sorting' => $sorting, 'uri' => $uri);

    }
    
    public function GetPagination($main)
    {
        $sql    = ShopEngine::$sql;
        $params = ShopEngine::$params;
        $num    = ShopEngine::$num;
        
        if(!$sql)
        {
            return false;
        }
        
        $array = Paginator::PreparePagination($sql, $params, $num);
        $page = $array[2];
        $sorting = $array[0];
        $total = $array[3];
        $main_page = $main;
        
        require_once '../widgets/pagination.php';
    }
    
    function GetSorting() 
    {
    $main_page = ShopEngine::GetController()::GetPageAddress();

    if (ShopEngine::GetController() === 'Controller_Main') {
                //Действия со статическим URI. Тоже кастыль, но я придумаю что-нибудь
        if ($_GET["page"]) {
            $page = ShopEngine::Help()->Clear($_GET["page"]);
                echo '
                    <li><a href="'.$main_page.'?page='.$page.'&sort=price-asc">От дешевых к дорогим</a></li>
                    <li><a href="'.$main_page.'?page='.$page.'&sort=price-desc">От дорогих в дешевым</a></li>
                    <li><a href="'.$main_page.'?page='.$page.'&sort=popular">Популярное</a></li>
                    <li><a href="'.$main_page.'?page='.$page.'&sort=news">Новинки</a></li>
                    <li><a href="'.$main_page.'?page='.$page.'&sort=brand">От А до Я</a></li>
                ';
        }
        else 
        {
                echo '
                    <li><a href="'.$main_page.'?sort=price-asc">От дешевых к дорогим</a></li>
                    <li><a href="'.$main_page.'?sort=price-desc">От дорогих в дешевым</a></li>
                    <li><a href="'.$main_page.'?sort=popular">Популярное</a></li>
                    <li><a href="'.$main_page.'?sort=news">Новинки</a></li>
                    <li><a href="'.$main_page.'?sort=brand">От А до Я</a></li>
                ';
        }
    }

    else 
    {
        //Действия со динамическим URI. 
        if ($_GET["page"]) 
        {
            $page = ShopEngine::Help()->Clear($_GET["page"]);
                echo '
                    <li><a href="'.$main_page.'page='.$page.'&sort=price-asc">От дешевых к дорогим</a></li>
                    <li><a href="'.$main_page.'page='.$page.'&sort=price-desc">От дорогих в дешевым</a></li>
                    <li><a href="'.$main_page.'page='.$page.'&sort=popular">Популярное</a></li>
                    <li><a href="'.$main_page.'page='.$page.'&sort=news">Новинки</a></li>
                    <li><a href="'.$main_page.'page='.$page.'&sort=brand">От А до Я</a></li>
                ';
        }
        else 
        {
            echo '
                <li><a href="'.$main_page.'sort=price-asc">От дешевых к дорогим</a></li>
                <li><a href="'.$main_page.'sort=price-desc">От дорогих в дешевым</a></li>
                <li><a href="'.$main_page.'sort=popular">Популярное</a></li>
                <li><a href="'.$main_page.'sort=news">Новинки</a></li>
                <li><a href="'.$main_page.'sort=brand">От А до Я</a></li>
            ';
        }
    }
    }

    public function UpdateCount() {
        if(!Request::GetSession('viewed')) 
        {
            $db = database::getInstance();
            $db->query("UPDATE info SET val_int = val_int + 1 WHERE name='views'");
            Request::SetSession('viewed', true);
        }										
    }
    
    public function StrongRedirect($controller, $action)
    {
        $route = ShopEngine::GetRoute();
        if(($route[1] !== $controller OR ShopEngine::GetAction() !== $action) AND empty($route[3]))
        {
            header( "Location: /$controller/$action", true, 301 );
        }
    }
    
    public function HomeRedirect()
    {
        header( "Location: ".ShopEngine::GetHost(), true, 301 );
    }
    
    public function RegularRedirect($controller, $action)
    {
        header( "Location: /$controller/$action", true, 301 );
    }
    
    public function Refresh()
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("location: $actual_link", true, 301);
    }
    
    public function IndexRedirect()
    {
        $route = ShopEngine::GetRoute();
        if($route[1] === 'collections') {
            if($route[2] === 'people' AND $route[3] === 'products' AND $route[4] !== '') {
                header( "Location: /products/$route[4]", true, 301 );
            } elseif($route[2] === 'children' OR $route[2] === 'dentist') {
                header( "Location: /section/$route[2]", true, 301 );
            } elseif($route[2] === 'people') {
                header( "Location: /catalog/all", true, 301 );
            }
            else {
                Route::ErrorPage404();
            }
        }
    }
    
    public function ImportCSV($file)
    {
        $db = database::getInstance();
        $f = fopen($file, "rt") or dir("Ошибка импорта");
        
        for($i = 0; $data = fgetcsv($f, 0, ','); $i++) {
         
            try {
               // Отбрасываем первую строку
            if($i === 0) continue;
            //
            
            // Приведение некоторых типов
            $brand_lat = ShopEngine::Help()->rus2lat($data[3]);
            $data[6]   = $data[6] === 'true' ? 1 : 0;
            $data[20]  = $data[20] === "" ? 0.00 : $data[20];
            $data[19]  = $data[19] === "" ? 0.00 : $data[19];
            $data[16]  = $data[16] === '' ? NULL : $data[16];
            $data[17]  = $data[17] === 'continue' ? 1 : 0;
            //
            
            $cat_name = $data[4];
            if($cat_name) {
                $sql = "SELECT category_id FROM category WHERE name=?";
                $cat_id = Getter::GetFreeData($sql, [$cat_name])['category_id'];
                if($cat_id === NULL) {
                    //Вручную
                        $stmt = $db->prepare("INSERT INTO category (category_id, name) VALUES (NULL, :name)");
                        $stmt->bindParam(":name", $cat_name);
                        $stmt->execute();
                        $cat_id = $db->lastInsertId();
                    //
                }
            }
            
            $sql = "INSERT INTO products("
                    . "handle, "
                    . "title, "
                    . "description, "
                    . "brand, "
                    . "brand_lat,"
                    . "category_id,"
                    . "avail, "
                    . "price,"
                    . "count,"
                    . "pre,"
                    . "old_price) VALUES("
                    . ":handle, "
                    . ":title, "
                    . ":desc, "
                    . ":brand,"
                    . ":brand_lat, "
                    . ":category_id,"
                    . ":avail, "
                    . ":price,"
                    . ":count,"
                    . ":pre,"
                    . ":old"
                    . ")";
            
            $stmt = $db->prepare($sql);
            
            $stmt ->bindParam(':handle', $data[0]);
            $stmt ->bindParam(':title',  $data[1]);
            $stmt ->bindParam(':desc',   $data[2]);
            $stmt ->bindParam(':brand',  $data[3]);
            $stmt ->bindParam(':brand_lat', $brand_lat);
            $stmt ->bindParam(':category_id',  $cat_id);
//            $stmt ->bindParam(':image',  $path, PDO::PARAM_STR);
            $stmt ->bindParam(':avail',  $data[6]);
            $stmt ->bindParam(':old',  $data[20]);
            $stmt ->bindParam(':price',  $data[19]);
            $stmt ->bindParam(':count',  $data[16]);
            $stmt ->bindParam(':pre',  $data[17]);
            
            $stmt->execute();
            
            $id = $db->lastInsertId();
            
            // Парсинг изображения товара
            $url = $data[24];
            if($url) {
                
                $start = strrpos($url, '/');
                $end = strpos($url, '?');
                if($end)
                {
                    $filename = $id.rand(0, 777).'_'.substr($url, $start + 1, ($end - $start) - 1);
                }
                else {
                    $filename = $id.rand(0, 777).'_'.substr($url, $start);
                }
                
                if(file_exists('products_img/'.$brand_lat)) {
                    $path = 'products_img/'.$brand_lat.'/';
                }
                else {
                    mkdir('products_img/'.$brand_lat.'/');
                    $path = 'products_img/'.$brand_lat.'/';
                }
                if(!$brand_lat) {
                    if(file_exists('products_img/Uncategorized/')) {
                        $path = 'products_img/Uncategorized/';
                    }
                    else {
                        mkdir('products_img/Uncategorized/');
                        $path = 'products_img/Uncategorized/';
                    }
                }
                
                //$filename = $data[0].rand(0, 100).'.jpg';
                $path = $path.$filename;
                // Не совсем верное решение
                $image = file_get_contents($url);
                if($image === false) {
                    $d = 2;
                    while($image === false) {
                        $text = "( ".date('Y-m-d H:i:s (T)')." ) Не удалось загрузить изображение на итерации ".$i.", id записи: ".$id.". Полное имя в системе: ".$path.", ссылка на изображение ".$url.". Выполняется попытка ".$d."...\r\n";
                        $err = fopen('engine/errlog.txt', 'a');
                        fwrite($err, $text);
                        fclose($err);
                        $d++;
                        $image = file_get_contents($url);
                    }
                }
                $result = file_put_contents($path, $image);
            }
            else {
                $filename = '';
            }
            //
            
            $stmt = $db->prepare("UPDATE products SET image=:image WHERE products_id=:id");
            $stmt->bindParam(":image", $path);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
             
                
            } catch (Exception $ex) {
                
                $text = "( ".date('Y-m-d H:i:s (T)')." ) Выброшено исключение: ".$ex->getMessage()." на итерации ".$i.", id записи: ".$id."\r\n";
                $err = fopen('engine/errlog.txt', 'a');
                fwrite($err, $text);
                fclose($err);
                continue;

            }
            
        
        }
        
        fclose($f);
        return true;
    }
    
    public function SendMaill($mailto, $mailfrom, $subject, $body, $data = null)
    {
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "info@poterpite.ru";
        $mail->Password = "Service00990099";
        $mail->SetFrom($mailfrom, 'Потерпите, пожалуйста!');
        $mail->Subject = $subject;
        $mail->Body = $body;
        if($data) { 
        foreach ($data as $cur)
            {
                $mail->AddEmbeddedImage($cur['image'], $cur['handle']);
            }
        }
        $mail->AddAddress($mailto);
        //$mail->addReplyTo(Config::$config['developer_email'], $subject.' (replied)');

        if(!$mail->Send()) {
            ShopEngine::ExceptionToFile($mail->ErrorInfo);
        } else {
           return true;
        }
        
    }
    
    public function MakeYML()
    {
        require_once ENGINE.'components/ymlgenerator.php';
        
        $yandex = new YandexYML;
        $text   = $yandex->generateYML();
        $file   = fopen('engine/text.yml', 'a');
        
        fwrite($file, $text);
        fclose($file);
    }
    
    public function MakeHandle($str)
    {
        $new_str = ShopEngine::Help()->rus2lat($str);
        $new_str = str_replace(' ', '-', trim($new_str));
        $new_str = str_replace('\'', '', $new_str);
        return strtolower($new_str);
    }
    
    public function rus2lat($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
    
    public function ReplaceASCII($str)
    {   
        //
        return htmlspecialchars($str);
    }
    
    public function ValidateUser()
    {
        $id = Request::GetSession('user_id');
        $sql  = "SELECT * FROM users WHERE users_id=?";
        $user = Getter::GetFreeData($sql, [$id]);
        
        if($user['users_session_token'] !== Request::GetSession('user_token'))
        {
            return false;
        }
        
        return true;
    }
    
    public function createPDF()
    {
        include_once ROOT.'plugins/pdf/index.php';
    }
    
    //From Habrahabr
    public function ForcedDownload($file)
    {
        if(!file_exists($file))
        {
            return false;
        }
        
        if (ob_get_level()) {
            ob_end_clean();
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        
        readfile($file);
        exit;
    }
    
    public function CutString($str, $count) {
        mb_internal_encoding('UTF-8');
        
        if(strlen($str) >= $count) {
            return mb_substr($str, 0, $count).'...';
        }
        
        return $str;
    }
   
}
