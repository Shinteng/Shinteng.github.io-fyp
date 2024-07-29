<?php
include 'session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'db_connect.php';

// Fetch user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM account WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch order history
$order_sql = "SELECT o.*, p.product_name, p.image_path, od.quantity 
              FROM `order` o 
              JOIN `order-detail` od ON o.order_id = od.order_id 
              JOIN `product` p ON od.product_id = p.product_id 
              WHERE o.account_id = ?";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

// Group orders by order_id
$orders = [];
while ($order = $order_result->fetch_assoc()) {
    if (!isset($orders[$order['order_id']])) {
        $orders[$order['order_id']] = [
            'details' => $order,
            'products' => []
        ];
    }
    $orders[$order['order_id']]['products'][] = [
        'product_name' => $order['product_name'],
        'quantity' => $order['quantity'],
        'image_path' => $order['image_path']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css"> 
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="profile-page">
        <h2 class="text-center m-5">Profile</h2>

        <div class="orders-section">
            <h4>Orders</h4>
            <?php foreach ($orders as $order_id => $order) { ?>
                <div class="order-card">
                    <img src="<?php echo htmlspecialchars($order['products'][0]['image_path']); ?>" alt="Product">
                    <div class="order-details">
                        <div class="order-header">
                            <h5>Order ID: <?php echo htmlspecialchars($order_id); ?></h5>
                            <p class="price">RM<?php echo htmlspecialchars($order['details']['total_price']); ?></p>
                        </div>
                        <?php foreach ($order['products'] as $product) { ?>
                            <p class="description"><?php echo htmlspecialchars($product['product_name']); ?> x <?php echo htmlspecialchars($product['quantity']); ?></p>
                        <?php } ?>
                        <p class="condition">Condition: <?php echo htmlspecialchars($order['details']['condition']); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="account-details-section">
            <h4>Account Details</h4>
            <form id="profileForm" method="POST" action="update_profile.php">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                </div>
                <button type="submit" class="btn btn-primary edit-button">Edit</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
