let current = 0;
const track = document.querySelector('#track');
const numbers = document.querySelectorAll('.num');
const testimonials = document.querySelectorAll('.testimonial');
const leftArrow = document.querySelector('.arrow.left');
const rightArrow = document.querySelector('.arrow.right');

function updateSlider(index) {
    current = (index + testimonials.length) % testimonials.length;
    track.style.transform = `translateX(-${current * 100}%)`;
    numbers.forEach((num, i) => {
        num.classList.toggle('active', i === current);
    });
}

numbers.forEach((num, idx) => {
    num.addEventListener('click', () => updateSlider(idx));
});

leftArrow.addEventListener('click', () => updateSlider(current - 1));
rightArrow.addEventListener('click', () => updateSlider(current + 1));

setInterval(() => {
    updateSlider(current + 1);
}, 5000);

let startX = 0;
let isDragging = false;

track.addEventListener('mousedown', e => {
    isDragging = true;
    startX = e.pageX;
});

track.addEventListener('mouseup', e => {
    if (!isDragging) return;
    isDragging = false;
    let diff = e.pageX - startX;
    if (diff > 50) updateSlider(current - 1);
    else if (diff < -50) updateSlider(current + 1);
});

track.addEventListener('touchstart', e => {
    startX = e.touches[0].clientX;
}, { passive: true });

track.addEventListener('touchend', e => {
    let diff = e.changedTouches[0].clientX - startX;
    if (diff > 50) updateSlider(current - 1);
    else if (diff < -50) updateSlider(current + 1);
});
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