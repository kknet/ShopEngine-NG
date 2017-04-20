<?php

class Controller_Errorpage extends Controller{
   
    public function type()
    {
        return 'act';
    }
    
    public function Checkout()
    {
        Controller::GetModel()->ErrorEmailer();
        return 'Произошла ошибка при оформлении заказа. Мы уже получили отчет об этом. Все ваши данные сохранены, попробуйте, пожалуйста, еще раз';
    }
    
    public function Site()
    {
        return 'Произошла ошибка на сайте. Мы уже получили отчет об этом. Все ваши данные сохранены, попробуйте, пожалуйста, еще раз';
    }

}
