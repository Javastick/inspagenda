import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import idLocale from '@fullcalendar/core/locales/id';

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById('calendar');

    // Get data from window object (set in blade)
    const events = window.calendarData ? window.calendarData.events : [];
    const routeUrl = window.calendarData ? window.calendarData.routeUrl : '';

    if (calendarEl) {
        // Date formatting for header
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const todayEl = document.getElementById('today');
        if (todayEl) {
            todayEl.textContent = new Date().toLocaleDateString('id-ID', options);
        }

        // Initialize Calendar
        // Note: We are using the CDN version of FullCalendar in the layout as per plan decision (minimize risk).
        // However, if we move to NPM, we would import plugins here.
        // Since the layout loads the CDN global 'FullCalendar', we use that.
        // If we want to fully migrate to NPM, we should install @fullcalendar/core etc.
        // The plan said "Keep specific CDNs (FullCalendar/Flatpickr) if not moving to NPM immediately".
        // BUT, I'm writing a JS file that will vary depending on how it's loaded.
        // If I use Vite, I really SHOULD use NPM packages.
        // If I rely on CDN globals in a module... it works but it's mixed.

        // DECISION: To be consistent with modern Vite usage, I should probably use NPM for FullCalendar 
        // IF I'm making this a module. But if I don't want to risk breaking the calendar config...
        // The user code uses `new FullCalendar.Calendar`.
        // I will stick to using the global `FullCalendar` object provided by the CDN for now, 
        // to match the "Keep CDNs" decision and avoid installing 5+ packages and debugging webpack/vite issues with FullCalendar plugins.

        // Wait, if I use `import` in this file, it's a module. Can it see global `FullCalendar`? Yes, usually.


        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            locales: [idLocale],
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next'
            },
            selectable: true,
            editable: true,
            events: events,
            eventDisplay: 'block',
            timeZone: 'Asia/Jakarta',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            eventContent: function (info) {
                // Custom rendering logic from home/index.blade.php
                return { html: '' };
            },
            eventDidMount: function (info) {
                // Bootstrap 5 usage
                // Custom rendering for event dot
                const backgroundColor = info.event.backgroundColor || 'primary';
                const title = info.event.title || '';
                const tempat = info.event.extendedProps.tempat || '';
                const url = info.event.url || '#';

                info.el.innerHTML = `
                    <div class="fc-event-dot bg-${backgroundColor}"
                         data-bs-toggle="tooltip" 
                         title="${title} - ${tempat}"
                         onclick="window.location.href='${url}'">
                    </div>
                `;

                info.el.style.cursor = 'pointer';

                if (window.bootstrap && window.bootstrap.Tooltip) {
                    const dot = info.el.querySelector('.fc-event-dot');
                    if (dot) {
                        new window.bootstrap.Tooltip(dot);
                    }
                }
            },
            dateClick: function (info) {
                if (routeUrl) {
                    window.location.href = routeUrl.replace('PLACEHOLDER', info.dateStr);
                }
            },
            locale: 'id',
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            dayHeaderFormat: {
                weekday: 'short',
            },
            titleFormat: {
                year: 'numeric',
                month: 'long'
            },
            dayMaxEvents: true
        });
        calendar.render();
    }
});
