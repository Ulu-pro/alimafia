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
          $title = $category["title"];
          echo "
          <input type='hidden' name='id' value='$id'>
          <div class='modal-body'>
            <div class='form-floating'>
              <input type='text' name='title' value=\"$title\" class='form-control bg-dark' id='floatingEditCategoryTitle' placeholder='Title'>
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