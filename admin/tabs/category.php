<?php if (!isset($db)) exit; ?>
<a id="edit_category_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#editCategoryModal"></a>
<a id="delete_category_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"></a>
<table class="table table-dark table-hover">
  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createCategoryModal">+</button>
    </th>
  </tr>
  </thead>
  <tbody>
  <?php
  $db->select(Tables::CATEGORY, function ($category) {
    [$id, $title] = parse_object(Tables::CATEGORY, $category);
    echo "
    <tr class='align-middle'>
      <th scope='row'>$id</th>
      <td>$title</td>
      <td>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='edit_category' class='modal-data btn btn-outline-info border border-dark p-2' src='/static/images/edit.svg' alt='Edit'>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='delete_category' class='modal-data btn btn-outline-danger border border-dark p-2' src='/static/images/delete.svg' alt='Delete'>
      </td>
    </tr>
    ";
  });
  ?>
  </tbody>
</table>