<?php if (!isset($db)) exit; ?>
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCategoryLabel">Edit Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <?php
        if (isset($_GET["edit_category"])) {
          $id = $db->escape($_GET["edit_category"]);
          $category = $db->find(Tables::$CATEGORY, $id);
          [, $title] = parse_object(Tables::$CATEGORY, $category);
          echo "
          <input type='hidden' name='category_id' value='$id'>
          <div class='modal-body'>
            <div class='form-floating'>
              <input type='text' name='category_title' value='$title' class='form-control bg-dark' id='floatingEditCategoryTitle' placeholder='Title'>
              <label for='floatingEditCategoryTitle'>Title</label>
            </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='edit' value='category' class='btn btn-primary'>Edit</button>
          </div>
          ";
        }
        ?>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editProductLabel">Edit Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET["edit_product"])) {
          $id = $db->escape($_GET["edit_product"]);
          $product = $db->find(Tables::$PRODUCT, $id);
          [, $category_id, $name, $discount, $description] =
              parse_object(Tables::$PRODUCT, $product);
          echo "
          <div class='modal-body'>
            <input type='hidden' name='product_id' value='$id'>
            <div class='input-group input-group-lg mb-3'>
              <input type='file' accept='image/*' name='image' class='form-control bg-dark'>
            </div>
            <select name='category_id' class='form-select form-select-lg bg-dark' title='Category of Product'>";
          $db->select(Tables::$CATEGORY, function ($category) use ($category_id) {
            [$id, $title] = parse_object(Tables::$CATEGORY, $category);
            $attribute = $category_id == $id ? "selected" : "";
            echo "<option value='$id' $attribute>$title</option>";
          });
          echo "</select>
            <div class='form-floating mt-3'>
              <input type='text' name='product_name' value='$name' class='form-control bg-dark' id='floatingEditProductName' placeholder='Name'>
              <label for='floatingEditProductName'>Name</label>
            </div>
            <div class='input-group mt-3'>
              <div class='form-floating'>
                <input type='number' name='product_discount' value='$discount' class='form-control bg-dark' id='floatingEditProductDiscount' placeholder='Discount' min='0' max='100'>
                <label for='floatingEditProductDiscount'>Discount</label>
              </div>
              <span class='input-group-text'>%</span>
            </div>
            <div class='form-floating mt-3'>
              <textarea class='form-control bg-dark' name='product_description' placeholder='Description' id='floatingEditProductDescription' style='height: 100px'>$description</textarea>
              <label for='floatingEditProductDescription'>Description</label>
            </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='edit' value='product' class='btn btn-primary'>Edit</button>
          </div>
          ";
        }
        ?>
      </form>
    </div>
  </div>
</div>