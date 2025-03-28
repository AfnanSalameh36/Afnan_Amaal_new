let currentIndex = 0;
const images = ["../image/3.jpg", "../image/4.jpg", "../image/8.png"];
const texts = [
    ["Golden Bite", "Where Every Meal is a Masterpiece", "Where Flavor Meets Passion"],
    ["Welcome to Golden Restaurant", "The best food in town", "Enjoy your meal"],
    ["Fresh Ingredients", "Organic and Tasty", "Healthy Food, Happy Life"]
];
const textClasses = [
    ['line-1', 'line-2', 'line-3'],
    ['line-4', 'line-5', 'line-6'],
    ['line-7', 'line-8', 'line-9']
];
const positions = [
    { bottom: "40%", left: "50%", transform: "translateX(-50%)" }
];

const bgImage = document.getElementById("bg1");
const titleText = document.getElementById("restaurant-name");
const numbers = document.querySelectorAll(".num");
let interval;

// تهيئة القائمة الجانبية للهاتف
const menuToggle = document.getElementById("mobile-menu");
const navbar = document.querySelector('.navbar');
const mobileNav = navbar.cloneNode(true);
mobileNav.classList.add('mobile-nav');
document.body.appendChild(mobileNav);
navbar.style.display = 'none';

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
    titleText.classList.remove("show-text");
    titleText.classList.add("hide-text");

    setTimeout(() => {
        bgImage.src = images[currentIndex];
        titleText.classList.remove("page-1", "page-2", "page-3");
        titleText.classList.add(`page-${currentIndex + 1}`);

        titleText.innerHTML = texts[currentIndex]
            .map((line, index) => `<span class="text-line ${textClasses[currentIndex][index]}">${line}</span>`)
            .join(" ");

        Object.assign(titleText.style, positions[0]);

        setTimeout(() => {
            titleText.classList.remove("hide-text");
            titleText.classList.add("show-text");
        }, 100);

        numbers.forEach((num, i) => {
            num.classList.toggle("selected", i === currentIndex);
        });
    }, 300);
}

function resetInterval() {
    clearInterval(interval);
    interval = setInterval(() => changeImage(1), 8000);
}

// تفعيل السحب باللمس
let touchStartX = 0;
let touchEndX = 0;

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        changeImage(1);
        resetInterval();
    }
    if (touchEndX > touchStartX + 50) {
        changeImage(-1);
        resetInterval();
    }
}

// تهيئة الأحداث
document.addEventListener("DOMContentLoaded", function() {
    updateBackground();
    resetInterval();

    numbers.forEach((num, index) => {
        num.addEventListener("click", () => {
            setImage(index);
            resetInterval();
        });
    });

    // أحداث اللمس
    document.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, false);

    document.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);

    // أحداث القائمة الجانبية
    // التحكم في فتح/إغلاق القائمة
    const menuToggle = document.getElementById('mobile-menu');
    const mobileNav = document.querySelector('.navbar.mobile-nav');

    menuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        mobileNav.classList.toggle('active');

        // لمنع التمرير عند فتح القائمة
        if(this.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

// إغلاق القائمة عند النقر على الروابط
    mobileNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            menuToggle.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
});
