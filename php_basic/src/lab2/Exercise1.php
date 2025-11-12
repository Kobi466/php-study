<?php
// Get data from form and sanitize it
$product_description = htmlspecialchars($_POST['product_description'] ?? '');
$list_price = (float)($_POST['list_price'] ?? 0);
$discount_percent = (float)($_POST['discount_percent'] ?? 0);

// Calculate discount
$discount = $list_price * $discount_percent * 0.01;
$discount_price = $list_price - $discount;

// Format numbers for display
$list_price_f = '$' . number_format($list_price, 2);
$discount_percent_f = $discount_percent . '%';
$discount_f = '$' . number_format($discount, 2);
$discount_price_f = '$' . number_format($discount_price, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Discount Calculator</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Product Discount Calculator</h1>

    <dl>
        <dt>Product Description:</dt>
        <dd><?php echo $product_description; ?></dd>

        <dt>List Price:</dt>
        <dd><?php echo $list_price_f; ?></dd>

        <dt>Standard Discount:</dt>
        <dd><?php echo $discount_percent_f; ?></dd>

        <dt>Discount Amount:</dt>
        <dd><?php echo $discount_f; ?></dd>

        <dt>Discount Price:</dt>
        <dd><?php echo $discount_price_f; ?></dd>
    </dl>

</body>
</html>
