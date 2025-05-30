<?php
global $conn;
require '../PHP_Project/db_connection.php';
session_start();
$isLoggedIn = isset($_SESSION['user']);

// استعلام بسيط لجلب المنتجات بالترتيب الأصلي
$sql = "SELECT * FROM products ORDER BY product_id ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prroduct List</title>
    <link rel="stylesheet" href="../CSS_Project/shop.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Josefin+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!--  *****************************************************************************************-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--  ********************************************************************************************-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>
        .back-to-top1 {
            position: fixed;
            bottom: 40px;
            right: 25px;
            width: 40px;
            height: 40px;
            background-color: transparent;
            color: #8C7250;
            border: 1px solid #8C7250;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 999;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .back-to-top1:hover {
            background-color: #a07f58;
            color: #0B1315;
            border: 1px solid #0B1315;
        }
        html {
            scroll-behavior: smooth;
        }
        .mobile-menu-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 3000;
            font-size: 28px;
            color: #8C7250;
            display: none;
            cursor: pointer;
        }


        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        @media (max-width: 768px) {
            .mobile-menu-icon {
                display: block;
            }
            .navbar ul {
                display: none;
                flex-direction: column;
                align-items: flex-end;
                background-color: rgba(11, 19, 21, 0.95);
                position: fixed;
                top: 60px;
                right: 0;
                width: 220px;
                padding: 15px;
                z-index: 2000;
            }
            .navbar.mobile-active ul {
                display: flex;
            }
            .navbar ul li {
                margin: 10px 0;
                width: 100%;
            }
            .navbar ul li a {
                font-size: 18px;
                padding: 10px;
                text-align: right;
                position: relative;
                z-index: 1;
            }
            .navbar .dropdown-content {
                position: static;
                border: none;
                border-radius: 0;
                padding-left: 15px;
                margin-top: 5px;
                background-color: transparent;
                display: none;
            }
            .navbar .dropdown-content.show {
                display: block;
            }
        }
        @media (max-width: 768px) {
            .gold-lines::before,
            .gold-lines::after {
                display: none;
            }


        }
    </style>
</head>
<div id="top"></div>

<a href="#top" class="back-to-top1">
    <i class="ri-arrow-up-circle-line"></i>
</a>

<body style="scroll-behavior: smooth;">
<div class="image-wrapper">
    <div class="corner-image"></div>
</div>
<div class="mobile-menu-icon" onclick="toggleMobileMenu()">
    <i class="fas fa-bars"></i>
</div>

<!-- Navigation Bar -->
<nav class="navbar">
    <ul class="nav-links">
        <li style="   margin-left:250px; "><a href="index.html" class="active1">Home</a></li>
        <li><a href="about.html">About us</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="bookatable.html">Book A Table</a></li>

        <li class="dropdown">
            <a href="shop.php">Shop</a>
            <ul class="dropdown-content">
                <li><a href="shop.php">Product List</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </li>

        <li><a href="contact.html">Contact</a></li>

        <?php
        // جلب عدد المنتجات في السلة
        $cart_count = 0;
        if (isset($_SESSION['user'])) {
            $user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];
            $sql = "SELECT COUNT(*) as count FROM cart_items WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $resultt = $stmt->get_result();
            $row = $resultt->fetch_assoc();
            $cart_count = $row['count'];
            $stmt->close();
        }
        ?>
        <li class="dropdown">
            <a href="login.html" style="   margin-left:90px;"><i class="fas fa-user-plus"></i></a>
            <ul class="dropdown-content">
                <li><a href="acount.html">My Profile</a></li>
            </ul>
        </li>        <li><a href="out.html" style="   margin-left:-20px;"><i class="fas fa-sign-in-alt"></i></a></li>
        <li class="cart-icon">
            <a href="cart.php" title="View Cart" style="position: relative;">
                <i class="fas fa-shopping-cart" style="font-size: 22px; color: white;"></i>
                <span id="badge" class="cart-count"
                      style="position: absolute; top: -8px; right: -8px; background: #CB9953; color: black; border-radius: 50%; padding: 2px 6px; font-size: 14px; font-weight: 700;">
            <?php echo $cart_count; ?>
        </span>
            </a>
        </li>
    </ul>
</nav>


<div class="gold-lines">
    <div class="top-line"></div>
</div>
<!--*********************************************************************************************-->

<div class="backgroundForShop">
    <p class="shopStatement">Product List</p>
</div>

<div id="search_container">
    <button id="search" onclick="searchProducts()"> <i class="ri-search-line" style="font-size: 24px;"></i></button>
    <input type="search" id="search_input" placeholder="search product name here..">
</div>

