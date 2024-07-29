<?php
// Start session
session_start();

include 'db_connect.php';

// Get product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : null; // Sanitize input

// Check if product ID is valid
if ($product_id) {
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT product_name, price, image_path, description FROM product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the product details if available
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
    $stmt->close();
} else {
    echo "No product selected.";
    exit;
}

// Handle the 'Add to Compare' button click
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_compare'])) {
    if (!isset($_SESSION['compare_list'])) {
        $_SESSION['compare_list'] = [];
    }
    if (!in_array($product_id, $_SESSION['compare_list'])) {
        $_SESSION['compare_list'][] = $product_id;
        $message = "Product added to compare list. <a href='compare.php'>Click here to compare</a>";
    } else {
        $message = "Product is already in the compare list. <a href='compare.php'>Click here to compare</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - <?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detail.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="mt-5 mx-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($product['image_path'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-6 detail">
                <h1 class="product-title"><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="product-price">RM <?php echo number_format((float)$product['price'], 2, '.', ''); ?></p>
                <div class="d-flex align-items-center mb-3">
                    <form action="cart.php" method="post" class="mr-3">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                                </div>
                                <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
                                </div>
                                <button type="submit" class="btn btn-cart btn-dark">Add to Cart</button>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    </form>
                </div>
                <form method="post" action="">
                    <button type="submit" name="add_to_compare" class="btn btn-dark btn-block mb-2">Add to Compare</button>
                </form>
                
                <?php if (isset($message)): ?>
                    <div class="alert alert-info mt-3">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="checkout.php" id="buy_now_form">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" id="buy_now_quantity" value="1">
                    <button type="submit" class="btn btn-dark btn-block">Buy It Now</button>
                </form>
            </div>
        </div>
        <div class="row mt-5 mb-5 info">
            <div class="col-12">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Product Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">Shipping Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="repair-tab" data-toggle="tab" href="#repair" role="tab" aria-controls="repair" aria-selected="false">Repair & Maintenance</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <p><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        <ol>
                            <li><b>Shipping Rates:</b>
                                <ul>
                                    <li>We offer free standard shipping on all orders above RM300.</li>
                                    <li>For international orders, shipping rates vary depending on the destination and will be calculated at checkout.</li>
                                </ul>
                            </li>
                            <br>
                            <li><b>Processing Time:</b>
                                <ul>
                                    <li>Orders are typically processed and shipped within 15-30 business days, excluding weekends and holidays.</li>
                                </ul>
                            <br>
                            </li>
                            <li><b>Shipping Methods:</b>
                                <ul>
                                    <li>We primarily use Royal Mail for domestic shipping.</li>
                                    <li>International orders are shipped via DHL or FedEx for faster delivery.</li>
                                </ul>
                            </li>
                            <br>
                            <li><b>Order Tracking:</b>
                                <ul>
                                    <li>Once your order is shipped, you will receive an email with the tracking information.</li>
                                    <li>You can track your order on the courier's website using the tracking number provided.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="repair" role="tabpanel" aria-labelledby="repair-tab">
                        <p>We offer repair and maintenance services for our jewelry products. If your jewelry requires repair or maintenance, please contact our customer service team with your order details and a description of the issue. Our team will provide you with instructions on how to send your jewelry for repair and an estimated timeframe for the service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#decrease').click(function() {
            let quantity = parseInt($('#quantity').val());
            if (quantity > 1) {
                $('#quantity').val(quantity - 1);
                $('#buy_now_quantity').val(quantity - 1);
            }
        });

        $('#increase').click(function() {
            let quantity = parseInt($('#quantity').val());
            $('#quantity').val(quantity + 1);
            $('#buy_now_quantity').val(quantity + 1);
        });

        $('#quantity').change(function() {
            let quantity = parseInt($(this).val());
            if (quantity < 1) {
                $(this).val(1);
                $('#buy_now_quantity').val(1);
            } else {
                $('#buy_now_quantity').val(quantity);
            }
        });
    });
    </script>
</body>
</html>

