// document.addEventListener("DOMContentLoaded", function() {
//     // Date formatting
//     const options = {
//         weekday: 'long',
//         year: 'numeric',
//         month: 'long',
//         day: 'numeric'
//     };
//     document.getElementById('today').textContent = new Date().toLocaleDateString('id-ID', options);

//     // Calendar initialization
//     const calendarEl = document.getElementById('calendar');
//     if (calendarEl) {
//         const calendar = new FullCalendar.Calendar(calendarEl, {
//             initialView: 'dayGridMonth',
//             headerToolbar: {
//                 left: 'prev,next today',
//                 center: 'title',
//                 right: 'dayGridMonth,dayGridWeek,dayGridDay'
//             },
//             events: {!! json_encode($days) !!},
//             aspectRatio: 1.2, // Better aspect ratio for mobile
//         });
//         calendar.render();
//     }
// });