<div class="top_section">
    <div id="buttons">
        <button class="button-value" data-filter="all" onclick="filterProduct('all')">All</button>
        <button class="button-value" data-filter="MainCourses" onclick="filterProduct('MainCourses')">MainCourses</button>
        <button class="button-value" data-filter="Desserts" onclick="filterProduct('Desserts')">Desserts</button>
        <button class="button-value" data-filter="Drinks" onclick="filterProduct('Drinks')" >Drinks</button>

        <select class="selectByOrder" onchange="sortProducts()">
            <option value="" disabled selected>Sort by</option>
            <option value="popularity">Sort by popularity</option>
            <option value="lowToHigh">Sort by price: low to high</option>
            <option value="highToLow">Sort by price: high to low</option>
        </select>
    </div>
</div>

<div id="products">
    <?php
    while ($row = $result->fetch_assoc()):
        $category = htmlspecialchars($row['category']);
        $name = htmlspecialchars($row['name']);
        $price = htmlspecialchars($row['price']);
        $image = htmlspecialchars($row['image_url']);
        $discount = htmlspecialchars($row['discount']);
        $productId = $row['product_id'];
        ?>
        <div class="card <?= $category ?>" data-category="<?= $category ?>" data-name="<?= $name ?>" data-popularity="<?= $row['popularity'] ?>" data-price="<?= $price ?>">
            <div class="image-container">
                <img src="image2/<?= $image ?>" alt="<?= $category ?>">
                <span class="discount">-<?= $discount ?>%</span>

                <?php if ($isLoggedIn): ?>
                    <button class="button-addToCart" data-id="<?= $productId ?>">ADD TO CART</button>
                <?php else: ?>
                    <a href="login.html" class="button-addToCart">Login to Add</a>
                <?php endif; ?>
            </div>


            <div class="container">
                <h5 class="product-name"><?= $name ?></h5>
                <h6>$<?= $price ?></h6>
            </div>
        </div>
    <?php endwhile; ?>
</div>



<script src="../JAVAS_Project/shop.js"></script>


<footer class="golden-footer">
    <div class="footer-waves">
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
        <div class="wave wave-3"></div>
    </div>


    <div class="footer-container">
        <div class="footer-section">
            <h3 class="footer-logo">Golden Restaurant</h3>
            <p class="footer-description">Experience the finest dining with authentic flavors and luxurious ambiance.</p>
            <div class="footer-social">
                <a href="https://www.facebook.com" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.twitter.com" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-twitter"></i>
                </a>

            </div>

        </div>

        <div class="footer-section">
            <h3 class="footer-title">Quick Links</h3>
            <ul class="footer-links">
                <li><a href="index.html" style="text-decoration: none">Home</a></li>
                <li><a href="about.html" style="text-decoration: none">About Us</a></li>
                <li><a href="menu.html" style="text-decoration: none">Menu</a></li>
                <li><a href="bookatable.html" style="text-decoration: none">Book a Table</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3 class="footer-title">Contact Us</h3>
            <ul class="footer-contact">
                <li><i class="fas fa-map-marker-alt"></i> Tunis Street, near Dahiyat
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Al-Nakheel, Nablus, Palestine</li>
                <li><i class="fas fa-phone"></i> 059-737-7354</li>
                <li><i class="fas fa-envelope"></i> golden@gmail.com</li>
            </ul>
        </div>

        <div class="footer-section">
            <h3 class="footer-title">Opening Hours</h3>
            <ul class="footer-hours">
                <li>Monday - Friday: 9:00 AM - 11:00 PM</li>
                <li>Saturday - Sunday: 10:00 AM - 12:00 AM</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 Golden Restaurant. All rights reserved. Designed & Developed by Eng. Amaal ♥ Eng. Afnan
        </p>
    </div>
</footer>
<script >
    function toggleMobileMenu() {
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('mobile-active');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.querySelector('.navbar .dropdown > a');
        const dropdownContent = document.querySelector('.navbar .dropdown .dropdown-content');

        dropdownToggle.addEventListener('click', function (e) {
            if (window.innerWidth <= 768) {
                e.preventDefault(); // منع فتح الرابط الأصلي
                dropdownContent.classList.toggle('show');
            }
        });
    });


    // إغلاق القائمة عند الضغط في أي مكان خارجها
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar');
        const mobileIcon = document.querySelector('.mobile-menu-icon');
        const isClickInsideNavbar = navbar.contains(event.target);
        const isClickOnIcon = mobileIcon.contains(event.target);

        // إذا الكليك خارج النافبار ولم يكن على أيقونة القائمة، أغلق القائمة
        if (!isClickInsideNavbar && !isClickOnIcon) {
            navbar.classList.remove('mobile-active');
        }
    });</script>
</body>

</html>
