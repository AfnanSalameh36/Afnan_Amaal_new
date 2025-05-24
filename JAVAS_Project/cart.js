document.addEventListener("DOMContentLoaded", function () {
    // التعامل مع الأسهم (زيادة وتقليل الكمية)
    const cartItems = document.querySelectorAll(".custom_number_input");

    cartItems.forEach(item => {
        const quantityInput = item.querySelector(".quantity");
        const arrowUp = item.querySelector(".arrow-up");
        const arrowDown = item.querySelector(".arrow-down");

        let currentValue = parseInt(quantityInput.value) || 1;
        if (currentValue < 1) quantityInput.value = 1;

        arrowUp.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
        });

        arrowDown.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    });

    // التعامل مع زر Update Cart
    document.getElementById("update-cart").addEventListener("click", function () {
        const cartItems = document.querySelectorAll(".custom_number_input");
        cartItems.forEach((item, index) => {
            const quantityInput = item.querySelector(".quantity");
            const price = parseFloat(quantityInput.getAttribute("data-price"));
            const quantity = parseInt(quantityInput.value) || 1;
            const subtotal = price * quantity;

            // تحديث الـ Subtotal في الصفحة
            const subtotalElement = document.getElementById(`subtotal-${index}`);
            subtotalElement.textContent = subtotal.toFixed(2) + " $";

            // (اختياري) تحديث الكمية في قاعدة البيانات
            const productId = quantityInput.getAttribute("data-product-id");
            updateQuantity(productId, quantity);
        });

        // تحديث الإجمالي الكلي
        updateCartTotal();
    });

    // دالة لتحديث الكمية في قاعدة البيانات)
    function updateQuantity(productId, quantity) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../PHP_Project/update_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Quantity updated for product ID: " + productId);
            }
        };
        xhr.send(`product_id=${productId}&quantity=${quantity}&user_id=<?php echo $_SESSION['user']['id'] ?? $_SESSION['user']; ?>`);
    }

    // ******************************************************************************************************************
    function updateCartTotal() {
        const subtotals = document.querySelectorAll(".subtotal");
        let total = 0;
        subtotals.forEach(subtotal => {
            total += parseFloat(subtotal.textContent.replace(" $", ""));
        });

        // تحديث Subtotal و Total في الجدول الثاني
        document.querySelector(".subtotal2").textContent = total.toFixed(2) + " $";
        document.querySelector(".price2:last-child").textContent = total.toFixed(2) + " $";
    }

    // *****************************************************************************************************************

    // التعامل مع زر الحذف (من الكود السابق)
    var remove = document.getElementsByClassName("remove");
    for (var i = 0; i < remove.length; i++) {
        remove[i].addEventListener("click", function() {
            var cart_id = this.getAttribute("data-id");
            if (!cart_id) {
                alert("Invalid product ID");
                return;
            }

            var xml = new XMLHttpRequest();
            xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    try {
                        var response = JSON.parse(this.responseText);
                        if (response.success) {
                            location.reload();
                        } else {
                            alert("Error: " + response.error);
                        }
                    } catch (e) {
                        alert("Error: Invalid response from server");
                    }
                }
            };
            xml.open("POST", "../PHP_Project/delete_cart.php", true);
            xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xml.send("cart_id=" + cart_id);
        });
    }
});




function handleSubmit() {
    // جلب بيانات النموذج
    const form = document.getElementById('checkout-form');
    const messageContainer = document.getElementById('message-container');

    // التحقق من الحقول المطلوبة
    const inputs = form.querySelectorAll('input[required], select[required]');
    let isValid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
        }
    });

    if (!isValid) {
        messageContainer.innerHTML = "<span style='color: red;'>All fields are required.</span>";
        return;
    }

    // عرض رسالة النجاح مؤقتًا
    messageContainer.innerHTML = "<span style='color: green;'>Your order has been placed successfully!</span><br><span style='color: #666;'>Your cart is now empty as the order is ready!</span>";

    // إرسال البيانات إلى السيرفر
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // إعادة تحميل الصفحة بعد 2 ثانية
                setTimeout(() => {
                    window.location.href = 'cart.php';
                }, 6000);
            } else if (data.error) {
                messageContainer.innerHTML = "<span style='color: red;'>" + data.error + "</span>";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageContainer.innerHTML = "<span style='color: red;'>Error processing your order. Check console for details.</span>";
        });
}
