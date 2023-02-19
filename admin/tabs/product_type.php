<?php if (!isset($db)) exit; ?>
<a id="edit_type_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#editTypeModal"></a>
<a id="delete_type_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#deleteTypeModal"></a>
<table class="table table-dark table-hover">
  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Category</th>
    <th scope="col">Product</th>
    <th scope="col">Name</th>
    <th scope="col">Price</th>
    <th scope="col">
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createTypeModal">+</button>
    </th>
  </tr>
  </thead>
  <tbody>
  <?php
  $db->select(Tables::PRODUCT_TYPE, function ($type) use ($db) {
    [$id, $product_id, $type_name, $price] =
        parse_object(Tables::PRODUCT_TYPE, $type);

    $product = $db->find(Tables::PRODUCT, $product_id);
    [, $category_id, $product_name, $discount] =
        parse_object(Tables::PRODUCT, $product);

    $category = $db->find(Tables::CATEGORY, $category_id);
    [, $category_title] =
        parse_object(Tables::CATEGORY, $category);

    $computed = $price * (1 - $discount / 100);
    $formatted = "<span class='fs-5 fw-bold'>$$computed</span>";
    $formatted .= $discount == 0 ? "" :
        "&nbsp;<span class='text-secondary'>$$price</span>".
        "&nbsp;<span class='text-success'>(-$discount%)</span>";

    echo "
    <tr class='align-middle'>
      <th scope='row'>$id</th>
      <td>$category_title</td>
      <td>$product_name</td>
      <td>$type_name</td>
      <td>$formatted</td>
      <td>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='edit_type' class='modal-data btn btn-outline-info border border-dark p-2' src='/static/images/edit.svg' alt='Edit'>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='delete_type' class='modal-data btn btn-outline-danger border border-dark p-2' src='/static/images/delete.svg' alt='Delete'>
      </td>
    </tr>
    ";
  });
  ?>
  </tbody>
</table>