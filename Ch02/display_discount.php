
<?php 
    //Step 1 Use Post Method

    //$description = $_POST['product_description'];
    //$price = $_POST['list_price'];
    //$discount = $_POST['discount_percent'];

    //Step 2 Change to filter_input() method
    $description = filter_input(INPUT_POST, 'product_description');
    $price = filter_input(INPUT_POST, 'list_price');
    $discount = filter_input(INPUT_POST, 'discount_percent');

    //caculate discount & final price
    $discount_amount = $price * ($discount * .01);
    $discount_price = $price - $discount_amount;
    
    //format the different prices
    $price_f = '$'. number_format($price, 2);
    $discount_f = $discount .'%';
    $discount_amount_f = '$'. number_format($discount_amount, 2);
    $discount_price_f = '$'. number_format($discount_price, 2);
    
?>


<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($price_f); ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_f); ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_amount_f; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br>
    </main>
</body>
</html>