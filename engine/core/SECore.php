<?php 

/*
 * Этот файл - главное связующее звено между конструкцией Контроллер->Модель и пользователем. 
 * 
 */

/**
* Функции подключения левого сайдбара
*/

include 'engine/models/get_left_sidebar.php';

function GetLeftSidebar() {
    return LeftSidebar::GetLeftSidebar();
}

/**
* Функции подключения правого сайдбара
*/

include 'engine/models/get_right_sidebar.php';

function GetTheMenu() {
    RightSidebar::GetTheMenu();
}
function GetCategories() {
    RightSidebar::GetCategories();
}
function GetBrands() {
    RightSidebar::GetBrands();
}
function ValueFrom() {
    if ($_GET["from"]) {
        $from_value = clear_string($_GET["from"]);
    }
    else {
        $from_value = "";
    }
    echo $from_value;
}
function ValueTo() {
    if ($_GET["to"]) {
        $to_value = clear_string($_GET["to"]);
    }
    else {
        $to_value = "";
    }
    echo $to_value;
}

/**
* Функции подключения шапки и копирайт
*/

//include 'engine/models/get_the_header.php';


function GetMenu() {
    return Controller::GetMenu();
}
function GetMenuProducts() {
    return Controller::GetMenuProducts();
}
function LoginRegister() {
    HeaderInform::UserEntry();
}
function GetName() {
    echo HeaderInform::GetName();
}
function GetThePhone() {
    echo HeaderInform::GetThePhone();
}
function GetThePhoneTitle() {
    echo HeaderInform::GetThePhoneTitle();
}
function GetTheLogo() {
    echo HeaderInform::GetTheLogo();
}
function GetTheIcon() {
    echo HeaderInform::GetTheIcon();
}
function CountOfProducts() {
    echo HeaderInform::CountOfProducts();
}
function GetSeoKeywords() {
    echo HeaderInform::GetSeoKeywords();
}
function GetSeoDescription() {
    echo HeaderInform::GetSeoDescription();
}
function GetCopyTitle() {
    echo HeaderInform::GetCopyTitle();
}
function GetCopy() {
    echo HeaderInform::GetCopy();
}

/**
* Функции подключения слайдера 
*/

include 'engine/models/get_slider.php';

function GetSliderSettings() {
    $array = Slider::GetSliderSettings();
    return($array);
}
function GetSlider() {
    $array = Slider::GetSlider();
        foreach($array as $key){
        echo $key;
    }
}

/**
* Функции подключения футера
*/

include 'engine/models/get_footer.php';

function GetArticles() {
    Footer::GetArticles();
}

/**
* Функции вывода основного контента
*/


/*
 * 
$routes = explode('/', $_SERVER['REQUEST_URI']);

if(!empty($routes[1])) {
    $controller_name = 'Controller_'.clear_string($routes[1]);
}
else {
    $controller_name = 'Controller_'.'Main';
}
 
 */


/*
 * 
 * Здесь не помешало бы добавить универсальности
 */

//if ($routes[1] === '' OR $routes[1] === 'main' OR $routes[1] === 'eyestopper' OR $routes[1] === 'category' OR $routes[1] === 'filter' OR $routes[1] === 'search') {
//    //$products = $controller->GetProducts();
//}
//elseif ($routes[1] == 'product') {
//    $product = $controller->GetProductInfo();
//}
//elseif ($routes[1] == 'cart') { 
//    $cart = $controller->GetCart();
//}
//elseif ($routes[1] == 'checkout') { 
//    $checkout = $controller->GetCheck();
//}
//elseif ($routes[1] == 'order_page') {
//    $order = $controller->GetOrderInfo();
//}
//elseif ($routes[1] == 'article') {
//    $article = $controller->GetArticle();
//}

 
//else something

/* Функции для вывода товаров */
/*
 * 
 * GetData должен быть вызван раньше, чем GetPagination!
 */

function GetProducts() {
    $products = ShopEngine::GetController()::GetData();
    return $products;
}
function GetPagination() {
    return ShopEngine::GetController()::GetPagination();
}
function GetSortingName() {
    $array = ShopEngine::Help()->Sorting();
    return $array['sort_name'];
}
function GetPageName() {
    return ShopEngine::GetController()::PageName();
}


/* Функции вывода информации о товаре */

function GetProductInfoTitle(){
        echo $GLOBALS["product"]['row']['title'];
}
function GetProductInfoImage(){
        echo $GLOBALS["product"]['row']['image'];
}
function GetProductInfoMiniFeat(){
        echo $GLOBALS["product"]['row']['mini_features'];
}
function GetProductInfoMark(){
        echo $GLOBALS["product"]['row']['mark'];
}
function GetProductInfoCount(){
        echo $GLOBALS["product"]['row']['count'];
}
function GetProductInfoCountOfReviews(){
        echo $GLOBALS["product"]['row']['count_of_reviews'];
}
function GetProductInfoAvail(){
        echo $GLOBALS["product"]['row']['avail'];
}
function GetProductInfoId(){
        echo $GLOBALS["product"]['row']['id'];
}
function GetProductInfoDescription(){
        echo $GLOBALS["product"]['row']['description'];
}
function GetProductInfoFeatLeft(){
        echo $GLOBALS["product"]['row']['features_left'];
}
function GetProductInfoFeatRight(){
        echo $GLOBALS["product"]['row']['features_right'];
}
function GetProductInfoPrice(){
        echo $GLOBALS["product"]['row']['price'];
}
function GetProductInfoOldPrice(){
        echo $GLOBALS["product"]['row']['old_price'];
}
function GetProductInfoGallery() {
        foreach ($GLOBALS["product"]["images"] as $key) {
                echo '<li class="'.$key['class'].'">'.$key["image"].'</li>';
        }
}
function GetReviews() {
        return $GLOBALS["product"]["comments"];
}
function GetSimilar() {
        return $GLOBALS["product"]["similar"];
}
function GetHistory() {
        return $GLOBALS["product"]["history"];
}
/* Добавление отзыва */
function AddReview() {
        $GLOBALS["controller"]->AddReview();
}

