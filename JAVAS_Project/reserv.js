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
<td><button onclick="confirmCancel(${reservation.id})" aria-label="إلغاء الحجز" style="font-size: 20px; color: red; background: none; border: none; cursor: pointer;">&times;</button></td>

          `;
                    tbody.appendChild(row);
                });
                table.style.display = 'table';
            } else {
                // إذا ما في حجوزات
                tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;">There are currently no reservations.</td></tr>`;
                table.style.display = 'table';
            }
        })
        .catch(err => {
            loadingMsg.textContent = 'An error occurred while fetching the reservations.'

            console.error(err);
        });
}
function fetchBookingMessages() {
    const bookingSection = document.getElementById('booking-messages');
    if (!bookingSection) {
        console.error("العنصر booking-messages غير موجود!");
        return;
    }

    fetch('../PHP_Project/get_booking_messages.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success" && data.messages.length > 0) {
                let html = "<h3>Booking Messages</h3><ul>";
                data.messages.forEach(msg => {
                    html += `<li>${msg}</li>`;
                });
                html += "</ul>";
                bookingSection.innerHTML = html;
            } else {
                bookingSection.innerHTML = `<h3>Booking</h3><p style="color: #777; text-align: center;">No booking messages</p>`;

            }
        })
        .catch(error => {
            console.error('خطأ في جلب رسائل الحجز:', error);
        });
}

document.addEventListener("DOMContentLoaded", fetchBookingMessages);
function fetchNotifications() {
    // استدعاء إشعارات الجلسة
    const notificationsPromise = fetch('../PHP_Project/get_notifications.php')
        .then(res => res.json())
        .then(data => data.count || 0)
        .catch(() => 0);

    // استدعاء رسائل الحجز
    const bookingMessagesPromise = fetch('../PHP_Project/get_booking_messages.php')
        .then(res => res.json())
        .then(data => (data.status === 'success' ? data.messages.length : 0))
        .catch(() => 0);

    // استدعاء رسائل الملف
    const profileMessagesPromise = fetch('../PHP_Project/get_profile_messages.php')  // مثلا هذا ملف جديد يرجع رسائل الملف
        .then(res => res.json())
        .then(data => (data.status === 'success' ? data.messages.length : 0))
        .catch(() => 0);

    Promise.all([notificationsPromise, bookingMessagesPromise, profileMessagesPromise])
        .then(([notifCount, bookingCount, profileCount]) => {
            const totalCount = notifCount + bookingCount + profileCount;
            const notifBadge = document.querySelector('.notification-badge');
            if (notifBadge) {
                if (totalCount > 0) {
                    notifBadge.textContent = totalCount;
                    notifBadge.style.display = 'inline-block';
                } else {
                    notifBadge.textContent = '0';
                    notifBadge.style.display = 'none';
                }
            }
        });
}
