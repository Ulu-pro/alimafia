<?php
$tabs = [
    "order" => "Orders",
    "category" => "Categories",
    "product" => "Products",
    "type" => "Types",
];
if (!isset($_COOKIE["tab"]) or !in_array($_COOKIE["tab"], array_keys($tabs))) {
  setcookie("tab", "order", strtotime("+1 year"));
  header("Location: /admin");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=992">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin - Ali Mafia</title>
  <link rel="stylesheet" href="/static/bootstrap.min.css">
</head>
<body data-bs-theme="dark">
<?php
require "components/create.php";
require "components/edit.php";
require "components/delete.php";
?>
<div class="modal fade" id="logOutModal" tabindex="-1" aria-labelledby="logOutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="logOutLabel">Log out</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to log out?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="/admin" method="post">
          <button type="submit" name="logout" class="btn btn-primary">Log out</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container mt-2">
  <div class="row">
    <div class="col-12">
      <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">
          <a class="navbar-brand">Ali Mafia</a>
          <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarText">
            <ul class="nav nav-pills">
              <?php
              foreach ($tabs as $key => $value) {
                $attribute = $_COOKIE["tab"] == $key ? "active" : "";
                echo "
                <li class='nav-item'>
                  <a class='btn nav-link $attribute' onclick='document.cookie=`tab=$key`;location.reload()'>$value</a>
                </li>
                ";
              }
              ?>
            </ul>
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#logOutModal">Log out</button>
          </div>
        </div>
      </nav>
      <?php require sprintf("tabs/%s.php", $_COOKIE["tab"]); ?>
  </div>
</div>
<script src="/static/bootstrap.bundle.min.js"></script>
<script src="/static/modal.data.js"></script>
</body>
</html>