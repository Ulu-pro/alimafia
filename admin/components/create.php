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
            <input type="text" name="category_title" class="form-control bg-dark" id="floatingCreateCategoryTitle" placeholder="Title">
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
      <form action="/admin" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="input-group input-group-lg mb-3">
            <input type="file" accept="image/*" name="image" class="form-control bg-dark">
          </div>
          <select name="category_id" class="form-select form-select-lg bg-dark" title="Category of Product">
            <option selected>Select category...</option>
            <?php
            $db->select(Tables::$CATEGORY, function ($category) {
              [$id, $title] = parse_object(Tables::$CATEGORY, $category);
              echo "<option value='$id'>$title</option>";
            });
            ?>
          </select>
          <div class="form-floating mt-3">
            <input type="text" name="product_name" class="form-control bg-dark" id="floatingCreateProductName" placeholder="Name">
            <label for="floatingCreateProductName">Name</label>
          </div>
          <div class="input-group mt-3">
            <div class="form-floating">
              <input type="number" name="product_discount" class="form-control bg-dark" id="floatingCreateProductDiscount" placeholder="Discount" min="0" max="100" value="0">
              <label for="floatingCreateProductDiscount">Discount</label>
            </div>
            <span class="input-group-text">%</span>
          </div>
          <div class="form-floating mt-3">
            <textarea class="form-control bg-dark" name="product_description" placeholder="Description" id="floatingCreateProductDescription" style="height: 100px"></textarea>
            <label for="floatingCreateProductDescription">Description</label>
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
<div class="modal fade" id="createTypeModal" tabindex="-1" aria-labelledby="createTypeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createTypeLabel">Create a new Product Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <select name="product_id" class="form-select form-select-lg bg-dark" title="Product for Type">
            <option selected>Select product...</option>
            <?php
            $db->select(Tables::$CATEGORY, function ($category) use ($db) {
              [$id, $category_title] = parse_object(Tables::$CATEGORY, $category);
              echo "<optgroup label='$category_title:'>";
              $db->select(Tables::$PRODUCT, function ($product) use ($id) {
                [$product_id, $category_id, $product_name] = parse_object(Tables::$PRODUCT, $product);
                echo $category_id == $id ? "<option value='$product_id'>$product_name</option>" : "";
              });
              echo "</optgroup>";
            });
            ?>
          </select>
          <div class="form-floating mt-3">
            <input type="text" name="product_type_name" class="form-control bg-dark" id="floatingCreateTypeName" placeholder="Type">
            <label for="floatingCreateTypeName">Type</label>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">$</span>
            <div class="form-floating">
              <input type="number" name="product_type_price" class="form-control bg-dark" id="floatingCreateTypePrice" placeholder="Price">
              <label for="floatingCreateTypePrice">Price</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="create" value="product_type" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>