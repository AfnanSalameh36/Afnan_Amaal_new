let currentIndex = 0;
const images = ["../image/3.jpg", "../image/4.jpg", "../image/8.png"];
const texts = ["Golden Bite", "تجربة فاخرة بأذواق راقية", "استمتع بأشهى الأطباق"];
const positions = [
    { top: "40px", left:"20px", bottom: "400px" },  // للصورة الأولى
    { bottom: "30%", left: "20%", transform: "none" },  // للصورة الثانية
    { bottom: "50%", left: "70%", transform: "translateX(-50%)" }  // للصورة الثالثة
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
    // إخفاء النص قبل تغيير الصورة
    titleText.classList.remove("show-text");
    titleText.classList.add("hide-text");

    setTimeout(() => {
        // تحديث الخلفية
        bgImage.src = images[currentIndex];

        // إذا كانت الصورة الأولى، أظهر النص، وإلا اخفه
        if (currentIndex === 0) {
            titleText.textContent = texts[currentIndex];
            titleText.style.bottom = positions[currentIndex].bottom;
            titleText.style.left = positions[currentIndex].left;
            titleText.style.transform = positions[currentIndex].transform;
            titleText.classList.remove("hide-text");
            titleText.classList.add("show-text");
        } else {
            titleText.classList.remove("show-text");
            titleText.classList.add("hide-text");
        }

        // تحديث الأرقام المحددة
        numbers.forEach((num, i) => {
            num.classList.toggle("selected", i === currentIndex);
        });

    }, 300); // تأخير بسيط قبل تغيير النص
}


// تشغيل التغيير التلقائي كل 5 ثوانٍ
let interval = setInterval(() => changeImage(1), 5000);

document.addEventListener("DOMContentLoaded", function () {
    numbers.forEach((num, index) => {
        num.addEventListener("click", () => {
            setImage(index);
            resetInterval(); // إعادة ضبط المؤقت عند التفاعل اليدوي
        });
    });

    updateBackground();
});

function resetInterval() {
    clearInterval(interval);
    interval = setInterval(() => changeImage(1), 5000);
}