/* Функции для вывода корзины */

function GetCart() {
        return $GLOBALS['cart']['cart_array'];
}
function GetCartSum() {
    return ShopEngine::GetController()::GetSum();
}
function GetCartCount() {
        echo $GLOBALS['cart']['count'];
}
function GetCartUniqueCount() {
        echo $GLOBALS['cart']['products'];
}

/* Функции для оформления заказа */

function GetSESSCheckoutEmail() {
        echo ($GLOBALS['checkout']['email']);
}
function GetSESSCheckoutSurname() {
        echo ($GLOBALS['checkout']['surname']);
}
function GetSESSCheckoutName() {
        echo ($GLOBALS['checkout']['name']);
}
function GetSESSCheckoutPatronymic() {
        echo ($GLOBALS['checkout']['patronymic']);
}
function GetSESSCheckoutPhone() {
        echo ($GLOBALS['checkout']['phone']);
}
function GetSESSCheckoutAddress() {
        echo ($GLOBALS['checkout']['address']);
}
function GetSESSCheckoutInfo() {
        echo ($GLOBALS['checkout']['info']);
}
function GetSESSCheckoutDel() {
        echo ($GLOBALS['checkout']['del']);
}
function GetSESSCheckoutPay() {
        echo ($GLOBALS['checkout']['pay']);
}
function GetSESSCheckoutFinal() {
        echo ($GLOBALS['checkout']['final']);
}

function GetCheckbox1() {
        echo ($GLOBALS['checkout']['checked1']);
}
function GetCheckbox2() {
        echo ($GLOBALS['checkout']['checked2']);
}
function GetCheckbox3() {
        echo ($GLOBALS['checkout']['checked3']);
}
function GetCheckbox4() {
        echo ($GLOBALS['checkout']['checked4']);
}
function GetCheckbox5() {
        echo ($GLOBALS['checkout']['checked5']);
}

function GetPaymentMethod() {
        $GLOBALS["controller"]->GetPaymentMethod();
}
function GetOrder() {
        $GLOBALS["controller"]->GetOrder();
}
function GetOrderStatus() {
        echo $GLOBALS['order']['buyer']['status'];
}
function GetOrderPayStatus() {
        echo $GLOBALS['order']['buyer']['pay_status'];
}
function GetOrderPayTime() {
        echo $GLOBALS['order']['buyer']['pay_time'];
}
function GetOrderName() {
        echo $GLOBALS['order']['buyer']['name'];
}
function GetOrderPhone() {
        echo $GLOBALS['order']['buyer']['phone'];
}
function GetOrderEmail() {
        echo $GLOBALS['order']['buyer']['email'];
}
function GetOrderAddress() {
        echo $GLOBALS['order']['buyer']['address'];
}
function GetOrderDel() {
        echo $GLOBALS['order']['buyer']['del'];
}
function GetOrderPay() {
        echo $GLOBALS['order']['buyer']['pay'];
}
function GetOrderSum() {
        echo $GLOBALS['order']['buyer']['sum'];
}
function GetOrderDatetime() {
        echo $GLOBALS['order']['buyer']['datetime'];
}
function GetOrderId() {
        echo $GLOBALS['order']['buyer']['id'];
}
function GetFinalProducts() {
   return ShopEngine::GetController()::GetOrderProducts(); 
}
function GetOrderProducts() {
    return ShopEngine::GetController()::GetData();
}
function GetCheckoutPrice() {
    $price = ShopEngine::GetController()::GetCheckoutPrice();
    return ShopEngine::Help()->AsPrice($price);
}
function GetPreFinalPrice() {
    $price = ShopEngine::GetController()::GetPreFinalPrice();
    return ShopEngine::Help()->AsPrice($price);
}
function GetFinalPrice() {
    $price = ShopEngine::GetController()::GetFinalPrice();
    return ShopEngine::Help()->AsPrice($price);
}

/* Функции для вывода информации о пользователе */

function GetProfileCount() {
        $GLOBALS['controller']->GetCount();
}

/* Функции для вывода истории заказов */

function GetOrderList() {
        $GLOBALS['controller']->GetOrderList();
}
function GetOrders() {
        $GLOBALS['controller']->GetOrders();
}

/* Функции для вывода истории комментариев */

function GetCommentsList() {
        $GLOBALS['controller']->GetCommentsList();
}
function GetComments() {
        $GLOBALS['controller']->GetComments();
}

/* Функции для вывода истории статей */

function GetArticleTitle() {
        echo $GLOBALS['article']['title'];
}
function GetArticleText() {
    return ShopEngine::GetController()::GetData();
}
