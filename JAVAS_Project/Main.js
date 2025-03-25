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

// تغيير الصورة تلقائيًا كل 5 ثواني
function autoChangeImage() {
    changeImage(1);
}

// بدء المؤقت عند تحميل الصفحة
let interval = setInterval(autoChangeImage, 5000);

document.addEventListener("DOMContentLoaded", function () {
    numbers.forEach((num, index) => {
        num.addEventListener("click", () => {
            setImage(index);
            resetInterval(); // إعادة ضبط التايمر عند التفاعل اليدوي
        });
    });

    updateBackground();
});

// إعادة ضبط المؤقت عند التفاعل اليدوي
function resetInterval() {
    clearInterval(interval);
    interval = setInterval(autoChangeImage, 5000);
}
