<?php
namespace App\core;
use PDO;
use PDOException;
/**
* PDO PHP Persistence Class
*/
class Connection {

  private static $connection;
  private $debug;
  private $server;
  private $port;
  private $user;
  private $password;
  private $database;

  public function __construct() {
    $this->debug = true;
    $this->server =  "localhost";
    $this->port = "443";
    $this->user =  "root";
    $this->password =  "";
    $this->database =  "search";
  }

  /**
  * Create a database connection or return the connection already open using Singletion Design Patern
  * @return PDOConnection|null
  */
  public function getConnection() {
    try {
      if (!isset(self::$connection)) {
        self::$connection = new PDO("mysql:host=$this->server;port=$this->port;dbname=$this->database;charset=utf8", $this->user, $this->password);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
      }
      return self::$connection;
    } catch (PDOException $ex) {
      if ($this->debug) {
        echo "<b>Error on getConnection(): </b>" . $ex->getMessage() . "<br/>";
      }
      die();
      return null;
    }
  }

  /**
  * Unset connection
  * @return void
  */
  public function Disconnect() {
    self::$connection = null;
  }

  /**
  * returns the result of a query (select) of only one row
  * @param string $sql the sql string
  * @param array $params the array of parameters (array(":col1" => "val1",":col2" => "val2"))
  * @return one position array for the result of query
  */
  public function ExecuteQueryOneRow($sql, $params = null) {
    try {
      $stmt = $this->getConnection()->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      if ($this->debug) {
        echo "<b>Error on ExecuteQueryOneRow():</b> " . $ex->getMessage() . "<br />";
        echo "<br /><b>SQL: </b>" . $sql . "<br />";

        echo "<br /><b>Parameters: </b>";
        print_r($params) . "<br />";
      }
      die();
      return null;
    }
  }

  /**
  * returns the result of a query (select)
  * @param string $sql the sql string
  * @param array $params the array of parameters (array(":col1" => "val1",":col2" => "val2"))
  * @return array for the result of query
  */
  public function ExecuteQuery($sql, $params = null) {
    try {
      $stmt = $this->getConnection()->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      if ($this->debug) {
        echo "<b>Error on ExecuteQuery():</b> " . $ex->getMessage() . "<br />";
        echo "<br /><b>SQL: </b>" . $sql . "<br />";

        echo "<br /><b>Parameters: </b>";
        print_r($params) . "<br />";
      }
      die();
      return null;
    }
  }

  /**
  * returns if the query was successful
  * @param string $sql the sql string
  * @param array $params the array of parameters (array(":col1" => "val1",":col2" => "val2"))
  * @return boolean
  */
  public function ExecuteNonQuery($sql, $params = null) {
    try {
      $stmt = $this->getConnection()->prepare($sql);
      return $stmt->execute($params);
    } catch (PDOException $ex) {
      if ($this->debug) {
        echo "<b>Error on ExecuteNonQuery():</b> " . $ex->getMessage() . "<br />";
        echo "<br /><b>SQL: </b>" . $sql . "<br />";

        echo "<br /><b>Parameters: </b>";
        print_r($params) . "<br />";
      }
      die();
      return false;
    }
  }

  /**
  * returns number of rows affected
  * @param string $sql the sql string
  * @param array $params the array of parameters (array(":col1" => "val1",":col2" => "val2"))
  * @return int
  */
  public function NumberRows($sql, $params = null) {
    try {
      $stmt = $this->getConnection()->prepare($sql);
      $stmt->execute($params);

      return $stmt->rowCount();

    } catch (PDOException $ex) {
      if ($this->debug) {
        echo "<b>Error on ExecuteNonQuery():</b> " . $ex->getMessage() . "<br />";
        echo "<br /><b>SQL: </b>" . $sql . "<br />";

        echo "<br /><b>Parameters: </b>";
      }
      die();
      return -1;
    }
  }

  public function GetDebugState(){
    return $this->debug;
  }

}