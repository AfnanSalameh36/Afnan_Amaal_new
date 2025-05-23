<?php
global $conn;
session_start();
require '../PHP_Project/db_connection.php'; // تأكدي من المسار الصحيح

$cartItems = []; // مصفوفة لتخزين عناصر السلة

if (isset($_SESSION['user'])) {
    $user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : (int)$_SESSION['user'];

    // استعلام آمن باستخدام Prepared Statement
    $sql_cart = "SELECT * FROM cart_items WHERE user_id = ?";
    $stmt_cart = $conn->prepare($sql_cart);
    $stmt_cart->bind_param("i", $user_id);
    $stmt_cart->execute();
    $all_cart = $stmt_cart->get_result();

    // جلب البيانات مع ربطها بجدول products
    while ($row_cart = mysqli_fetch_assoc($all_cart)) {
        $sql_product = "SELECT * FROM products WHERE product_id = ?";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->bind_param("i", $row_cart['product_id']);
        $stmt_product->execute();
        $all_product = $stmt_product->get_result();

        while ($row = mysqli_fetch_assoc($all_product)) {
            $cartItems[] = array_merge($row, ['quantity' => $row_cart['quantity']]);
        }
        $stmt_product->close();
    }
    $stmt_cart->close();
}

$conn->close(); // إغلاق الاتصال
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="../CSS_Project/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Josefin+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <!--  *****************************************************************************************-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!--  ********************************************************************************************-->
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


<body style="scroll-behavior: smooth;">
<div id="top"></div>

<a href="#top" class="back-to-top1">
    <i class="ri-arrow-up-circle-line"></i>
</a>
<div class="image-wrapper">
    <div class="corner-image"></div>
</div>
<div class="mobile-menu-icon" onclick="toggleMobileMenu()">
    <i class="fas fa-bars"></i>
</div>

<!-- Navigation Bar -->
<nav class="navbar">
    <ul class="nav-links">
        <li style="   margin-left:250px; "><a href="index.html" class="active">Home</a></li>
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
        <li class="dropdown">
            <a href="login.html" style="   margin-left:90px;"><i class="fas fa-user-plus"></i></a>
            <ul class="dropdown-content">
                <li><a href="acount.html">My Profile</a></li>
            </ul>
        </li>
        <li><a href="out.html" style="   margin-left:-20px;"><i class="fas fa-sign-in-alt"></i></a></li>


    </ul>
</nav>


<div class="gold-lines">
    <div class="top-line"></div>
</div>
<!--*********************************************************************************************-->
<div class="backgroundForCart">
    <p class="CartStatement">Cart</p>
</div>
<?php if (empty($cartItems)): ?>
    <div class="cartEmpty" style="margin-bottom: 15px;">
        <p class="statementCartEmpty">Your cart is currently empty</p>
    </div>
    <div class="divButtonReturnToPL" style="margin-bottom: 200px;">
        <button class="button"><a href="shop.php">Return to shop</a></button>
    </div>
<?php else: ?>
    <table class="styled-table">
        <tr class="theFirstRow">
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        <?php foreach ($cartItems as $index => $item): ?>
            <tr>
                <td class="product-cell">
                    <div class="product-info">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <span class="productItem"><?php echo htmlspecialchars($item['name']); ?></span>
                    </div>
                </td>
                <td class="price"><?php echo number_format($item['price'], 2); ?> $</td>
                <td>
                    <div class="custom_number_input">
                        <input type="number" min="1" step="1" class="quantity"
                               value="<?php echo max(1, $item['quantity']); ?>"
                               data-product-id="<?php echo $item['product_id']; ?>"
                               data-price="<?php echo $item['price']; ?>">
                        <div class="arrow-container">
                            <i class="fa-solid fa-chevron-up arrow-up"></i>
                            <i class="fa-solid fa-chevron-down arrow-down"></i>
                        </div>
                    </div>
                </td>
                <td class="subtotal" id="subtotal-<?php echo $index; ?>">
                    <?php echo number_format($item['price'] * $item['quantity'], 2); ?> $
                </td>
                <td>
                    <div class="iconDelete">
                        <button class="remove" data-id="<?php echo $item['product_id']; ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="theLastRow">
            <td colspan="2" style="border-bottom: none;padding-top: 30px">
                <input type="text" class="inputForCouponCode" name="couponCode" placeholder="Coupon Code" id="couponInput">
                <button class="button">Apply Coupon</button>
                <button class="button" onclick="window.location.href='discount.html'">Go to Offers</button>
            </td>
            <td colspan="3" class="button-cell" style="border-bottom: none;">
                <button class="button" id="update-cart">Update Cart</button>
            </td>
        </tr>
    </table>

    <?php
    $total = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cartItems));
    ?>
    <table class="styled-table2">
        <tr class="theFirstRowInSecondTable">
            <th colspan="2" style="border-bottom: none">Cart totals</th>
        </tr>
        <tr>
            <td class="price2">Subtotal</td>
            <td class="subtotal2"><?php echo number_format($total, 2); ?> $</td>
        </tr>
        <tr>
            <td class="price2">Total</td>
            <td class="price2"><?php echo number_format($total, 2); ?> $</td>
        </tr>
    </table>

    <div class="backgroundForCheckout">
        <div class="containerForForm">
            <form id="checkout-form" method="POST" action="../PHP_Project/process_checkout.php">
                <table class="tableForCheckout">
                    <tr><td colspan="2"><p class="statementOfCheckout">Checkout</p></td></tr>
                    <tr>
                        <td><input type="text" name="first_name" placeholder="First Name" required autocomplete="off" style="width: 150px;"></td>
                        <td><input type="text" name="last_name" placeholder="Last Name" required autocomplete="off" style="width: 150px;"></td>
                    </tr>
                    <tr><td colspan="2"><input type="tel" name="phone_number" placeholder="Phone Number" required autocomplete="off" style="width: 320px;"></td></tr>
                    <tr><td colspan="2"><input type="text" name="address" placeholder="Address" required autocomplete="off" style="width: 320px;"></td></tr>
                    <tr>
                        <td colspan="2">
                            <select class="custom-select" name="city" id="city-select" onchange="changeSelectColor(this)">
                                <option value="" disabled selected hidden class="placeholder-option">City</option>
                                <option value="Nablus">Nablus</option>
                                <option value="Ramallah">Ramallah</option>
                                <option value="Bethlehem">Bethlehem</option>
                                <option value="Jenin">Jenin</option>
                                <option value="Tulkarm">Tulkarm</option>
                                <option value="Qalqilya">Qalqilya</option>
                                <option value="Salfit">Salfit</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: none">
                            <button type="button" class="button" onclick="handleSubmit()">Place order</button>
                            <!-- إضافة div لعرض الرسالة -->
                            <div id="message-container" style="text-align: center; margin-top: 10px;"></div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php endif; ?>
<script>
    function changeSelectColor(select) {
        if (select.value === "") {
            select.classList.remove("selected");
            select.style.color = "#6c757d";
        } else {
            select.classList.add("selected");
            select.style.color = "#cccccc";
        }
    }
</script>
<script src="../JAVAS_Project/cart.js"></script>

<!--*********************************************************************************************-->
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
<script>
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
    });
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    window.addEventListener('DOMContentLoaded', () => {
        const coupon = getQueryParam('coupon');
        if (coupon) {
            document.getElementById('couponInput').value = coupon;
        }
    });
</script>
</body>
</html>