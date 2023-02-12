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
    if (in_array($_POST["create"] ?? $_POST["edit"] ?? $_POST["delete"], $tables)) {
      $data = $_POST;
      $id = $db->escape($data["id"] ?? null);
      unset($data["id"]);
      unset($data["create"]);
      unset($data["edit"]);
      unset($data["delete"]);
      $mode = false;
      if (isset($_POST["create"])) {
        $db->insert($_POST["create"], $data);
      } else if (isset($_POST["edit"])) {
        $db->update($_POST["edit"], $id, $data);
      } else if (isset($_POST["delete"])) {
        $db->delete($_POST["delete"], $id);
        $mode = true;
      }
      if (isset($_FILES["image"]) and $_FILES["image"]["error"] == false) {
        file_handler($id, $_FILES["image"], $mode);
      }
    }
  }

  header("Location: /$location");
}

function file_handler($id, $image, $mode) {
  $size = $image["size"];
  $limit = 10 * (2 ** 20);
  $temporary = $image["tmp_name"];
  $allowed = ["png", "jpg", "jpeg", "bmp", "gif"];
  $default = "jpg";
  $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
  $directory = $_SERVER["DOCUMENT_ROOT"]."/media";
  $file = "$directory/$id.";
  $path = $file.in_array($extension, $allowed) ? $extension : $default;

  if (!is_dir($directory)) mkdir($directory);
  if (file_exists($file.$default)) unlink($file.$default);
  if ($size < 0 or $size > $limit or $mode) return;

  move_uploaded_file($temporary, $path);
  $content = file_get_contents($path);
  $convert = imagecreatefromstring($content);
  imagejpeg($convert, $file.$default);
  imagedestroy($convert);

  if (file_exists($extension)) unlink($extension);
}

if (isset($_SESSION["admin"])) {
  require "admin.php";
} else {
  require "login.php";
}
