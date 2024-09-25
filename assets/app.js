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

    let event1 = {
        title: 'Event1',
        start: '2024-09-10'
      };

    if (eventsDataElement) {
        try {
            console
            let events = JSON.parse(eventsDataElement.textContent);
            let event2 = JSON.parse(events);
            let calendarEl = document.getElementById('calendar');
            let calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin], // Ensure you're using the right plugins
                initialView: 'dayGridMonth',
                //events: events  // Pass the events array here directly
            });
            console.log(events);
            console.log(event1);
            console.log(event2);
        
            event2.forEach(event => {
                console.log(event),
                calendar.addEvent(event);
            });
            //calendar.addEvent( event1 );

            calendar.render();
        } catch (error) {
            console.error("Error parsing events data:", error);
        }
    } else {
        console.error("Element with ID 'events-data' not found.");
    }
    
    
});

