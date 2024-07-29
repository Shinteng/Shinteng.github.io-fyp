<?php
include 'session.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mx-auto d-lg-none" href="index.php">
        <img src="images/logo.jpg" alt="Logo" class="logo">
    </a>
    <div class="d-lg-none ml-auto">
        <a class="nav-link" href="compare.php">
            <img src="images/scales.png" alt="Compare" class="icon">
        </a>
        <a class="nav-link" href="#">
            <img src="images/shopping-cart.png" alt="Cart" class="icon">
        </a>
    </div>
    <div class="collapse navbar-collapse mx-4" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="catalogue.php" id="catalogueLink">Catalogue</a>
                <a class="nav-link dropdown-toggle" id="catalogueDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="catalogueDropdown">
                    <a class="dropdown-item" href="product.php?category=BRACELETS">Bracelets</a>
                    <a class="dropdown-item" href="product.php?category=NECKCALES">Necklaces</a>
                    <a class="dropdown-item" href="product.php?category=EARINGS">Earrings</a>
                    <a class="dropdown-item" href="product.php?category=PENDANT">Pendants</a>
                    <a class="dropdown-item" href="product.php?category=PEARL COLLECTION">Pearl Collection</a>
                    <a class="dropdown-item" href="product.php?category=MARBLE COLLECTION">Marble Collection</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
        </ul>
        <a class="navbar-brand d-none d-lg-block mx-auto" href="index.php">
            <img src="images/logo.jpg" alt="Logo" class="logo">
            <span class="brand-text">Jewelry Boutique X</span>
        </a>
        <ul class="navbar-nav ml-auto d-none d-lg-flex">
            <li class="nav-item">
                <a class="nav-link" href="compare.php">
                    <img src="images/scales.png" alt="Compare" class="icon"> <span class="icon-text">Compare</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>">
                    <img src="images/user.png" alt="User" class="icon"> <span class="icon-text">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <img src="images/shopping-cart.png" alt="Cart" class="icon"> <span class="icon-text">Cart</span>
                </a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <img src="images/log-out.png" alt="Log Out" class="icon"> <span class="icon-text">Log Out</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="navbar-nav d-lg-none w-100">
            <a class="nav-link" href="index.php">Home</a>
            <div class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#mobileCatalogue" aria-expanded="false" aria-controls="mobileCatalogue">Catalogue</a>
                <div class="collapse" id="mobileCatalogue">
                    <a class="nav-link" href="product.php?category=BRACELETS">Bracelets</a>
                    <a class="nav-link" href="product.php?category=NECKCALES">Necklaces</a>
                    <a class="nav-link" href="product.php?category=EARINGS">Earrings</a>
                    <a class="nav-link" href="product.php?category=PENDANT">Pendants</a>
                    <a class="nav-link" href="product.php?category=PEARL COLLECTION">Pearl Collection</a>
                    <a class="nav-link" href="product.php?category=MARBLE COLLECTION">Marble Collection</a>
                </div>
            </div>
            <a class="nav-link" href="about.php">About</a>
            <a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>">Profile</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link" href="logout.php">Log Out</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    document.getElementById('catalogueLink').addEventListener('click', function(event) {
        window.location.href = 'catalogue.php';
    });
</script>

<link rel="stylesheet" href="css/navbar.css">
