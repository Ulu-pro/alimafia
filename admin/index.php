<?php
session_start();

if (!empty($_POST)) {
  $location = "";
  if (isset($_POST["login"])) {
    if ($_POST["account"] == "admin" &&
        $_POST["password"] == "admin") {
      $_SESSION["admin"] = "";
      $location = "admin";
    }
  } else if (isset($_POST["logout"])) {
    session_destroy();
  }
  header("Location: /$location");
}

if (isset($_SESSION["admin"])) {
  require "admin.php";
} else {
  require "login.php";
}
