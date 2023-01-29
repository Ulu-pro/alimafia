<?php if (!isset($db)) exit; ?>
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
          <button type="submit" name="create" value="categories" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
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
          $category = $db->find(Tables::$CATEGORIES, $id);
          $title = $category["title"];
          echo "
          <input type='hidden' name='id' value='$id'>
          <div class='modal-body'>
            <div class='form-floating'>
              <input type='text' name='title' value='$title' class='form-control bg-dark' id='floatingEditCategoryTitle' placeholder='Title'>
              <label for='floatingEditCategoryTitle'>Title</label>
            </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='edit' value='categories' class='btn btn-primary'>Edit</button>
          </div>
          ";
        }
        ?>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteCategoryLabel">Delete Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin" method="post">
        <input type="hidden" name="id" value="" id="deleteCategoryRowID">
        <div class="modal-body">
          <p>Are you sure you want to delete this category?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="delete" value="categories" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>