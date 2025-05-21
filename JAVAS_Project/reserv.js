function loadReservations() {
    const loadingMsg = document.getElementById('loading-message');
    const table = document.getElementById('reservations-table');
    const tbody = document.getElementById('reservations-body');

    // إظهار رسالة التحميل وإخفاء الجدول مؤقتًا
    loadingMsg.style.display = 'block';
    table.style.display = 'none';

    fetch('../PHP_Project/get_reservations.php') // عدل المسار حسب حاجتك
        .then(res => res.json())
        .then(data => {
            loadingMsg.style.display = 'none'; // إخفاء رسالة التحميل

            tbody.innerHTML = ''; // تفريغ المحتوى القديم

            if (data.success && data.reservations && data.reservations.length > 0) {
                data.reservations.forEach(reservation => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
            <td>${reservation.date}</td>
            <td>${reservation.time}</td>
            <td>${reservation.guests}</td>
            <td>${reservation.special_request || '-'}</td>
          `;
                    tbody.appendChild(row);
                });
                table.style.display = 'table';
            } else {
                // إذا ما في حجوزات
                tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;">لا توجد حجوزات حالياً.</td></tr>`;
                table.style.display = 'table';
            }
        })
        .catch(err => {
            loadingMsg.textContent = 'حدث خطأ أثناء جلب الحجوزات.';
            console.error(err);
        });
}
