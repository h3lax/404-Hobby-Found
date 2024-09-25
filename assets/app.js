import './styles/app.css';
import $ from 'jquery';
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import '@fullcalendar/common/main.css';

document.addEventListener('DOMContentLoaded', function() {
    const eventsDataElement = document.getElementById('events-data');

    if (eventsDataElement) {
        try {
            var events = JSON.parse(eventsDataElement.textContent); // Parse the events data
            console.log("Events loaded:", events); // For debugging

            var calendarEl = document.getElementById('calendar');
            var calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin], // Ensure you're using the right plugins
                initialView: 'dayGridMonth',
                events: events  // Pass the events array here directly
            });

            calendar.render();
        } catch (error) {
            console.error("Error parsing events data:", error);
        }
    } else {
        console.error("Element with ID 'events-data' not found.");
    }
});

