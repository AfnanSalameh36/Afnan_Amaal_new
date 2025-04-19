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

// سحب بالماوس أو اللمس
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