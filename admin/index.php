<?php
session_start();
require "../db.php";
if (!isset($db)) exit;
$tables = [
    Tables::$CATEGORIES,
];

if (!empty($_POST)) {
  $location = "admin";
  if (isset($_POST["login"])) {
    if ($_POST["account"] == "admin" &&
        $_POST["password"] == "admin") {
      $_SESSION["admin"] = "";
    }
  } else if (isset($_POST["logout"])) {
    session_destroy();
    $location = "";
  } else if (isset($_POST["create"])) {
    if (in_array($_POST["create"], $tables)) {
      $data = $_POST;
      unset($data["create"]);
      $db->insert($_POST["create"], $data);
    }
  }
  header("Location: /$location");
}

if (isset($_SESSION["admin"])) {
  require "admin.php";
} else {
  require "login.php";
}
