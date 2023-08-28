<?php
class DB2
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          // self::$instance = new PDO('mysql:host=localhost:3306;dbname=webtimkiemnguoi0', 'psuser', 'Comvis1005') ;
          self::$instance = new PDO('mysql:host=localhost:3306;dbname=personsearch', 'psUser', ')*StydjCdMxu3.2r');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}
?>