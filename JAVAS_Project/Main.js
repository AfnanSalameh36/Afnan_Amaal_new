let currentIndex = 0;
const images = ["../image/3.jpg", "../image/4.jpg", "../image/8.png"];
const texts = [
    ["Golden Bite", "amaaal ferasssss", "afnan salamehhhh"], // النصوص للخلفية 1
    ["Welcome to Golden Restaurant", "The best food in town", "Enjoy your meal"], // النصوص للخلفية 2
    ["Fresh Ingredients", "Organic and Tasty", "Healthy Food, Happy Life"] // النصوص للخلفية 3
];
const textClasses = [
    ['line-1', 'line-2', 'line-3'],  // النصوص للخلفية 1
    ['line-4', 'line-5', 'line-6'],  // النصوص للخلفية 2
    ['line-7', 'line-8', 'line-9']   // النصوص للخلفية 3
];
const positions = [
    { bottom: "40%", left: "50%", transform: "translateX(-50%)" }
];

const bgImage = document.getElementById("bg1");
const titleText = document.getElementById("restaurant-name");
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
    // إخفاء النصوص قبل تغيير الصورة
    titleText.classList.remove("show-text");
    titleText.classList.add("hide-text");

    setTimeout(() => {
        // حذف الصورة الحالية قبل تعيين صورة جديدة
        bgImage.src = ""; // هذه خطوة مهمة للتأكد من أن الصورة تتغير

        // تحديث الخلفية الجديدة
        bgImage.src = images[currentIndex];

        // تغيير الفئة الخاصة بالصفحة الحالية
        titleText.classList.remove("page-1", "page-2", "page-3");
        titleText.classList.add(`page-${currentIndex + 1}`);

        // إنشاء النصوص المتعددة داخل `restaurant-name`
        let newText = texts[currentIndex]
            .map((line, index) => `<span class="text-line ${textClasses[currentIndex][index]}">${line}</span>`)
            .join(" ");

        titleText.innerHTML = newText;

        // ضبط موضع النص
        titleText.style.bottom = positions[0].bottom;
        titleText.style.left = positions[0].left;
        titleText.style.transform = positions[0].transform;

        // إظهار النص بعد تغيير الخلفية
        setTimeout(() => {
            titleText.classList.remove("hide-text");
            titleText.classList.add("show-text");
        }, 100);

        // تحديث الأرقام المحددة
        numbers.forEach((num, i) => {
            num.classList.toggle("selected", i === currentIndex);
        });
    }, 300); // تأخير بسيط قبل تغيير الخلفية
}

// تغيير المؤقت التلقائي
let interval = setInterval(() => changeImage(1), 5000);

document.addEventListener("DOMContentLoaded", function () {
    updateBackground();

    numbers.forEach((num, index) => {
        num.addEventListener("click", () => {
            setImage(index);
            resetInterval(); // إعادة ضبط المؤقت عند التفاعل اليدوي
        });
    });
});

function resetInterval() {
    clearInterval(interval);
    interval = setInterval(() => changeImage(1), 8000);
}
