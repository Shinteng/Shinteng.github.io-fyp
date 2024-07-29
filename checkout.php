<?php
include 'session.php';
include 'db_connect.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=checkout.php&product_id=" . urlencode($_GET['product_id']) . "&quantity=" . urlencode($_GET['quantity']));
    exit();
}

// Get user and product information
$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : (isset($_GET['product_id']) ? (int)$_GET['product_id'] : null);
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : (isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1);

if (!$product_id) {
    echo "No product selected.";
    exit();
}

// Get user information
$stmt = $conn->prepare("SELECT first_name, last_name, phone, address FROM account WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();

// Get product information
$stmt = $conn->prepare("SELECT product_name, price, image_path FROM product WHERE product_id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
$product = $product_result->fetch_assoc();
$stmt->close();

// Calculate subtotal
$subtotal = $product['price'] * $quantity;

// Determine shipping fee
$shipping = $subtotal > 300 ? 0 : 10.00;

// Check if gift wrapping is applied
$gift = isset($_POST['gift']) ? 1 : 0;
$gift_wrapping = $gift ? 5.00 : 0.00;

// Calculate total
$total_price = $subtotal + $shipping + $gift_wrapping;

$error = "";

// Validate delivery information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay_now'])) {
    // Validate required fields
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $sec_code = $_POST['sec_code'];
    $card_name = $_POST['card_name'];

    // Validate delivery information
    if (!$user['first_name'] || !$user['phone'] || !$user['address']) {
        $error = "Incomplete delivery information. Please update your profile.";
    } else if (empty($card_number) || empty($exp_date) || empty($sec_code) || empty($card_name)) {
        $error = "All card details are required.";
    } else {
        // Simulate card validation and deduction
        $stmt = $conn->prepare("SELECT balance FROM card WHERE card_number=? AND exp_date=? AND sec_code=? AND card_name=?");
        $stmt->bind_param("ssss", $card_number, $exp_date, $sec_code, $card_name);
        $stmt->execute();
        $card_result = $stmt->get_result();
        $card = $card_result->fetch_assoc();
        $stmt->close();

        if ($card && $card['balance'] >= $total_price) {
            // Deduct the amount from the card balance
            $new_balance = $card['balance'] - $total_price;
            $stmt = $conn->prepare("UPDATE card SET balance=? WHERE card_number=?");
            $stmt->bind_param("ds", $new_balance, $card_number);
            $stmt->execute();
            $stmt->close();

            // Insert into order table
            $stmt = $conn->prepare("INSERT INTO order (account_id, condition, total_price, gift, to_name, from_name, note) VALUES (?, 'Shipping', ?, ?, ?, ?, ?)");
            $stmt->bind_param("idisss", $user_id, $total_price, $gift, $_POST['to'], $_POST['from'], $_POST['note']);
            $stmt->execute();
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Insert into order_detail table
            $stmt = $conn->prepare("INSERT INTO order_detail (order_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $order_id, $product_id, $quantity);
            $stmt->execute();
            $stmt->close();

            echo "Order placed successfully!";
        } else {
            $error = "Invalid card details or insufficient balance.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - Checkout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="checkout-container">
        <h1 class="mb-5">Delivery Information</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="profile.php" class="btn btn-dark mb-3">Change Information</a>
        <form action="checkout.php" method="post" id="gift_form">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" id="gift" name="gift" <?php echo $gift ? 'checked' : ''; ?>>
                <label class="form-check-label" for="gift">Make it as a gift</label>
            </div>
            <div id="gift_details" style="display: <?php echo $gift ? 'block' : 'none'; ?>;">
                <div class="form-row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="to" placeholder="To" value="<?php echo isset($_POST['to']) ? htmlspecialchars($_POST['to'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="from" placeholder="From" value="<?php echo isset($_POST['from']) ? htmlspecialchars($_POST['from'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control" name="note" rows="3" placeholder="Please write down the note you want"><?php echo isset($_POST['note']) ? htmlspecialchars($_POST['note'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                </div>
            </div>
        </form>
        
        <div class="row">
            <div class="col-md-3">
                <img src="<?php echo htmlspecialchars($product['image_path'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-9">
                <h2 class="product-title"><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="product-price">RM <?php echo number_format((float)$product['price'], 2, '.', ''); ?></p>
                <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h5>Subtotal:</h5>
                    <h5>RM <span id="subtotal"><?php echo number_format((float)$subtotal, 2, '.', ''); ?></span></h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5>Shipping:</h5>
                    <h5>RM <span id="shipping"><?php echo number_format((float)$shipping, 2, '.', ''); ?></span></h5>
                </div>
                <div class="d-flex justify-content-between" id="gift_wrapping_text" style="display: <?php echo $gift ? 'flex' : 'none'; ?>;">
                    <h5>Gift Wrapping:</h5>
                    <h5>RM <span id="gift_wrapping"><?php echo number_format((float)$gift_wrapping, 2, '.', ''); ?></span></h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h2><strong>Total:</strong></h2>
                    <h2><strong>RM <span id="total_price"><?php echo number_format((float)$total_price, 2, '.', ''); ?></span></strong></h2>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-12">
                <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form action="checkout.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                    <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                    <input type="hidden" name="shipping" value="<?php echo $shipping; ?>">
                    <input type="hidden" name="gift_wrapping" id="gift_wrapping_hidden" value="<?php echo $gift_wrapping; ?>">
                    <input type="hidden" name="total_price" id="total_price_hidden" value="<?php echo $total_price; ?>">
                    <h1 class="mb-2">Payment</h1>
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="Card Number" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expDate">Expiration Date (MM/YY)</label>
                            <input type="text" class="form-control" id="expDate" name="exp_date" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="secCode">Security Code</label>
                            <input type="text" class="form-control" id="secCode" name="sec_code" placeholder="Security Code" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardName">Name on Card</label>
                        <input type="text" class="form-control" id="cardName" name="card_name" placeholder="Name on Card" required>
                    </div>
                    <button type="submit" name="pay_now" class="btn pay-now-btn">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#gift').change(function() {
            if ($(this).is(':checked')) {
                $('#gift_details').show();
                $('#gift_wrapping_text').show();
                $('#gift_wrapping').text('5.00'); // Display RM 5.00 in the text
                $('#gift_wrapping_hidden').val('5.00'); // Update the hidden input value
            } else {
                $('#gift_details').hide();
                $('#gift_wrapping_text').hide(); // Hide the gift wrapping title and amount
                $('#gift_wrapping').text('0.00'); // Remove the fee from the text
                $('#gift_wrapping_hidden').val('0.00'); // Update the hidden input value
            }
            updateTotal();
        });

        function updateTotal() {
            let subtotal = parseFloat($('#subtotal').text());
            let shipping = parseFloat($('#shipping').text());
            let giftWrapping = parseFloat($('#gift_wrapping_hidden').val());
            let total = subtotal + shipping + giftWrapping;
            $('#total_price').text(total.toFixed(2));
            $('#total_price_hidden').val(total.toFixed(2));
        }

        updateTotal();
    });
    </script>

</body>
</html>