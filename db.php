<?php
class DB {
  private $db;

  public function __construct() {
    $this->db = new mysqli("127.0.0.1", "root", "root", "ali" . "mafia");
  }

  public function escape($query): string {
    return $this->db->real_escape_string($query);
  }

  public function find($table, $row_id) {
    return $this->db->query("SELECT * FROM $table WHERE id = $row_id")->fetch_assoc();
  }

  public function select($table, $callback) {
    $result = $this->db->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
      $callback($row);
    }
  }

  public function insert($table, $options) {
    $keys = [];
    $values = [];
    foreach ($options as $key => $value) {
      $keys[] = $this->escape($key);
      $values[] = $this->escape($value);
    }
    $data = [];
    foreach ($values as $value) {
      $data[] = is_numeric($value) ? $value : "'$value'";
    }
    $keys = implode(",", $keys);
    $data = implode(",", $data);
    $this->db->query("INSERT INTO $table ($keys) VALUES ($data)");
  }
}

class Tables {
  public static $CATEGORIES = "categories";
}

$db = new DB();
