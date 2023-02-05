<?php
session_start();
require "../db.php";
if (!isset($db)) exit;
$tables = [
    Tables::$CATEGORY,
    Tables::$PRODUCT,
];

if (!empty($_POST)) {
  $location = "admin";

  if (isset($_POST["login"])) {
    if ($_POST["account"] == "admin" &&
        $_POST["password"] == "admin") {
      $_SESSION["admin"] = "";
    }
  }

  else if (isset($_POST["logout"])) {
    session_destroy();
    $location = "";
  }

  else if (isset($_POST["create"])) {
    if (in_array($_POST["create"], $tables)) {
      $data = $_POST;
      unset($data["create"]);
      $db->insert($_POST["create"], $data);
    }
  }

  else if (isset($_POST["edit"])) {
    if (in_array($_POST["edit"], $tables)) {
      $data = $_POST;
      $id = $db->escape($data["id"]);
      unset($data["id"]);
      unset($data["edit"]);
      $db->update($_POST["edit"], $id, $data);
    }
  }

  else if (isset($_POST["delete"])) {
    if (in_array($_POST["delete"], $tables)) {
      $id = $db->escape($_POST["id"]);
      $db->delete($_POST["delete"], $id);
    }
  }

  header("Location: /$location");
}

if (isset($_SESSION["admin"])) {
  require "admin.php";
} else {
  require "login.php";
}
