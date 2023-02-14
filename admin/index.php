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

  else if (isset($_POST["create"]) || isset($_POST["edit"]) || isset($_POST["delete"])) {
    $table = $_POST["create"] ?? $_POST["edit"] ?? $_POST["delete"];
    if (in_array($table, $tables)) {
      $data = $_POST;
      $id = $db->escape($data[$table."_id"] ?? null);

      unset($data[$table."_id"]);
      unset($data["create"]);
      unset($data["edit"]);
      unset($data["delete"]);

      if (isset($_POST["create"])) {
        $db->insert($table, $data);
      } else if (isset($_POST["edit"])) {
        $db->update($table, $id, $data);
      } else if (isset($_POST["delete"])) {
        $db->delete($table, $id);
      }

      if (isset($_POST["create"]) and $table == Tables::$PRODUCT) {
        $id = $db->get_last_id();
        // TODO: create product_type row
      }
      file_handler($id, $_FILES["image"] ?? null,
          isset($_POST["delete"]));
    }
  }

  header("Location: /$location");
}

function file_handler($id, $image, $mode) {
  if ($image == null and !$mode) return;

  $directory = $_SERVER["DOCUMENT_ROOT"]."/media";
  $file = "$directory/$id.";
  $default = "jpg";
  if (!is_dir($directory)) mkdir($directory);
  if (file_exists($file.$default)) unlink($file.$default);

  $size = $image["size"];
  $limit = 10 * (2 ** 20);
  if ($size < 0 or $size > $limit or $mode) return;

  $allowed = ["png", "jpg", "jpeg", "bmp", "gif"];
  $extension = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
  if (!in_array($extension, $allowed)) return;

  move_uploaded_file($image["tmp_name"], $file.$extension);
  if ($extension != $default) {
    $content = file_get_contents($file.$extension);
    $convert = imagecreatefromstring($content);
    imagejpeg($convert, $file.$default);
    imagedestroy($convert);
    unlink($file.$extension);
  }

  if (file_exists($extension)) unlink($extension);
}

if (isset($_SESSION["admin"])) {
  require "admin.php";
} else {
  require "login.php";
}
