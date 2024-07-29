<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Boutique X - About</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <!-- Staff Intro -->
    <h1 class="title text-center mt-5">About</h1>

    <div class="row m-5 staff">
        <div class="col-md-3"><img src="images/ceo.jpg" alt="ceo" width="100%"></div>
        <div class="col-md-9 pl-md-5">
            <p class="position">CEO</p>
            <h1>Charlotte Morgan</h1>
            <p>As the visionary behind Jewelry Boutique X, Charlotte Morgan brings a wealth of experience and passion to our company. With a background in business management and a keen eye for luxury, Charlotte Morgan has dedicated their career to curating exquisite jewelry collections that blend timeless elegance with contemporary style. Under her leadership, Jewelry Boutique X has flourished into a premier destination for discerning customers seeking unparalleled quality and craftsmanship. Charlotte Morgan believes in creating pieces that not only adorn but also tell a story, celebrating the unique beauty and individuality of each wearer.</p>
        </div>
    </div>

    <div class="row m-5 staff">
        <div class="col-md-9 order-md-1 order-2 pr-md-5">
            <p class="position">Jewelry Designer</p>
            <h1>Lily Carter</h1>
            <p>Lily Carter is the creative force behind the stunning designs at Jewelry Boutique X. With a deep appreciation for artistry and a meticulous attention to detail, Lily Carter transforms raw materials into breathtaking works of wearable art. Drawing inspiration from nature, fashion, and the timeless allure of pearls and marble, Lily Carter crafts each piece with precision and passion. Their innovative approach and dedication to excellence ensure that every item in our collection is as unique and special as the person who wears it. Lily Carter’s commitment to quality and creativity is at the heart of Jewelry Boutique X, making our jewelry truly exceptional.</p>
        </div>
        <div class="col-md-3 order-md-2 order-1"><img src="images/designer.jpg" alt="designer" width="100%"></div>
    </div>

    <!-- Services -->
    <div class="service my-5">
        <h2 class="text-center mb-5">We Want To Provide You</h2>
        <div class="row text-center mx-5">
            <div class="servicetext col-md-2 mr-md-5">
                <img src="images/delivery-truck.png" alt="Free Shipping" class="mb-3" width="50">
                <h4>Free Shipping</h4>
                <p>Enjoy complimentary shipping on all orders over RM 100. We believe that luxury should be accessible, so we make it easy for you to receive your beautiful jewelry without any extra cost.</p>
            </div>
            <div class="servicetext col-md-2 mx-md-5">
                <img src="images/customer-service.png" alt="Online Support" class="mb-3" width="50">
                <h4>Online Support</h4>
                <p>Our dedicated customer support team is available to assist you with any questions or concerns. Whether you need help choosing the perfect piece or tracking your order, we’re here to provide prompt and friendly assistance.</p>
            </div>
            <div class="servicetext col-md-2 mx-md-5">
                <img src="images/gift.png" alt="Gift Wrapping" class="mb-3" width="50">
                <h4>Gift Wrapping</h4>
                <p>Make your gift extra special with our free gift wrapping service. Perfect for birthdays, anniversaries, or just because, we’ll ensure your purchase is beautifully packaged and ready to delight the recipient.</p>
            </div>
            <div class="servicetext col-md-2 ml-md-5">
                <img src="images/clean.png" alt="Care and Cleaning" class="mb-3" width="50">
                <h4>Care and Cleaning</h4>
                <p>Keep your jewelry looking its best with our complimentary care and cleaning services. Bring your pieces in, and we’ll clean and inspect them to ensure they maintain their beauty and sparkle.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
