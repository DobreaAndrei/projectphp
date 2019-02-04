<?php
namespace Framework;
use \PDO;

class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=updateproject', 'root', '', $pdo_options);
      }
      return self::$instance;
    }
  }
?>