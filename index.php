<?php
require "db.php";
if (!isset($db)) exit;

$db->select(Tables::$CATEGORIES, function ($category) {
  $id = $category["id"];
  $title = $category["title"];
  echo "$id: $title<br>";
});
