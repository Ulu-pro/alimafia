<?php
require "db.php";
if (!isset($db)) exit;

$db->select(Tables::$CATEGORY, function ($category) {
  [$id, $title] = parse_object(Tables::$CATEGORY, $category);
  echo "$id: $title<br>";
});
