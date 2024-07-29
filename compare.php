<?php
include 'db_connect.php';
include 'session.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve product IDs from session
$product_ids = isset($_SESSION['compare_list']) ? $_SESSION['compare_list'] : [];

// Fetch product details from the database
if (!empty($product_ids)) {
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $stmt = $conn->prepare("SELECT p.*, c.category FROM product p JOIN category c ON p.category_id = c.category_id WHERE p.product_id IN ($placeholders)");
    
    // Bind parameters
    $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
} else {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - Compare Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/compare.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Comparison</h1>
        <?php if (!empty($products)): ?>
            <div class="table-responsive">
                <table class="table table-bordered text-center compare-table">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Width</th>
                            <th>Origin</th>
                            <th>Warranty</th>
                            <th>Care Instruction</th>
                            <th>Packaging</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="compareTableBody">
                        <?php foreach ($products as $product): ?>
                        <tr data-product-id="<?php echo $product['product_id']; ?>" data-price="<?php echo $product['price']; ?>">
                            <td data-label=""><input type="checkbox" class="product-check"></td>
                            <td data-label="Image"><img src="<?php echo htmlspecialchars($product['image_path'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                            <td data-label="Name"><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Category"><?php echo htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Weight"><?php echo htmlspecialchars($product['weight'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Height"><?php echo htmlspecialchars($product['height'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Width"><?php echo htmlspecialchars($product['width'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Origin"><?php echo htmlspecialchars($product['origin'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Warranty"><?php echo htmlspecialchars($product['warranty'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Care Instruction"><?php echo htmlspecialchars($product['care_instruction'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Packaging"><?php echo htmlspecialchars($product['packaging'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Price" class="price">RM <?php echo number_format((float)$product['price'], 2, '.', ''); ?></td>
                            <td data-label="Quantity">
                                <div class="input-group quantity-control">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary decrease-quantity" type="button">-</button>
                                    </div>
                                    <input type="number" class="form-control text-center quantity-input" value="1" min="1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary increase-quantity" type="button">+</button>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Remove"><button class="btn btn-dark remove-product" type="button">Remove</button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center my-4">
                <button class="btn btn-dark mx-2" id="addToCartButton">Add to Cart</button>
                <button class="btn btn-dark mx-2" id="buyNowButton">Buy It Now</button>
            </div>
        <?php else: ?>
            <p class="text-center">No products selected for comparison.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
    // Quantity control buttons
    $('.decrease-quantity').on('click', function() {
        var input = $(this).closest('.quantity-control').find('.quantity-input');
        var value = parseInt(input.val(), 10);
        if (value > 1) {
            input.val(value - 1);
            updatePrice($(this).closest('tr'), value - 1);
            input.closest('tr').find('input[name="quantity[]"]').val(value - 1);
        }
    });

    $('.increase-quantity').on('click', function() {
        var input = $(this).closest('.quantity-control').find('.quantity-input');
        var value = parseInt(input.val(), 10);
        input.val(value + 1);
        updatePrice($(this).closest('tr'), value + 1);
        input.closest('tr').find('input[name="quantity[]"]').val(value + 1);
    });

    function updatePrice(row, quantity) {
        var price = parseFloat(row.data('price'));
        var total = price * quantity;
        row.find('.price').text('RM ' + total.toFixed(2));
    }

    // Remove product from comparison
    $('.remove-product').on('click', function() {
        var row = $(this).closest('tr');
        var productId = row.data('product-id');
        row.remove();
        // Optionally, you can also make an AJAX call to update the session or database
    });

    // Buy It Now button
    $('#buyNowButton').on('click', function() {
        var selectedProducts = [];
        $('#compareTableBody tr').each(function() {
            var row = $(this);
            if (row.find('.product-check').is(':checked')) {
                var productId = row.data('product-id');
                var quantity = row.find('.quantity-input').val();
                selectedProducts.push({productId: productId, quantity: quantity});
            }
        });

        if (selectedProducts.length > 0) {
            var url = 'checkout.php?';
            selectedProducts.forEach(function(product, index) {
                url += 'product_id[]=' + product.productId + '&quantity[]=' + product.quantity;
                if (index < selectedProducts.length - 1) {
                    url += '&';
                }
            });
            window.location.href = url;
        } else {
            alert('Please select a product to buy.');
        }
    });
});
</script>

</body>
</html>
