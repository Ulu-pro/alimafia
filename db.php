<?php
class DB {
  private $db;

  public function __construct() {
    $this->db = new mysqli("127.0.0.1", "root", "root", "ali"."mafia");
  }

  public function escape($query): string {
    return $this->db->real_escape_string($query);
  }

  public function find($table, $row_id) {
    $result = $this->db->query("SELECT * FROM `$table` WHERE $table"."_id = $row_id")->fetch_assoc();
    foreach($result as $key => $value) {
      $result[$key] = htmlspecialchars($value);
    }
    return $result;
  }

  public function get_last_id() {
    return $this->db->insert_id;
  }

  public function select($table, $callback, $descending = false, $limit = 0, $offset = 0) {
    $query = "SELECT * FROM `$table` ORDER BY $table"."_id ";
    $query .= $descending ? "DESC" : "ASC";
    $query .= $limit ? " LIMIT $limit" : "";
    $query .= $offset ? " OFFSET $offset" : "";
    $result = $this->db->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $callback($row);
      }
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
    $this->db->query("INSERT INTO `$table` ($keys) VALUES ($values)");
  }

  public function update($table, $row_id, $options) {
    $data = [];
    foreach ($options as $key => $value) {
      $point = $this->escape($value);
      $data[] = $this->escape($key) . "=" . (is_numeric($point) ? $point : "'$point'");
    }
    $data = implode(",", $data);
    $this->db->query("UPDATE `$table` SET $data WHERE $table"."_id = $row_id");
  }

  public function delete($table, $row_id) {
    $this->db->query("DELETE FROM `$table` WHERE $table"."_id = $row_id");
  }
}

class Tables {
  const CATEGORY = "category";
  const PRODUCT = "product";
  const PRODUCT_TYPE = "product_type";
  const ORDER = "order";
  const ORDER_ITEM = "order_item";
  const ORDER_STATUS = "order_status";
  const USER = "user";
  const CART = "cart";
}

function parse_object($table, $object): array {
  switch ($table) {
    case Tables::CATEGORY:
      return [
          $object["category_id"],
          $object["category_title"],
      ];
    case Tables::PRODUCT:
      return [
          $object["product_id"],
          $object["category_id"],
          $object["product_name"],
          $object["product_discount"],
          $object["product_description"],
          "/media/".$object["product_id"].".jpg",
      ];
    case Tables::PRODUCT_TYPE:
      return [
          $object["product_type_id"],
          $object["product_id"],
          $object["product_type_name"],
          $object["product_type_price"],
      ];
    case Tables::ORDER:
      return [
          $object["order_id"],
          $object["user_id"],
          $object["order_status_id"],
          $object["order_date"],
      ];
    case Tables::ORDER_ITEM:
      return [
          $object["order_item_id"],
          $object["order_id"],
          $object["product_type_id"],
          $object["order_item_quantity"],
      ];
    case Tables::ORDER_STATUS:
      return [
          $object["order_status_id"],
          $object["order_status_color"],
          $object["order_status_comment"],
      ];
    case Tables::USER:
      return [
          $object["user_id"],
          $object["user_name"],
          $object["user_phone"],
          $object["user_address"],
          $object["user_password"],
      ];
    case Tables::CART:
      return [
          $object["cart_id"],
          $object["user_id"],
          $object["product_type_id"],
          $object["cart_quantity"],
      ];
    default:
      return [];
  }
}

$db = new DB();
