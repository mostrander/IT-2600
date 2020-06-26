<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/

// Sample data
// 1 is guitars category
$cat_id = 1;

// Get the products
$products = get_products_by_category($cat_id);


/***************************************
 * Delete a product
 ****************************************/

// Sample data
$product_name = 'Fender Telecaster';

//delete a selected product from list
$delete_product = get_product_by_name($product_name);
if($delete_product)
{
    $product_id = $delete_product['productID'];
    $deleted = delete_product($product_id);
    if($deleted > 0)
    {
        // Product was deleted
        $delete_message = "$deleted row was deleted.";
    }
    else
    {
        // Delete the product and display an appropriate messge
        $delete_message = "No rows were deleted.";
    }
}
else
{
    // Delete the product and display an appropriate messge
        $delete_message = "There is no product with that name.";
}



/***************************************
 * Insert a product
 ****************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';
$discount_percent = 0;

// Insert the data
$product = add_product($category_id, $code, $name, $description, $price, $discount_percent);

// Display an appropriate message
if($product > 0)
{
    $insert_message = "1 product successfully added with ID: $product";
}
else
{
    $insert_message = "No rows were inserted.";
}


include 'home.php';
?>