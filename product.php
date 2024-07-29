<?php
// product.php
include 'db_connect.php';

// Set the number of products per page
$products_per_page = 16;

// Get the current page number from the query string, default to page 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$category = isset($_GET['category']) ? $_GET['category'] : 'BRACELETS';

// Calculate the offset for the SQL query
$offset = ($page - 1) * $products_per_page;

// Get the total number of products in the category
$total_products_sql = "SELECT COUNT(*) FROM product 
                        JOIN category ON product.category_id = category.category_id 
                        WHERE category.category='$category'";
$total_products_result = $conn->query($total_products_sql);
$total_products_row = $total_products_result->fetch_row();
$total_products = $total_products_row[0];

// Calculate the total number of pages
$total_pages = ceil($total_products / $products_per_page);

// Fetch products for the current page
$sql = "SELECT product.product_id, product.product_name, product.price, product.image_path 
        FROM product 
        JOIN category ON product.category_id = category.category_id 
        WHERE category.category='$category'
        LIMIT $offset, $products_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - <?php echo ucfirst(strtolower($category)); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/product.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="mx-5 mt-5">
        <h1 class="category-title text-center"><?php echo ucfirst(strtolower($category)); ?></h1> <!-- Category title -->
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-3 col-md-6 col-12 mb-4">';
                    echo '<a href="product_detail.php?id=' . $row["product_id"] . '" class="text-decoration-none text-dark">';
                    echo '<div class="card">';
                    echo '<img src="' . $row["image_path"] . '" class="card-img-top" alt="' . $row["product_name"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["product_name"] . '</h5>';
                    echo '<p class="card-text">RM ' . $row["price"] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="col-12">No products found in this category.</p>';
            }
            ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="product.php?category=<?php echo $category; ?>&page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="product.php?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="product.php?category=<?php echo $category; ?>&page=<?php echo $page + 1; ?>">Next</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
