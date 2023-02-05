<?php if (!isset($db)) exit; ?>
<a id="edit_product_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#editProductModal"></a>
<a id="delete_product_modal" class="d-none" data-bs-toggle="modal" data-bs-target="#deleteProductModal"></a>
<table class="table table-dark table-hover">
  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Image</th>
    <th scope="col">Category</th>
    <th scope="col">Name</th>
    <th scope="col">Weight</th>
    <th scope="col">Description</th>
    <th scope="col">Price</th>
    <th scope="col">Discount</th>
    <th scope="col">
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createProductModal">+</button>
    </th>
  </tr>
  </thead>
  <tbody>
  <?php
  $db->select(Tables::$PRODUCT, function ($product) use ($db) {
    [$id, $category_id, $name, $weight, $description, $price_original, $discount, $price_computed] =
        parse_object(Tables::$PRODUCT, $product);
    $category = $db->find(Tables::$CATEGORY, $category_id);
    [, $category_title] = parse_object(Tables::$CATEGORY, $category);
    $prices_formatted = "<span class='text-success'>$$price_computed</span>";
    $prices_formatted .= $discount == 0 ? "" : " (<span class='text-danger'>$$price_original</span>)";
    echo "
    <tr class='align-middle'>
      <th scope='row'>$id</th>
      <td></td>
      <td>$category_title</td>
      <td>$name</td>
      <td>$weight g</td>
      <td>
        <textarea class='form-control bg-dark' placeholder='Type Description...' rows='1'>$description</textarea>
      </td>
      <td>$prices_formatted</td>
      <td>$discount%</td>
      <td>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='edit_product' class='modal-data btn btn-outline-info border border-dark p-2' src='/static/images/edit.svg' alt='Edit'>
        <img type='button' width='42' data-row-id='$id' data-modal-flag='delete_product' class='modal-data btn btn-outline-danger border border-dark p-2' src='/static/images/delete.svg' alt='Delete'>
      </td>
    </tr>
    ";
  });
  ?>
  </tbody>
</table>