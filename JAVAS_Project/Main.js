let currentIndex = 0;
const images = ["../image/3.jpg", "../image/4.jpg", "../image/8.png"];
const texts = [
    ["Golden Restaurant", "Where Culinary Art Becomes an Experience", "Savor the Gold Standard of Dining"],
    ["Crafted with Passion, Served with Grace", "Indulge in Luxury, One Bite at a Time", "Enjoy your meal"],
    ["OElevating Every Bite Into a Memory", "Wholesome Food for a Golden Life", "Where Taste Reigns Supreme"]
];
const textClasses = [
    ['line-1', 'line-2', 'line-3'],
    ['line-4', 'line-5', 'line-6'],
    ['line-7', 'line-8', 'line-9']
];
const positions = [
    { bottom: "30%", left: "50%", transform: "translateX(-50%)" }
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
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++
// التحكم في سلة التسوق
const shopButton = document.getElementById('shop-button');
const shopDropdown = document.getElementById('shop-dropdown');

if (shopButton && shopDropdown) {
    shopButton.addEventListener('click', function(e) {
        e.preventDefault();
        shopDropdown.classList.toggle('active');
    });

    // إغلاق السلة عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.shop-dropdown') &&
            !e.target.closest('#shop-button') &&
            e.target.id !== 'shop-button') {
            shopDropdown.classList.remove('active');
        }
    });
}

// يمكنك إضافة هذه الدالة لإضافة منتجات إلى السلة
function addToCart(product) {
    const emptyCartMsg = document.querySelector('.empty-cart-message');
    const productList = document.querySelector('.product-list');
    const checkoutBtn = document.querySelector('.checkout');

    if (emptyCartMsg) emptyCartMsg.style.display = 'none';

    const productItem = document.createElement('div');
    productItem.className = 'product-item';
    productItem.innerHTML = `
        <img src="${product.image}" alt="${product.name}">
        <div class="product-info">
            <h4>${product.name}</h4>
            <p>$${product.price}</p>
            <button class="remove-item">Remove</button>
        </div>
    `;

    if (productList) productList.appendChild(productItem);
    if (checkoutBtn) checkoutBtn.disabled = false;

    // هنا يمكنك تحديث المجموع الكلي
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++التقييممم
const swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 0,
    autoHeight: true,
    grabCursor: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
function showForm() {
    document.getElementById("review-form").style.display = "flex";
}
function addReview(e) {
    e.preventDefault();
    const name = document.getElementById("username").value;
    const review = document.getElementById("review").value;
    const stars = document.getElementById("stars").value;
    const avatarFile = document.getElementById("avatar").files[0];
    const reader = new FileReader();
    reader.onload = function (event) {
        const newSlide = document.createElement("div");
        newSlide.classList.add("swiper-slide");
        let starsHTML = "";
        for (let i = 1; i <= 5; i++) {
            starsHTML += `<i class="${i <= stars ? 'fas' : 'far'} fa-star"></i>`;
        }
        newSlide.innerHTML = `
                <img src="${event.target.result}" alt="avatar" class="avatar">
                <div class="review-name">${name}</div>
                <div class="stars">${starsHTML}</div>
                <div class="review-text">${review}</div>
            `;
        swiper.appendSlide(newSlide);
        document.getElementById("review-form").reset();
        document.getElementById("review-form").style.display = "none";
    };
    if (avatarFile) {
        reader.readAsDataURL(avatarFile);
    } else {
        reader.onload({ target: { result: "https://i.pravatar.cc/60" } });
    }
}
// إخفاء الفورم لما تكبسي بمكان خارجو
document.addEventListener('click', function (e) {
    const form = document.getElementById('review-form');
    const button = document.querySelector('.add-review-btn');

    // إذا الفورم ظاهر و الكليك مش جواتو ولا على الزر
    if (
        form.style.display === 'flex' &&
        !form.contains(e.target) &&
        !button.contains(e.target)
    ) {
        form.style.display = 'none';
    }
});







