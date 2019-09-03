<?php

require_once "config.php";
/**
* Файл для подключения к БД 
*/

class DB extends PDO {
	private static $connect = null;
	
	private function __construct() {}
	private function __clone () {}
	// private function __wakeup () {} - Синглтон не работает без магического метотода Wakeup!

	public static function getConnect() {
        if (self::$connect === null) {
            self::$connect = new PDO(DRIVER.':host='.HOST.';dbname='.DATABASE, USER, PASS);
        }
        
        return self::$connect;
        
	}
    
}
/**
* Проверка на единственный Singleton объект
$db = DB::getConnect();
$db2 = DB::getConnect();
var_dump($db == $db2);
*/

/*
echo "<br>";
$sql = "SELECT * FROM `reviews`";
$stmt = DB::getConnect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($stmt as $row)
{
    echo $row['name'] . "\n";
}
*/