let currentIndex = 0;
const images = ["../image/3.jpg", "../image/4.jpg", "../image/5.jpg"]; // تأكدي من وضع المسارات الصحيحة
const bgImage = document.getElementById("bg1");
const numbers = document.querySelectorAll(".num");

function changeImage(direction) {
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = images.length - 1;
    if (currentIndex >= images.length) currentIndex = 0;
    updateBackground();
}

function setImage(index) {
    currentIndex = index;
    updateBackground();
}

function updateBackground() {
    bgImage.src = images[currentIndex];
    numbers.forEach((num, i) => {
        num.classList.toggle("selected", i === currentIndex);
    });
}

// تحديد الصورة الأولى عند تحميل الصفحة
updateBackground();
document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    const images = ["../image/3.jpg", "../image/4.jpg", "../image/5.jpg"]; // تأكدي من وضع المسارات الصحيحة
    const bgImage = document.getElementById("bg1");
    const numbers = document.querySelectorAll(".num");

    function changeImage(direction) {
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = images.length - 1;
        if (currentIndex >= images.length) currentIndex = 0;
        updateBackground();
    }

    function setImage(index) {
        currentIndex = index;
        updateBackground();
    }

    function updateBackground() {
        bgImage.src = images[currentIndex];
        numbers.forEach((num, i) => {
            num.classList.toggle("selected", i === currentIndex);
        });
    }

    // إضافة Event Listeners للأرقام لجعلها تتفاعل مع الضغط
    numbers.forEach((num, index) => {
        num.addEventListener("click", () => setImage(index));
    });

    // تحديد الصورة الأولى عند تحميل الصفحة
    updateBackground();
});

