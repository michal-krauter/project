<?php
/**
 * @file
 * DB class
 *
 * @author Michal Krauter <michal.krauter@seznam.cz>
 */

class Db {
  protected static $connection;

  /**
   * Connect to the database
   * 
   * @return bool|mysqli
   */
  public function connect(){    
    if(!isset(self::$connection)){ 
      self::$connection = new mysqli(_DB_SERVER_,_DB_USER_,_DB_PASSWD_,_DB_NAME_);
    } 
    if(self::$connection === false){
      return false;
    }
    return self::$connection;
  }

  /**
   * Query the database
   *
   * @param string $query
   * @return mixed result of query
   */
  public function query($query){
    $connection = $this -> connect();
    $result = $connection -> query($query);
    return $result;
  }

  /**
   * Fetch rows from the database on SELECT query
   *
   * @param string $query
   * @return bool|array
   */
  public function select($query){
    $rows = array();
    $result = $this -> query($query);
    if($result === false){
      return false;
    }
    while ($row = $result -> fetch_assoc()){
      $rows[] = $row;
    }
    return $rows;
  }

  /**
   * Quote and escape value for use in a database query
   *
   * @param string $value 
   * @return string
   */
  public function quote($value) {
    $connection = $this -> connect();
    return "'" . $connection -> real_escape_string($value) . "'";
  }

  /**
   *  get last database error
   * 
   * @return string
   */
  public function error() {
    $connection = $this -> connect();
    return $connection -> error;
  }
}