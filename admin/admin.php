<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Ali Mafia</a>
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders"
                      type="button" role="tab" aria-controls="pills-orders" aria-selected="true">Orders</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-categories-tab" data-bs-toggle="pill" data-bs-target="#pills-categories"
                      type="button" role="tab" aria-controls="pills-categories" aria-selected="false">Categories</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#pills-products"
                      type="button" role="tab" aria-controls="pills-products" aria-selected="false">Products</button>
            </li>
          </ul>
          <div class="d-flex">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#logOutModal">Log out</button>
          </div>
        </div>
      </nav>
      <div class="tab-content mt-3" id="pills-tabContent">
        <div class="tab-pane fade" id="pills-orders" role="tabpanel" aria-labelledby="pills-orders-tab" tabindex="0">
          <?php require "tabs/order.php"; ?>
        </div>
        <div class="tab-pane fade" id="pills-categories" role="tabpanel" aria-labelledby="pills-categories-tab" tabindex="0">
          <?php require "tabs/category.php"; ?>
        </div>
        <div class="tab-pane fade show active" id="pills-products" role="tabpanel" aria-labelledby="pills-products-tab" tabindex="0">
          <?php require "tabs/product.php"; ?>
        </div>
      </div>
  </div>
</div>
<script src="/static/bootstrap.bundle.min.js"></script>
<script src="/static/modal.data.js"></script>
</body>
</html>