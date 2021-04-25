<?php 
namespace App\classes;

use App\classes\Base;

class App{

const DB_NAME = "atelier";
const DB_USER = "root";
const DB_PASS = "";

    static $db = null;

    static function getDatabase(){
        if(!self::$db){
            self::$db = new Base(self::DB_USER, self::DB_PASS, self::DB_NAME);
        }
        return self::$db;
    }

}
