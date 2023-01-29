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
    $result = $this->db->query("SELECT * FROM $table WHERE id = $row_id")->fetch_assoc();
    foreach($result as $key => $value) {
      $result[$key] = htmlspecialchars($value);
    }
    return $result;
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
      $point = $this->escape($value);
      $keys[] = $this->escape($key);
      $values[] = is_numeric($point) ? $point : "'$point'";
    }
    $keys = implode(",", $keys);
    $values = implode(",", $values);
    $this->db->query("INSERT INTO $table ($keys) VALUES ($values)");
  }

  public function update($table, $row_id, $options) {
    $data = [];
    foreach ($options as $key => $value) {
      $point = $this->escape($value);
      $data[] = $this->escape($key) . "=" . (is_numeric($point) ? $point : "'$point'");
    }
    $data = implode(",", $data);
    $this->db->query("UPDATE $table SET $data WHERE id = $row_id");
  }

  public function delete($table, $row_id) {
    $this->db->query("DELETE FROM $table WHERE id = $row_id");
  }
}

class Tables {
  public static $CATEGORY = "category";
  public static $PRODUCT = "product";
}

$db = new DB();
