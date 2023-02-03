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
            $title = $category["title"];
            echo "
            <input type='hidden' name='id' value='$id'>
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