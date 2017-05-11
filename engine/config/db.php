<?php

/**
 * Подключение к базе данных
 */

class database {
    
    private static $_db = null;
    private static $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

        public static function getInstance()
        {
            if (self::$_db === null) {
                try { 
                    self::$_db = new \PDO("mysql:host=localhost;dbname=".Config::$db['database'].";charset=utf8", Config::$db['username'], Config::$db['password'], self::$opt);
                } catch(Exception $e) {
                    die('Connect Error (' . self::$_db->connect_errno . ') ' . self::$_db->connect_error);
                }
            }

            return self::$_db;
        }

        private function __construct(){ }
        private function __clone()    { }
        private function __wakeup()   { }
    
}
