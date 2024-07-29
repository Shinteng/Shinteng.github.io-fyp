<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <?php include 'navbar.php'; ?>
    <div>
        <img src="images/cover.png" alt="cover" width="100%">
    </div>
    <!-- pearl collection -->
    <div class="row m-5 collection">
        <div class="col-md-6"><img src="images/pearl-collection.jpg" alt="pearl-collection" width="100%"></div>
        <div class="col-md-6 pl-md-4 collectionDes">
            <h1>Pearl Collection</h1>
            <p>Discover the timeless allure of our Pearl Collection, where elegance meets sophistication. Each piece,
                from
                delicate pearl braclets to stunning pearl necklaces, is crafted with handpicked pearls of the highest
                luster
                and quality. Our versatile designs are perfect for adding a touch of grace to both everyday outfits and
                special occasions. Embrace the enduring beauty of pearls, a symbol of purity and timeless style, and
                elevate
                your elegance with our exquisite collection.</p>
            <a href="product.php?category=PEARL COLLECTION" class="btn btn-primary">Shop collection</a>
        </div>
    </div>
    <!-- marble collection  -->
    <div class="row m-5 collection">
        <div class="col-md-6 order-md-2"><img src="images/marble-collection.jpg" alt="marble-collection" width="100%"></div>
        <div class="col-md-6 pr-md-4 collectionDes order-md-1">
            <h1>Marble Collection</h1>
            <p>Experience the refined elegance of our Marble Collection, where nature’s artistry meets exquisite
                craftsmanship. Each piece showcases the unique, swirling patterns and timeless beauty of genuine marble,
                from statement necklaces to elegant earrings. Our designs blend the classic charm of marble with modern
                style, making them perfect for any occasion. Crafted with genuine marble, each piece is one-of-a-kind,
                offering natural elegance and timeless appeal that seamlessly integrates into both casual and formal
                wardrobes.</p>
            <a href="product.php?category=MARBLE COLLECTION" class="btn btn-primary">Shop collection</a>
        </div>
    </div>
    <!-- welcome banner -->
    <div class="row welcome m-0">
        <div class="col-md-8 order-md-1 welcomeDes">
            <h1 class="m-5">Welcome to Jewelry Boutique X</h1>
            <p class="m-5">where elegance meets exceptional craftsmanship. Dive into our carefully curated collections of luxurious
                pearl and marble jewelry, designed to enhance every moment with timeless beauty and sophistication. From
                delicate pearl earrings to striking marble necklaces, our online store offers a diverse range of
                treasures crafted to perfection. Each piece is a testament to our commitment to quality and style,
                celebrating your unique beauty and individuality. Discover the perfect jewelry that speaks to you, and
                let Jewelry Boutique X be your trusted source for exquisite luxury and unmatched elegance. Shop now and
                embrace the allure of fine craftsmanship.</p>
        </div>
        <div class="col-md-4 order-md-2 p-0 mt-0"><img src="images/welcome.jpg" alt="welcome" width="100%"></div>
    </div>
    <!-- comment that can auto slide -->
    <div id="testimonialCarousel" class="carousel slide m-5" data-ride="carousel">
        <h2 class="text-center mb-4">What People Are Saying</h2>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"The marble collection is simply breathtaking. Each piece feels unique and special. I'm
                            thrilled with my purchase and will be back for more!"</p>
                        <p><strong>Daniel S.</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"I've been searching for high-quality pearl jewelry, and I finally found it at Jewelry
                            Boutique X. The necklace I bought is exquisite and timeless. Thank you for such beautiful
                            pieces!"</p>
                        <p><strong>Michael B.</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"I bought a marble pendant for my wife, and she loves it! The craftsmanship is outstanding,
                            and it's truly a one-of-a-kind piece. Excellent quality and service."</p>
                        <p><strong>Charlotte M.</strong></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"The marble earrings I purchased are stunning. They are unique and beautifully crafted. I've
                            received so many compliments already. Thank you, Jewelry Boutique X!"</p>
                        <p><strong>James T.</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"I am absolutely in love with my pearl necklace from Jewelry Boutique X! The quality is
                            exceptional, and it adds a touch of elegance to every outfit. Highly recommend!"</p>
                        <p><strong>Emily R.</strong></p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="images/rating.png" alt="rating" class="d-block mx-auto mb-3" style="width: 100px;">
                        <p>"Shopping at Jewelry Boutique X has been a wonderful experience. The customer service is
                            top-notch, and my pearl bracelet is even more beautiful in person. I will definitely be a
                            returning customer."</p>
                        <p><strong>Sophia L.</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- comment's button -->
        <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
