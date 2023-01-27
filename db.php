<?php
class DB {
  private $db;

  public function __construct() {
    $this->db = new mysqli("127.0.0.1", "root", "root", "ali" . "mafia");
  }

  public function select($table, $callback) {
    $result = $this->db->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
      $callback($row);
    }
  }
}

class Tables {
  public static $CATEGORIES = "categories";
}
