<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=992">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Log in - Ali Mafia</title>
  <link rel="stylesheet" href="/static/bootstrap.min.css">
</head>
<body data-bs-theme="dark">
<div class="container pt-5">
  <div class="row mt-5">
    <div class="col-4"></div>
    <div class="col-4 p-5 border border-2">
      <form action="/admin" method="post" class="p-3">
        <p class="fs-3 text-center">Admin panel</p>
        <div class="mb-3">
          <label for="accountField" class="form-label">Account</label>
          <input type="text" name="account" class="form-control bg-dark" id="accountField">
        </div>
        <div class="mb-4">
          <label for="passwordField" class="form-label">Password</label>
          <input type="password" name="password" class="form-control bg-dark" id="passwordField">
        </div>
        <div class="text-center">
          <button type="submit" name="login" class="btn btn-primary">Log in</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="/static/bootstrap.bundle.min.js"></script>
</body>
</html>