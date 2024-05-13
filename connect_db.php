<?php
 class Database{
  private static $dbName = "humid";
  private static $dbHost = "localhost";
  private static $dbUsername = "root";
  private static $dbUserPassword = '';

  private static $cont = null;

  public function __construct(){
    die('Init function is not allowed');
  }
  public static function connect(){
    if (null == self::$cont){
        try{
            self::$cont = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,self::$dbUsername,self::$dbUserPassword);
        }
        catch(PDOExecotion $e){
            die($e->getMessag());
        }
    }
    return self::$cont;
  }
  public static function disconnect(){
    self::$cont = null;
  }
 }


?>