<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/catalogue.css">
    
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
        <h1 class="title text-center mt-5">All Collection</h1>
        <div class="row text-center mt-4 mx-5 ">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <a href="product.php?category=BRACELETS">
                    <img src="images/bracelet.jpg" class="img-fluid product-image" alt="Bracelets">
                    <h3 class="m-2 product-link">BRACELETS</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <a href="product.php?category=NECKCALES">
                    <img src="images/necklace.jpg" class="img-fluid product-image" alt="Necklaces">
                    <h3 class="m-2 product-link">NECKLACES</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <a href="product.php?category=EARINGS">
                    <img src="images/earrings.jpg" class="img-fluid product-image" alt="Earrings">
                    <h3 class="m-2 product-link">EARRINGS</h3>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <a href="product.php?category=PENDANT">
                    <img src="images/pendant.jpg" class="img-fluid product-image" alt="Pendant">
                    <h3 class="m-2 product-link">PENDANTS</h3>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <a href="product.php?category=PEARL COLLECTION">
                    <img src="images/pearl.jpg" class="img-fluid product-image" alt="Pearl Collection">
                    <h3 class="m-2 product-link">PEARL COLLECTION</h3>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <a href="product.php?category=MARBLE COLLECTION">
                    <img src="images/marble.jpg" class="img-fluid product-image" alt="Marble Collection">
                    <h3 class="m-2 product-link">MARBLE COLLECTION</h3>
                </a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
