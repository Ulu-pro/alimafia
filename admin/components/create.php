<?php if (!isset($db)) exit; ?>
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createCategoryLabel">Create a new Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <div class="form-floating">
            <input type="text" name="title" class="form-control bg-dark" id="floatingCreateCategoryTitle" placeholder="Title">
            <label for="floatingCreateCategoryTitle">Title</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="create" value="category" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createProductLabel">Create a new Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <select name="category_id" class="form-select form-select-lg bg-dark" title="Category of Product">
            <option selected>Select category...</option>
            <?php
            $db->select(Tables::$CATEGORY, function ($category) {
              $id = $category["id"];
              $title = $category["title"];
              echo "<option value='$id'>$title</option>";
            });
            ?>
          </select>
          <div class="form-floating mt-3">
            <input type="text" name="name" class="form-control bg-dark" id="floatingCreateProductName" placeholder="Name">
            <label for="floatingCreateProductName">Name</label>
          </div>
          <div class="input-group mt-3">
            <div class="form-floating">
              <input type="number" name="weight" class="form-control bg-dark" id="floatingCreateProductWeight" placeholder="Weight">
              <label for="floatingCreateProductWeight">Weight</label>
            </div>
            <span class="input-group-text">g</span>
          </div>
          <div class="form-floating mt-3">
            <textarea class="form-control bg-dark" name="description" placeholder="Description" id="floatingCreateProductDescription" style="height: 100px"></textarea>
            <label for="floatingCreateProductDescription">Description</label>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">$</span>
            <div class="form-floating">
              <input type="number" name="price" class="form-control bg-dark" id="floatingCreateProductPrice" placeholder="Price">
              <label for="floatingCreateProductPrice">Price</label>
            </div>
          </div>
          <div class="input-group mt-3">
            <div class="form-floating">
              <input type="number" name="discount" class="form-control bg-dark" id="floatingCreateProductDiscount" placeholder="Discount" min="0" max="100" value="0">
              <label for="floatingCreateProductDiscount">Discount</label>
            </div>
            <span class="input-group-text">%</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="create" value="product" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>