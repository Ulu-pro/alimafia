<?php
require "db.php";
$db = new DB();

$db->select(Tables::$CATEGORIES, function ($category) {
  $id = $category["id"];
  $title = $category["title"];
  echo "$id: $title<br>";
});
