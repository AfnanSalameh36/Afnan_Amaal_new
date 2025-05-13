document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.querySelectorAll(".custom_number_input");

    cartItems.forEach(item => {
        const quantityInput = item.querySelector(".quantity");
        const arrowUp = item.querySelector(".arrow-up");
        const arrowDown = item.querySelector(".arrow-down");

        arrowUp.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentValue + 1;
        });

        arrowDown.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 0;
            if (currentValue > 0) {
                quantityInput.value = currentValue - 1;
            }
        });
    });
});
