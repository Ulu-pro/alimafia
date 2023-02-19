<?php if (!isset($db)) exit; ?>
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteCategoryLabel">Delete Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <?php
          if (isset($_GET["delete_category"])) {
            $id = $db->escape($_GET["delete_category"]);
            $category = $db->find(Tables::$CATEGORY, $id);
            [, $title] = parse_object(Tables::$CATEGORY, $category);
            echo "
            <input type='hidden' name='category_id' value='$id'>
            <p>Are you sure you want to delete category \"$title\"?</p>
            ";
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="delete" value="category" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteCategoryLabel">Delete Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <?php
          if (isset($_GET["delete_product"])) {
            $id = $db->escape($_GET["delete_product"]);
            $type = $db->find(Tables::$PRODUCT, $id);
            [, , $name] = parse_object(Tables::$PRODUCT, $type);
            echo "
            <input type='hidden' name='product_id' value='$id'>
            <p>Are you sure you want to delete product \"$name\"?</p>
            ";
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="delete" value="product" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteTypeModal" tabindex="-1" aria-labelledby="deleteTypeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteTypeLabel">Delete Product Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <div class="modal-body">
          <?php
          if (isset($_GET["delete_type"])) {
            $id = $db->escape($_GET["delete_type"]);
            $type = $db->find(Tables::$PRODUCT_TYPE, $id);
            [, $product_id, $type_name] = parse_object(Tables::$PRODUCT_TYPE, $type);
            $product = $db->find(Tables::$PRODUCT, $product_id);
            [, , $product_name] = parse_object(Tables::$PRODUCT, $product);
            echo "
            <input type='hidden' name='product_type_id' value='$id'>
            <p>Are you sure you want to delete product type \"$product_name: $type_name\"?</p>
            ";
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="delete" value="product_type" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>