const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");
let currentIndex = 0;  // تعيين الفهرس الأول للصورة
const totalImages = images.length;  // تحديد عدد الصور

inputs.forEach((inp) => {
    inp.addEventListener("focus", () => {
        inp.classList.add("active");
    });
    inp.addEventListener("blur", () => {
        if (inp.value != "") return;
        inp.classList.remove("active");
    });
});

toggle_btn.forEach((btn) => {
    btn.addEventListener("click", () => {
        main.classList.toggle("sign-up-mode");
    });
});

function moveSlider() {
    let index = this.dataset.value || this.classList[1].split('-')[1];  // تحديد الرقم بناءً على الداتا

    let currentImage = document.querySelector(`.img-${index}`);
    images.forEach((img) => img.classList.remove("show"));
    currentImage.classList.add("show");

    const textSlider = document.querySelector(".text-group");
    textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

    bullets.forEach((bull) => bull.classList.remove("active"));
    this.classList.add("active");
}

// تشغيل الصور بشكل تلقائي كل 3 ثواني
function autoSlide() {
    currentIndex++;
    if (currentIndex >= totalImages) {
        currentIndex = 0;  // إعادة الفهرس للصورة الأولى عند الوصول للنهاية
    }

    let currentImage = document.querySelector(`.img-${currentIndex + 1}`);
    images.forEach((img) => img.classList.remove("show"));
    currentImage.classList.add("show");

    const textSlider = document.querySelector(".text-group");
    textSlider.style.transform = `translateY(${-(currentIndex) * 2.2}rem)`;

    bullets.forEach((bull) => bull.classList.remove("active"));
    bullets[currentIndex].classList.add("active");
}

// تفعيل الحركة التلقائية كل 3 ثواني
setInterval(autoSlide, 3000);

bullets.forEach((bullet) => {
    bullet.addEventListener("click", moveSlider);
});
